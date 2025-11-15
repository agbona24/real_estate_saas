# Testing Strategy & Test Scenarios

## Table of Contents
1. [Testing Philosophy](#testing-philosophy)
2. [Testing Pyramid](#testing-pyramid)
3. [Unit Testing](#unit-testing)
4. [Integration Testing](#integration-testing)
5. [End-to-End Testing](#end-to-end-testing)
6. [Performance Testing](#performance-testing)
7. [Security Testing](#security-testing)
8. [Test Automation](#test-automation)
9. [Test Coverage Goals](#test-coverage-goals)
10. [Test Scenarios by Module](#test-scenarios-by-module)

---

## Testing Philosophy

### Goals
- **Quality Assurance**: Ensure features work as expected
- **Regression Prevention**: Catch bugs before production
- **Confidence**: Deploy with confidence
- **Documentation**: Tests serve as living documentation
- **Speed**: Fast feedback loop for developers

### Principles
- Write tests first (TDD when applicable)
- Test behavior, not implementation
- Keep tests simple and readable
- Maintain test independence
- Aim for high coverage, but prioritize critical paths

---

## Testing Pyramid

```
                    ▲
                   / \
                  /   \
                 /  E2E \           10% - End-to-End
                /_______\           (Browser, Full System)
               /         \
              /    API    \         30% - Integration
             / Integration \        (API, Database)
            /______________\
           /                \
          /   Unit Tests     \      60% - Unit Tests
         /____________________\     (Functions, Components)
```

### Distribution
- **60% Unit Tests**: Fast, isolated, test individual functions/components
- **30% Integration Tests**: Test API endpoints, database interactions
- **10% E2E Tests**: Full user flows, critical paths only

---

## Unit Testing

### Frontend (React + Jest + React Testing Library)

#### Setup

```javascript
// jest.config.js
module.exports = {
  testEnvironment: 'jsdom',
  setupFilesAfterEnv: ['<rootDir>/src/setupTests.js'],
  moduleNameMapper: {
    '\\.(css|less|scss|sass)$': 'identity-obj-proxy',
    '\\.(jpg|jpeg|png|gif|svg)$': '<rootDir>/__mocks__/fileMock.js',
  },
  collectCoverageFrom: [
    'src/**/*.{js,jsx,ts,tsx}',
    '!src/index.js',
    '!src/**/*.test.{js,jsx}',
  ],
  coverageThreshold: {
    global: {
      branches: 70,
      functions: 70,
      lines: 70,
      statements: 70,
    },
  },
};
```

#### Component Tests

```javascript
// components/PropertyCard.test.jsx
import { render, screen, fireEvent } from '@testing-library/react';
import PropertyCard from './PropertyCard';

describe('PropertyCard', () => {
  const mockProperty = {
    id: '1',
    title: '123 Main St',
    price: 450000,
    bedrooms: 4,
    bathrooms: 3,
    sqft: 2500,
    imageUrl: 'https://example.com/image.jpg',
  };

  it('renders property information correctly', () => {
    render(<PropertyCard property={mockProperty} />);

    expect(screen.getByText('123 Main St')).toBeInTheDocument();
    expect(screen.getByText('$450,000')).toBeInTheDocument();
    expect(screen.getByText('4 bed')).toBeInTheDocument();
    expect(screen.getByText('3 bath')).toBeInTheDocument();
    expect(screen.getByText('2,500 sqft')).toBeInTheDocument();
  });

  it('calls onFavorite when heart icon clicked', () => {
    const onFavorite = jest.fn();
    render(<PropertyCard property={mockProperty} onFavorite={onFavorite} />);

    const favoriteButton = screen.getByLabelText('Add to favorites');
    fireEvent.click(favoriteButton);

    expect(onFavorite).toHaveBeenCalledWith(mockProperty.id);
  });

  it('displays fallback image when imageUrl is invalid', () => {
    const propertyWithoutImage = { ...mockProperty, imageUrl: null };
    render(<PropertyCard property={propertyWithoutImage} />);

    const image = screen.getByRole('img');
    expect(image).toHaveAttribute('src', '/images/placeholder.jpg');
  });
});
```

#### Redux Reducer Tests

```javascript
// store/properties/propertiesSlice.test.js
import propertiesReducer, {
  fetchProperties,
  addProperty,
  updateProperty,
  deleteProperty,
} from './propertiesSlice';

describe('properties reducer', () => {
  const initialState = {
    items: [],
    loading: false,
    error: null,
  };

  it('should handle initial state', () => {
    expect(propertiesReducer(undefined, { type: 'unknown' })).toEqual(initialState);
  });

  it('should handle fetchProperties.pending', () => {
    const actual = propertiesReducer(initialState, fetchProperties.pending());
    expect(actual.loading).toBe(true);
  });

  it('should handle fetchProperties.fulfilled', () => {
    const properties = [{ id: '1', title: 'Property 1' }];
    const actual = propertiesReducer(
      initialState,
      fetchProperties.fulfilled(properties)
    );

    expect(actual.loading).toBe(false);
    expect(actual.items).toEqual(properties);
  });

  it('should handle addProperty.fulfilled', () => {
    const newProperty = { id: '2', title: 'New Property' };
    const state = { ...initialState, items: [{ id: '1', title: 'Property 1' }] };
    const actual = propertiesReducer(state, addProperty.fulfilled(newProperty));

    expect(actual.items).toHaveLength(2);
    expect(actual.items[1]).toEqual(newProperty);
  });
});
```

### Backend (Node.js + Jest + Supertest)

#### Controller Tests

```javascript
// controllers/PropertyController.test.js
const PropertyController = require('./PropertyController');
const PropertyService = require('../services/PropertyService');

jest.mock('../services/PropertyService');

describe('PropertyController', () => {
  let req, res, next;

  beforeEach(() => {
    req = {
      user: { userId: 'user123', tenantId: 'tenant123' },
      params: {},
      query: {},
      body: {},
    };
    res = {
      json: jest.fn(),
      status: jest.fn().mockReturnThis(),
    };
    next = jest.fn();
  });

  afterEach(() => {
    jest.clearAllMocks();
  });

  describe('getAll', () => {
    it('should return paginated properties', async () => {
      const mockProperties = {
        properties: [{ id: '1', title: 'Property 1' }],
        pagination: { page: 1, limit: 20, total: 1 },
      };

      PropertyService.findAll.mockResolvedValue(mockProperties);

      await PropertyController.getAll(req, res, next);

      expect(PropertyService.findAll).toHaveBeenCalledWith({
        tenantId: 'tenant123',
        page: 1,
        limit: 20,
      });
      expect(res.json).toHaveBeenCalledWith({
        success: true,
        data: mockProperties.properties,
        pagination: mockProperties.pagination,
      });
    });

    it('should handle errors', async () => {
      const error = new Error('Database error');
      PropertyService.findAll.mockRejectedValue(error);

      await PropertyController.getAll(req, res, next);

      expect(next).toHaveBeenCalledWith(error);
    });
  });

  describe('create', () => {
    it('should create a new property', async () => {
      const propertyData = {
        title: 'New Property',
        price: 500000,
        bedrooms: 3,
      };
      const createdProperty = { id: '1', ...propertyData };

      req.body = propertyData;
      PropertyService.create.mockResolvedValue(createdProperty);

      await PropertyController.create(req, res, next);

      expect(PropertyService.create).toHaveBeenCalledWith({
        ...propertyData,
        tenantId: 'tenant123',
        createdBy: 'user123',
      });
      expect(res.status).toHaveBeenCalledWith(201);
      expect(res.json).toHaveBeenCalledWith({
        success: true,
        data: createdProperty,
      });
    });
  });
});
```

#### Service Tests

```javascript
// services/PropertyService.test.js
const PropertyService = require('./PropertyService');
const { Property } = require('../models');

jest.mock('../models');

describe('PropertyService', () => {
  describe('findAll', () => {
    it('should return properties with pagination', async () => {
      const mockProperties = [
        { id: '1', title: 'Property 1' },
        { id: '2', title: 'Property 2' },
      ];

      Property.findAndCountAll.mockResolvedValue({
        rows: mockProperties,
        count: 2,
      });

      const result = await PropertyService.findAll({
        tenantId: 'tenant123',
        page: 1,
        limit: 20,
      });

      expect(result).toEqual({
        properties: mockProperties,
        pagination: {
          page: 1,
          limit: 20,
          total: 2,
          pages: 1,
        },
      });
    });
  });

  describe('calculateCommission', () => {
    it('should calculate commission correctly', () => {
      const salePrice = 500000;
      const commissionRate = 3; // 3%

      const commission = PropertyService.calculateCommission(
        salePrice,
        commissionRate
      );

      expect(commission).toBe(15000); // 500000 * 0.03
    });

    it('should apply splits correctly', () => {
      const totalCommission = 15000;
      const agentSplit = 70; // 70%
      const brokerageSplit = 30; // 30%

      const { agentAmount, brokerageAmount } = PropertyService.splitCommission(
        totalCommission,
        agentSplit,
        brokerageSplit
      );

      expect(agentAmount).toBe(10500); // 15000 * 0.7
      expect(brokerageAmount).toBe(4500); // 15000 * 0.3
    });
  });
});
```

---

## Integration Testing

### API Endpoint Tests

```javascript
// routes/properties.test.js
const request = require('supertest');
const app = require('../app');
const { Property, User, Tenant } = require('../models');
const { generateToken } = require('../utils/jwtUtils');

describe('Property API', () => {
  let authToken;
  let testUser;
  let testTenant;

  beforeAll(async () => {
    // Setup test database
    await sequelize.sync({ force: true });

    // Create test tenant
    testTenant = await Tenant.create({
      id: 'tenant123',
      companyName: 'Test Agency',
    });

    // Create test user
    testUser = await User.create({
      id: 'user123',
      tenantId: testTenant.id,
      email: 'test@example.com',
      password: 'hashedpassword',
      role: 'agent',
    });

    // Generate auth token
    authToken = generateToken(testUser, testTenant);
  });

  afterAll(async () => {
    await sequelize.close();
  });

  beforeEach(async () => {
    // Clean up properties before each test
    await Property.destroy({ where: {}, force: true });
  });

  describe('GET /api/v1/properties', () => {
    it('should return empty array when no properties exist', async () => {
      const response = await request(app)
        .get('/api/v1/properties')
        .set('Authorization', `Bearer ${authToken}`)
        .expect(200);

      expect(response.body.success).toBe(true);
      expect(response.body.data).toEqual([]);
    });

    it('should return properties for authenticated user', async () => {
      // Create test properties
      await Property.bulkCreate([
        {
          tenantId: testTenant.id,
          title: 'Property 1',
          price: 400000,
          bedrooms: 3,
        },
        {
          tenantId: testTenant.id,
          title: 'Property 2',
          price: 500000,
          bedrooms: 4,
        },
      ]);

      const response = await request(app)
        .get('/api/v1/properties')
        .set('Authorization', `Bearer ${authToken}`)
        .expect(200);

      expect(response.body.data).toHaveLength(2);
      expect(response.body.pagination.total).toBe(2);
    });

    it('should filter properties by price range', async () => {
      await Property.bulkCreate([
        { tenantId: testTenant.id, title: 'Cheap', price: 200000 },
        { tenantId: testTenant.id, title: 'Mid', price: 400000 },
        { tenantId: testTenant.id, title: 'Expensive', price: 800000 },
      ]);

      const response = await request(app)
        .get('/api/v1/properties?minPrice=300000&maxPrice=500000')
        .set('Authorization', `Bearer ${authToken}`)
        .expect(200);

      expect(response.body.data).toHaveLength(1);
      expect(response.body.data[0].title).toBe('Mid');
    });

    it('should return 401 without auth token', async () => {
      await request(app)
        .get('/api/v1/properties')
        .expect(401);
    });
  });

  describe('POST /api/v1/properties', () => {
    it('should create a new property', async () => {
      const propertyData = {
        title: 'New Property',
        type: 'house',
        listingType: 'sale',
        price: 450000,
        bedrooms: 4,
        bathrooms: 3,
        sqft: 2500,
        address: {
          street: '123 Main St',
          city: 'San Francisco',
          state: 'CA',
          zip: '94102',
        },
      };

      const response = await request(app)
        .post('/api/v1/properties')
        .set('Authorization', `Bearer ${authToken}`)
        .send(propertyData)
        .expect(201);

      expect(response.body.success).toBe(true);
      expect(response.body.data.title).toBe(propertyData.title);
      expect(response.body.data.id).toBeDefined();

      // Verify in database
      const property = await Property.findByPk(response.body.data.id);
      expect(property).toBeDefined();
      expect(property.title).toBe(propertyData.title);
    });

    it('should validate required fields', async () => {
      const invalidData = {
        title: 'No Price Property',
        // missing price
      };

      const response = await request(app)
        .post('/api/v1/properties')
        .set('Authorization', `Bearer ${authToken}`)
        .send(invalidData)
        .expect(400);

      expect(response.body.error).toBe('Validation Error');
      expect(response.body.details).toBeDefined();
    });
  });

  describe('PUT /api/v1/properties/:id', () => {
    it('should update property', async () => {
      const property = await Property.create({
        tenantId: testTenant.id,
        title: 'Original Title',
        price: 400000,
      });

      const updateData = { title: 'Updated Title', price: 450000 };

      const response = await request(app)
        .put(`/api/v1/properties/${property.id}`)
        .set('Authorization', `Bearer ${authToken}`)
        .send(updateData)
        .expect(200);

      expect(response.body.data.title).toBe('Updated Title');
      expect(response.body.data.price).toBe(450000);
    });

    it('should return 404 for non-existent property', async () => {
      await request(app)
        .put('/api/v1/properties/non-existent-id')
        .set('Authorization', `Bearer ${authToken}`)
        .send({ title: 'Updated' })
        .expect(404);
    });
  });

  describe('DELETE /api/v1/properties/:id', () => {
    it('should soft delete property', async () => {
      const property = await Property.create({
        tenantId: testTenant.id,
        title: 'To Be Deleted',
        price: 400000,
      });

      await request(app)
        .delete(`/api/v1/properties/${property.id}`)
        .set('Authorization', `Bearer ${authToken}`)
        .expect(200);

      // Verify soft delete
      const deletedProperty = await Property.findByPk(property.id, {
        paranoid: false,
      });
      expect(deletedProperty.deletedAt).not.toBeNull();
    });
  });
});
```

### Database Integration Tests

```javascript
// models/Property.test.js
const { Property, PropertyFeature } = require('../models');

describe('Property Model', () => {
  beforeAll(async () => {
    await sequelize.sync({ force: true });
  });

  afterAll(async () => {
    await sequelize.close();
  });

  it('should create property with valid data', async () => {
    const property = await Property.create({
      tenantId: 'tenant123',
      title: 'Test Property',
      type: 'house',
      listingType: 'sale',
      price: 500000,
      bedrooms: 4,
      bathrooms: 3,
    });

    expect(property.id).toBeDefined();
    expect(property.title).toBe('Test Property');
  });

  it('should validate required fields', async () => {
    await expect(
      Property.create({
        title: 'No Price',
        // missing required fields
      })
    ).rejects.toThrow();
  });

  it('should create property with features', async () => {
    const property = await Property.create({
      tenantId: 'tenant123',
      title: 'Property with Features',
      price: 500000,
    });

    await PropertyFeature.bulkCreate([
      { propertyId: property.id, feature: 'hardwood_floors' },
      { propertyId: property.id, feature: 'pool' },
      { propertyId: property.id, feature: 'fireplace' },
    ]);

    const propertyWithFeatures = await Property.findByPk(property.id, {
      include: [PropertyFeature],
    });

    expect(propertyWithFeatures.PropertyFeatures).toHaveLength(3);
  });

  it('should cascade delete features when property is deleted', async () => {
    const property = await Property.create({
      tenantId: 'tenant123',
      title: 'Property to Delete',
      price: 500000,
    });

    await PropertyFeature.create({
      propertyId: property.id,
      feature: 'garage',
    });

    await property.destroy();

    const features = await PropertyFeature.findAll({
      where: { propertyId: property.id },
    });

    expect(features).toHaveLength(0);
  });
});
```

---

## End-to-End Testing

### Cypress E2E Tests

```javascript
// cypress/e2e/property-management.cy.js
describe('Property Management', () => {
  beforeEach(() => {
    // Login before each test
    cy.login('agent@example.com', 'password123');
  });

  it('should create a new property listing', () => {
    cy.visit('/properties');
    cy.contains('Add Property').click();

    // Fill out property form
    cy.get('[name="title"]').type('Beautiful Family Home');
    cy.get('[name="type"]').select('house');
    cy.get('[name="listingType"]').select('sale');
    cy.get('[name="price"]').type('450000');
    cy.get('[name="bedrooms"]').type('4');
    cy.get('[name="bathrooms"]').type('3');
    cy.get('[name="sqft"]').type('2500');

    // Address
    cy.get('[name="address.street"]').type('123 Main St');
    cy.get('[name="address.city"]').type('San Francisco');
    cy.get('[name="address.state"]').select('CA');
    cy.get('[name="address.zip"]').type('94102');

    // Upload photos
    cy.get('input[type="file"]').selectFile([
      'cypress/fixtures/property1.jpg',
      'cypress/fixtures/property2.jpg',
    ]);

    // Submit form
    cy.contains('button', 'Publish Property').click();

    // Verify success
    cy.contains('Property published successfully').should('be.visible');
    cy.url().should('include', '/properties');
    cy.contains('Beautiful Family Home').should('be.visible');
  });

  it('should filter properties by price range', () => {
    cy.visit('/properties');

    cy.get('[data-testid="min-price"]').type('400000');
    cy.get('[data-testid="max-price"]').type('600000');
    cy.contains('Apply Filters').click();

    // Wait for results
    cy.get('[data-testid="property-card"]').should('have.length.greaterThan', 0);

    // Verify all properties are within range
    cy.get('[data-testid="property-price"]').each(($el) => {
      const price = parseInt($el.text().replace(/[^0-9]/g, ''));
      expect(price).to.be.gte(400000);
      expect(price).to.be.lte(600000);
    });
  });

  it('should save property to favorites', () => {
    cy.visit('/properties');

    cy.get('[data-testid="property-card"]').first().within(() => {
      cy.get('[data-testid="favorite-button"]').click();
    });

    cy.contains('Added to favorites').should('be.visible');

    // Navigate to favorites
    cy.get('[data-testid="nav-favorites"]').click();
    cy.url().should('include', '/favorites');
    cy.get('[data-testid="property-card"]').should('have.length.greaterThan', 0);
  });
});

describe('Lead Management', () => {
  beforeEach(() => {
    cy.login('agent@example.com', 'password123');
  });

  it('should capture lead from property inquiry', () => {
    cy.visit('/properties');

    cy.get('[data-testid="property-card"]').first().click();

    // Fill contact form
    cy.contains('Schedule a Showing').click();
    cy.get('[name="name"]').type('John Doe');
    cy.get('[name="email"]').type('john@example.com');
    cy.get('[name="phone"]').type('555-1234');
    cy.get('[name="message"]').type('I\'m interested in viewing this property');
    cy.contains('button', 'Send Message').click();

    // Verify confirmation
    cy.contains('Thank you').should('be.visible');

    // Verify lead in CRM
    cy.visit('/leads');
    cy.contains('John Doe').should('be.visible');
    cy.contains('john@example.com').should('be.visible');
  });

  it('should update lead status through pipeline', () => {
    cy.visit('/leads');

    cy.contains('John Doe').click();

    // Update status
    cy.get('[data-testid="lead-status"]').select('Contacted');
    cy.get('[data-testid="add-note"]').type('Called and scheduled showing for Saturday');
    cy.contains('button', 'Save').click();

    // Verify status updated
    cy.contains('Status updated').should('be.visible');
    cy.get('[data-testid="lead-status"]').should('have.value', 'Contacted');
  });
});

describe('Transaction Flow', () => {
  beforeEach(() => {
    cy.login('agent@example.com', 'password123');
  });

  it('should create and manage a transaction', () => {
    cy.visit('/transactions');
    cy.contains('Create Transaction').click();

    // Fill transaction form
    cy.get('[data-testid="select-property"]').click();
    cy.contains('123 Main St').click();

    cy.get('[data-testid="buyer-name"]').type('Jane Smith');
    cy.get('[data-testid="buyer-email"]').type('jane@example.com');

    cy.get('[data-testid="purchase-price"]').type('450000');
    cy.get('[data-testid="earnest-money"]').type('10000');
    cy.get('[data-testid="closing-date"]').type('2025-12-31');

    cy.contains('button', 'Create Transaction').click();

    // Verify created
    cy.contains('Transaction created').should('be.visible');

    // Move through stages
    cy.get('[data-testid="move-stage"]').click();
    cy.contains('Inspection Period').click();

    // Verify stage updated
    cy.contains('Stage updated').should('be.visible');
    cy.get('[data-testid="current-stage"]').should('contain', 'Inspection Period');
  });
});
```

---

## Performance Testing

### Load Testing with Artillery

```yaml
# artillery-config.yml
config:
  target: "https://api.yourdomain.com"
  phases:
    - duration: 60
      arrivalRate: 10
      name: "Warm up"
    - duration: 300
      arrivalRate: 50
      name: "Sustained load"
    - duration: 60
      arrivalRate: 100
      name: "Spike test"
  defaults:
    headers:
      Content-Type: "application/json"

scenarios:
  - name: "Browse Properties"
    flow:
      - post:
          url: "/api/v1/auth/login"
          json:
            email: "test@example.com"
            password: "password123"
          capture:
            - json: "$.accessToken"
              as: "token"
      - get:
          url: "/api/v1/properties?page=1&limit=20"
          headers:
            Authorization: "Bearer {{ token }}"
      - get:
          url: "/api/v1/properties/{{ $randomString() }}"
          headers:
            Authorization: "Bearer {{ token }}"

  - name: "Search Properties"
    flow:
      - get:
          url: "/api/v1/properties/search?location=San Francisco&minPrice=400000&maxPrice=600000"

  - name: "Create Lead"
    flow:
      - post:
          url: "/api/v1/leads"
          json:
            firstName: "{{ $randomString() }}"
            lastName: "{{ $randomString() }}"
            email: "{{ $randomString() }}@example.com"
            phone: "555-1234"
            source: "website"
```

```bash
# Run load test
artillery run artillery-config.yml

# Generate HTML report
artillery run --output report.json artillery-config.yml
artillery report report.json
```

---

## Test Scenarios by Module

### Authentication Module

| Test Case | Type | Priority | Expected Result |
|-----------|------|----------|----------------|
| User can register with valid credentials | E2E | High | Account created, verification email sent |
| User cannot register with existing email | Unit | High | Error: Email already registered |
| User can login with correct credentials | Integration | High | Access token and refresh token returned |
| User cannot login with incorrect password | Integration | High | Error: Invalid credentials |
| Access token expires after 15 minutes | Integration | Medium | Token rejected, must refresh |
| Refresh token works to get new access token | Integration | High | New access token issued |
| 2FA code required when enabled | Integration | High | Login requires 2FA verification |
| Password reset email sent successfully | Integration | Medium | Reset email delivered |
| Password must meet strength requirements | Unit | Medium | Weak passwords rejected |
| Account locked after 5 failed login attempts | Integration | High | Error: Account locked |

### Property Management Module

| Test Case | Type | Priority | Expected Result |
|-----------|------|----------|----------------|
| Agent can create property listing | E2E | High | Property created and visible |
| Property requires title, price, type | Unit | High | Validation errors for missing fields |
| Property images uploaded successfully | Integration | High | Images stored in S3, URLs saved |
| Property search filters work correctly | Integration | High | Results match filter criteria |
| Property comparison shows 4 properties | E2E | Medium | Side-by-side comparison displayed |
| Geocoding works for property address | Integration | Medium | Lat/lng coordinates saved |
| Property status changes reflected | Integration | High | Status updated in database and UI |
| Deleted properties are soft-deleted | Integration | High | deletedAt timestamp set |
| Property list pagination works | Integration | Medium | Correct page of results returned |
| Property views are tracked | Integration | Low | View count incremented |

### CRM & Lead Management Module

| Test Case | Type | Priority | Expected Result |
|-----------|------|----------|----------------|
| Lead captured from contact form | E2E | High | Lead created, agent notified |
| Lead auto-assigned to available agent | Integration | High | Lead assigned per round-robin |
| Lead status can be updated | Integration | High | Status changed, timeline updated |
| Lead notes are saved | Integration | Medium | Note added to lead history |
| Lead converted to client | Integration | High | Client record created |
| Duplicate leads detected | Unit | Medium | Warning shown to user |
| Lead email campaign sent | Integration | Medium | Emails queued and delivered |
| Lead scoring calculated correctly | Unit | Medium | Score based on criteria |
| Lead search works | Integration | Medium | Matching leads returned |
| Lead export to CSV | Integration | Low | CSV file generated |

### Transaction Management Module

| Test Case | Type | Priority | Expected Result |
|-----------|------|----------|----------------|
| Transaction created successfully | E2E | High | Transaction in pipeline |
| Transaction moves through stages | Integration | High | Stage updated, checklist changes |
| Commission calculated correctly | Unit | High | Accurate commission amount |
| Commission splits applied | Unit | High | Agent and brokerage amounts correct |
| Transaction checklist tracked | Integration | Medium | Items marked complete |
| Documents uploaded to transaction | Integration | High | Documents linked and accessible |
| Transaction closed successfully | Integration | High | Status set to closed, property updated |
| Transaction timeline displayed | E2E | Medium | All events shown chronologically |
| Offer management works | Integration | Medium | Multiple offers tracked |
| Transaction notifications sent | Integration | Medium | Email/SMS notifications delivered |

### Billing & Subscription Module

| Test Case | Type | Priority | Expected Result |
|-----------|------|----------|----------------|
| User can subscribe to plan | E2E | High | Subscription active, payment processed |
| Trial period works correctly | Integration | High | 14-day trial, no charge |
| Subscription upgrades prorated | Integration | High | Correct proration calculated |
| Subscription downgrades at period end | Integration | High | Plan changes on renewal date |
| Failed payment triggers dunning | Integration | High | Retry attempted, email sent |
| Invoice generated correctly | Integration | High | Accurate invoice with line items |
| Tax calculated for applicable states | Unit | Medium | Tax amount correct |
| Coupon applied successfully | Integration | Medium | Discount applied to invoice |
| Subscription canceled | Integration | High | Cancel at period end set |
| Usage limits enforced | Integration | High | API returns 429 when limit exceeded |

### Security Module

| Test Case | Type | Priority | Expected Result |
|-----------|------|----------|----------------|
| SQL injection prevented | Integration | Critical | Malicious input sanitized |
| XSS attacks prevented | Integration | Critical | Script tags escaped |
| CSRF protection works | Integration | High | Invalid CSRF token rejected |
| Rate limiting enforced | Integration | High | 429 after limit exceeded |
| Passwords hashed with bcrypt | Unit | Critical | Plain text never stored |
| Sensitive data encrypted at rest | Unit | Critical | AES-256 encryption used |
| File uploads validated | Integration | High | Only allowed file types accepted |
| Auth required for protected routes | Integration | Critical | 401 without valid token |
| RBAC permissions enforced | Integration | Critical | 403 for unauthorized actions |
| Security headers set | Integration | High | Helmet headers present |

---

## Test Automation

### CI/CD Pipeline (GitHub Actions)

```yaml
# .github/workflows/test.yml
name: Test Suite

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main, develop]

jobs:
  test:
    runs-on: ubuntu-latest

    services:
      postgres:
        image: postgres:14
        env:
          POSTGRES_PASSWORD: postgres
          POSTGRES_DB: test_db
        options: >-
          --health-cmd pg_isready
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
        ports:
          - 5432:5432

      redis:
        image: redis:6-alpine
        ports:
          - 6379:6379

    steps:
      - uses: actions/checkout@v3

      - name: Setup Node.js
        uses: actions/setup-node@v3
        with:
          node-version: '16'
          cache: 'npm'

      - name: Install dependencies
        run: npm ci

      - name: Run linter
        run: npm run lint

      - name: Run unit tests
        run: npm run test:unit
        env:
          DATABASE_URL: postgres://postgres:postgres@localhost:5432/test_db
          REDIS_URL: redis://localhost:6379

      - name: Run integration tests
        run: npm run test:integration
        env:
          DATABASE_URL: postgres://postgres:postgres@localhost:5432/test_db
          REDIS_URL: redis://localhost:6379

      - name: Run E2E tests
        run: npm run test:e2e
        env:
          CYPRESS_BASE_URL: http://localhost:3000

      - name: Upload coverage
        uses: codecov/codecov-action@v3
        with:
          files: ./coverage/lcov.info

      - name: Upload test results
        if: always()
        uses: actions/upload-artifact@v3
        with:
          name: test-results
          path: |
            test-results/
            cypress/screenshots/
            cypress/videos/
```

---

## Test Coverage Goals

### Coverage Targets

- **Overall**: 80% minimum
- **Critical paths**: 95% minimum
- **Business logic**: 90% minimum
- **UI components**: 70% minimum

### Coverage by Module

| Module | Target | Priority |
|--------|--------|----------|
| Authentication | 95% | Critical |
| Billing & Payments | 95% | Critical |
| Property Management | 85% | High |
| CRM & Leads | 85% | High |
| Transactions | 90% | High |
| Reports | 70% | Medium |
| Settings | 70% | Medium |

---

**Test Suite Version**: 1.0
**Last Updated**: 2025-11-15
**Next Review**: 2026-02-15
