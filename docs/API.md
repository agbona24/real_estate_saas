# API Documentation

## Table of Contents
1. [API Overview](#api-overview)
2. [Authentication](#authentication)
3. [API Routes & Controllers](#api-routes--controllers)
4. [Request/Response Formats](#requestresponse-formats)
5. [Error Handling](#error-handling)
6. [Rate Limiting](#rate-limiting)
7. [Webhooks](#webhooks)

---

## API Overview

### Base URL
```
Production: https://api.yourdomain.com/v1
Development: http://localhost:3000/api/v1
```

### API Version
Current version: `v1`

### Protocol
REST API with JSON request/response format

### Authentication
Bearer token authentication using JWT

---

## Authentication

### Authentication Flow

```
1. User Login → Receive Access Token + Refresh Token
2. Include Access Token in headers: Authorization: Bearer {token}
3. Access Token expires in 15 minutes
4. Use Refresh Token to get new Access Token
5. Refresh Token expires in 7 days
```

### Headers
```
Authorization: Bearer {access_token}
Content-Type: application/json
X-Tenant-ID: {tenant_id}  // For multi-tenant requests
```

---

## API Routes & Controllers

## 1. Authentication API

### Base Path: `/api/v1/auth`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| POST | `/auth/register` | AuthController.register | Register new user | No |
| POST | `/auth/login` | AuthController.login | User login | No |
| POST | `/auth/logout` | AuthController.logout | User logout | Yes |
| POST | `/auth/refresh` | AuthController.refreshToken | Refresh access token | No (Refresh token) |
| POST | `/auth/forgot-password` | AuthController.forgotPassword | Request password reset | No |
| POST | `/auth/reset-password` | AuthController.resetPassword | Reset password with token | No |
| POST | `/auth/verify-email` | AuthController.verifyEmail | Verify email address | No |
| POST | `/auth/resend-verification` | AuthController.resendVerification | Resend verification email | No |
| POST | `/auth/change-password` | AuthController.changePassword | Change password | Yes |
| GET | `/auth/me` | AuthController.getCurrentUser | Get current user info | Yes |
| POST | `/auth/2fa/enable` | AuthController.enable2FA | Enable 2FA | Yes |
| POST | `/auth/2fa/verify` | AuthController.verify2FA | Verify 2FA code | Yes |
| POST | `/auth/2fa/disable` | AuthController.disable2FA | Disable 2FA | Yes |

### Controller Structure: `AuthController.js`

```javascript
// controllers/AuthController.js
class AuthController {
  // POST /api/v1/auth/register
  async register(req, res, next) {
    // Extract: email, password, firstName, lastName, phone
    // Validate input
    // Check if user exists
    // Hash password (bcrypt, 12 rounds)
    // Create user record
    // Send verification email
    // Return: { user, message }
  }

  // POST /api/v1/auth/login
  async login(req, res, next) {
    // Extract: email, password
    // Validate credentials
    // Check 2FA status
    // Generate access token (15 min expiry)
    // Generate refresh token (7 days expiry)
    // Update last login timestamp
    // Return: { accessToken, refreshToken, user }
  }

  // POST /api/v1/auth/refresh
  async refreshToken(req, res, next) {
    // Extract refresh token from body/cookie
    // Verify refresh token
    // Generate new access token
    // Optionally rotate refresh token
    // Return: { accessToken, refreshToken }
  }

  // POST /api/v1/auth/forgot-password
  async forgotPassword(req, res, next) {
    // Extract: email
    // Find user by email
    // Generate reset token (UUID)
    // Store token with expiry (1 hour)
    // Send reset email
    // Return: { message }
  }

  // POST /api/v1/auth/reset-password
  async resetPassword(req, res, next) {
    // Extract: token, newPassword
    // Verify token validity
    // Hash new password
    // Update user password
    // Invalidate all sessions
    // Return: { message }
  }

  // POST /api/v1/auth/verify-email
  async verifyEmail(req, res, next) {
    // Extract: verification token
    // Find user by token
    // Update email_verified status
    // Return: { message }
  }

  // POST /api/v1/auth/change-password
  async changePassword(req, res, next) {
    // Extract: currentPassword, newPassword
    // Verify current password
    // Check password history (prevent reuse)
    // Hash and save new password
    // Return: { message }
  }

  // POST /api/v1/auth/2fa/enable
  async enable2FA(req, res, next) {
    // Generate TOTP secret
    // Generate QR code
    // Store secret (encrypted)
    // Return: { qrCode, secret }
  }

  // POST /api/v1/auth/2fa/verify
  async verify2FA(req, res, next) {
    // Extract: token
    // Verify TOTP token
    // Mark 2FA as enabled
    // Generate backup codes
    // Return: { backupCodes }
  }
}

module.exports = new AuthController();
```

---

## 2. User Management API

### Base Path: `/api/v1/users`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/users` | UserController.getAll | Get all users (paginated) | Yes |
| GET | `/users/:id` | UserController.getById | Get user by ID | Yes |
| POST | `/users` | UserController.create | Create new user | Yes (Admin) |
| PUT | `/users/:id` | UserController.update | Update user | Yes |
| DELETE | `/users/:id` | UserController.delete | Delete user (soft) | Yes (Admin) |
| GET | `/users/:id/profile` | UserController.getProfile | Get user profile | Yes |
| PUT | `/users/:id/profile` | UserController.updateProfile | Update user profile | Yes |
| POST | `/users/invite` | UserController.inviteUser | Send user invitation | Yes (Admin) |
| GET | `/users/search` | UserController.search | Search users | Yes |
| PUT | `/users/:id/activate` | UserController.activate | Activate user | Yes (Admin) |
| PUT | `/users/:id/deactivate` | UserController.deactivate | Deactivate user | Yes (Admin) |
| GET | `/users/:id/activity` | UserController.getActivity | Get user activity log | Yes |

### Controller Structure: `UserController.js`

```javascript
// controllers/UserController.js
class UserController {
  // GET /api/v1/users?page=1&limit=20&role=agent&status=active
  async getAll(req, res, next) {
    // Extract query params: page, limit, filters
    // Apply tenant scoping
    // Apply role-based filtering
    // Paginate results
    // Return: { users, pagination }
  }

  // GET /api/v1/users/:id
  async getById(req, res, next) {
    // Extract: user ID
    // Check permissions
    // Fetch user with profile
    // Return: { user }
  }

  // POST /api/v1/users
  async create(req, res, next) {
    // Extract: email, role, firstName, lastName, etc.
    // Validate permissions (admin only)
    // Validate input
    // Create user
    // Send welcome email
    // Return: { user }
  }

  // PUT /api/v1/users/:id
  async update(req, res, next) {
    // Extract: user ID and update fields
    // Validate permissions
    // Update user record
    // Log activity
    // Return: { user }
  }

  // POST /api/v1/users/invite
  async inviteUser(req, res, next) {
    // Extract: email, role
    // Generate invitation token
    // Create pending user record
    // Send invitation email
    // Return: { invitation }
  }
}
```

---

## 3. Property Management API

### Base Path: `/api/v1/properties`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/properties` | PropertyController.getAll | Get all properties | No (public) |
| GET | `/properties/:id` | PropertyController.getById | Get property details | No (public) |
| POST | `/properties` | PropertyController.create | Create property listing | Yes |
| PUT | `/properties/:id` | PropertyController.update | Update property | Yes |
| DELETE | `/properties/:id` | PropertyController.delete | Delete property | Yes |
| GET | `/properties/search` | PropertyController.search | Advanced property search | No |
| POST | `/properties/:id/media` | PropertyController.uploadMedia | Upload property media | Yes |
| DELETE | `/properties/:id/media/:mediaId` | PropertyController.deleteMedia | Delete media | Yes |
| PUT | `/properties/:id/media/reorder` | PropertyController.reorderMedia | Reorder photos | Yes |
| PUT | `/properties/:id/status` | PropertyController.updateStatus | Update property status | Yes |
| POST | `/properties/:id/favorite` | PropertyController.addToFavorites | Add to favorites | Yes |
| DELETE | `/properties/:id/favorite` | PropertyController.removeFromFavorites | Remove from favorites | Yes |
| GET | `/properties/:id/similar` | PropertyController.getSimilar | Get similar properties | No |
| GET | `/properties/:id/analytics` | PropertyController.getAnalytics | Get property analytics | Yes |
| POST | `/properties/import` | PropertyController.import | Bulk import properties | Yes |
| GET | `/properties/export` | PropertyController.export | Export properties | Yes |

### Controller Structure: `PropertyController.js`

```javascript
// controllers/PropertyController.js
class PropertyController {
  // GET /api/v1/properties?page=1&limit=20&type=house&status=active
  async getAll(req, res, next) {
    // Extract query params
    // Apply tenant scoping (if authenticated)
    // Apply filters
    // Include featured properties first
    // Paginate results
    // Return: { properties, pagination }
  }

  // GET /api/v1/properties/:id
  async getById(req, res, next) {
    // Extract: property ID
    // Fetch property with relations (media, features, location)
    // Increment view count
    // Track analytics
    // Return: { property }
  }

  // POST /api/v1/properties
  async create(req, res, next) {
    // Extract: property data
    // Validate input
    // Create property record
    // Process geocoding for address
    // Create associated records (features, amenities)
    // Return: { property }
  }

  // GET /api/v1/properties/search
  async search(req, res, next) {
    // Extract: search criteria (location, price, beds, baths, etc.)
    // Build Elasticsearch query
    // Apply filters and sorting
    // Execute search
    // Paginate results
    // Return: { properties, facets, pagination }
  }

  // POST /api/v1/properties/:id/media
  async uploadMedia(req, res, next) {
    // Extract: property ID, files
    // Validate file types and sizes
    // Upload to S3/storage
    // Generate thumbnails
    // Create media records
    // Return: { media }
  }

  // PUT /api/v1/properties/:id/status
  async updateStatus(req, res, next) {
    // Extract: property ID, new status
    // Validate status transition
    // Update property status
    // Send notifications
    // Log activity
    // Return: { property }
  }
}
```

---

## 4. CRM & Lead Management API

### Base Path: `/api/v1/leads` and `/api/v1/contacts`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/leads` | LeadController.getAll | Get all leads | Yes |
| GET | `/leads/:id` | LeadController.getById | Get lead details | Yes |
| POST | `/leads` | LeadController.create | Create new lead | Yes |
| PUT | `/leads/:id` | LeadController.update | Update lead | Yes |
| DELETE | `/leads/:id` | LeadController.delete | Delete lead | Yes |
| PUT | `/leads/:id/status` | LeadController.updateStatus | Update lead status | Yes |
| PUT | `/leads/:id/assign` | LeadController.assign | Assign lead to agent | Yes |
| POST | `/leads/:id/notes` | LeadController.addNote | Add note to lead | Yes |
| GET | `/leads/:id/timeline` | LeadController.getTimeline | Get lead activity timeline | Yes |
| POST | `/leads/import` | LeadController.import | Import leads from CSV | Yes |
| POST | `/leads/:id/convert` | LeadController.convertToClient | Convert lead to client | Yes |
| GET | `/contacts` | ContactController.getAll | Get all contacts | Yes |
| GET | `/contacts/:id` | ContactController.getById | Get contact details | Yes |
| POST | `/contacts` | ContactController.create | Create contact | Yes |
| PUT | `/contacts/:id` | ContactController.update | Update contact | Yes |
| DELETE | `/contacts/:id` | ContactController.delete | Delete contact | Yes |
| POST | `/contacts/merge` | ContactController.merge | Merge duplicate contacts | Yes |

### Controller Structure: `LeadController.js`

```javascript
// controllers/LeadController.js
class LeadController {
  // GET /api/v1/leads?status=new&assignedTo=me
  async getAll(req, res, next) {
    // Extract query params
    // Apply tenant and user scoping
    // Apply filters (status, source, date range)
    // Sort by priority/date
    // Paginate results
    // Return: { leads, pagination, stats }
  }

  // POST /api/v1/leads
  async create(req, res, next) {
    // Extract: lead data (name, email, phone, source, etc.)
    // Check for duplicates
    // Calculate lead score
    // Auto-assign based on rules
    // Send notifications
    // Create timeline entry
    // Return: { lead }
  }

  // PUT /api/v1/leads/:id/assign
  async assign(req, res, next) {
    // Extract: lead ID, agent ID
    // Validate agent availability
    // Update assignment
    // Send notification to agent
    // Log activity
    // Return: { lead }
  }

  // POST /api/v1/leads/:id/notes
  async addNote(req, res, next) {
    // Extract: lead ID, note content
    // Create note record
    // Update timeline
    // Send mention notifications
    // Return: { note }
  }

  // POST /api/v1/leads/:id/convert
  async convertToClient(req, res, next) {
    // Extract: lead ID
    // Create contact/client record
    // Transfer all data and history
    // Update lead status to 'converted'
    // Create opportunity
    // Return: { client }
  }
}
```

---

## 5. Transaction Management API

### Base Path: `/api/v1/transactions`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/transactions` | TransactionController.getAll | Get all transactions | Yes |
| GET | `/transactions/:id` | TransactionController.getById | Get transaction details | Yes |
| POST | `/transactions` | TransactionController.create | Create transaction | Yes |
| PUT | `/transactions/:id` | TransactionController.update | Update transaction | Yes |
| DELETE | `/transactions/:id` | TransactionController.delete | Delete transaction | Yes |
| PUT | `/transactions/:id/stage` | TransactionController.updateStage | Update transaction stage | Yes |
| POST | `/transactions/:id/offers` | TransactionController.addOffer | Add offer | Yes |
| PUT | `/transactions/:id/offers/:offerId` | TransactionController.updateOffer | Update offer | Yes |
| GET | `/transactions/:id/timeline` | TransactionController.getTimeline | Get transaction timeline | Yes |
| POST | `/transactions/:id/checklist` | TransactionController.addChecklistItem | Add checklist item | Yes |
| PUT | `/transactions/:id/checklist/:itemId` | TransactionController.updateChecklistItem | Update checklist | Yes |
| GET | `/transactions/:id/commission` | TransactionController.calculateCommission | Calculate commission | Yes |
| PUT | `/transactions/:id/close` | TransactionController.closeTransaction | Close transaction | Yes |

### Controller Structure: `TransactionController.js`

```javascript
// controllers/TransactionController.js
class TransactionController {
  // GET /api/v1/transactions?status=under_contract
  async getAll(req, res, next) {
    // Extract query params
    // Apply user/team filtering
    // Apply status filters
    // Include property and client data
    // Calculate pipeline value
    // Return: { transactions, stats }
  }

  // POST /api/v1/transactions
  async create(req, res, next) {
    // Extract: property, buyer, seller, offer details
    // Validate property availability
    // Create transaction record
    // Initialize checklist from template
    // Calculate commission
    // Send notifications
    // Return: { transaction }
  }

  // PUT /api/v1/transactions/:id/stage
  async updateStage(req, res, next) {
    // Extract: transaction ID, new stage
    // Validate stage transition
    // Update transaction
    // Update timeline
    // Trigger automation (emails, tasks)
    // Return: { transaction }
  }

  // GET /api/v1/transactions/:id/commission
  async calculateCommission(req, res, next) {
    // Extract: transaction ID
    // Fetch transaction and splits
    // Calculate gross commission
    // Calculate agent splits
    // Calculate brokerage split
    // Return: { commission breakdown }
  }

  // PUT /api/v1/transactions/:id/close
  async closeTransaction(req, res, next) {
    // Extract: transaction ID, closing details
    // Validate all checklist items complete
    // Update property status to sold
    // Record commission
    // Generate closing documents
    // Send congratulations emails
    // Return: { transaction }
  }
}
```

---

## 6. Document Management API

### Base Path: `/api/v1/documents`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/documents` | DocumentController.getAll | Get all documents | Yes |
| GET | `/documents/:id` | DocumentController.getById | Get document details | Yes |
| POST | `/documents/upload` | DocumentController.upload | Upload document | Yes |
| PUT | `/documents/:id` | DocumentController.update | Update document metadata | Yes |
| DELETE | `/documents/:id` | DocumentController.delete | Delete document | Yes |
| GET | `/documents/:id/download` | DocumentController.download | Download document | Yes |
| POST | `/documents/:id/share` | DocumentController.createShareLink | Create share link | Yes |
| GET | `/documents/:id/versions` | DocumentController.getVersions | Get document versions | Yes |
| POST | `/documents/:id/sign` | DocumentController.initiateSignature | Initiate e-signature | Yes |
| GET | `/documents/templates` | DocumentController.getTemplates | Get document templates | Yes |
| POST | `/documents/templates/:id/generate` | DocumentController.generateFromTemplate | Generate from template | Yes |

### Controller Structure: `DocumentController.js`

```javascript
// controllers/DocumentController.js
class DocumentController {
  // POST /api/v1/documents/upload
  async upload(req, res, next) {
    // Extract: file, metadata (category, tags, related_to)
    // Validate file type and size
    // Scan for viruses (optional)
    // Upload to S3
    // Create document record
    // Extract metadata (PDF: pages, size, etc.)
    // Return: { document }
  }

  // GET /api/v1/documents/:id/download
  async download(req, res, next) {
    // Extract: document ID
    // Check permissions
    // Generate signed URL (S3)
    // Log download activity
    // Return: { downloadUrl }
  }

  // POST /api/v1/documents/:id/share
  async createShareLink(req, res, next) {
    // Extract: document ID, expiry, password
    // Generate unique share token
    // Create share record
    // Return: { shareUrl, expiresAt }
  }

  // POST /api/v1/documents/:id/sign
  async initiateSignature(req, res, next) {
    // Extract: document ID, signers
    // Upload to DocuSign/HelloSign
    // Create signature envelope
    // Send signature requests
    // Return: { envelopeId, status }
  }

  // POST /api/v1/documents/templates/:id/generate
  async generateFromTemplate(req, res, next) {
    // Extract: template ID, merge data
    // Load template
    // Merge data into template
    // Generate PDF
    // Save as new document
    // Return: { document }
  }
}
```

---

## 7. Communication API

### Base Path: `/api/v1/communications`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| POST | `/communications/email/send` | CommunicationController.sendEmail | Send email | Yes |
| GET | `/communications/email/threads` | CommunicationController.getEmailThreads | Get email threads | Yes |
| POST | `/communications/sms/send` | CommunicationController.sendSMS | Send SMS | Yes |
| GET | `/communications/sms/conversations` | CommunicationController.getSMSConversations | Get SMS conversations | Yes |
| POST | `/communications/calls/initiate` | CommunicationController.initiateCall | Start phone call | Yes |
| GET | `/communications/calls/history` | CommunicationController.getCallHistory | Get call history | Yes |
| POST | `/communications/notifications/send` | CommunicationController.sendNotification | Send notification | Yes |
| GET | `/communications/notifications` | CommunicationController.getNotifications | Get user notifications | Yes |
| PUT | `/communications/notifications/:id/read` | CommunicationController.markAsRead | Mark notification as read | Yes |

### Controller Structure: `CommunicationController.js`

```javascript
// controllers/CommunicationController.js
class CommunicationController {
  // POST /api/v1/communications/email/send
  async sendEmail(req, res, next) {
    // Extract: to, subject, body, template, attachments
    // Validate recipients
    // Render email template
    // Send via SendGrid
    // Track email (opens, clicks)
    // Log communication
    // Return: { messageId, status }
  }

  // POST /api/v1/communications/sms/send
  async sendSMS(req, res, next) {
    // Extract: to, message, fromNumber
    // Validate phone number
    // Check SMS credits
    // Send via Twilio
    // Log communication
    // Return: { messageId, status }
  }

  // POST /api/v1/communications/calls/initiate
  async initiateCall(req, res, next) {
    // Extract: to, from
    // Initiate Twilio call
    // Create call record
    // Start call recording
    // Return: { callId, status }
  }

  // GET /api/v1/communications/notifications
  async getNotifications(req, res, next) {
    // Get user ID from auth
    // Fetch unread notifications
    // Fetch recent read notifications
    // Group by type
    // Return: { notifications, unreadCount }
  }
}
```

---

## 8. Marketing API

### Base Path: `/api/v1/marketing`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/marketing/campaigns` | MarketingController.getCampaigns | Get all campaigns | Yes |
| GET | `/marketing/campaigns/:id` | MarketingController.getCampaign | Get campaign details | Yes |
| POST | `/marketing/campaigns` | MarketingController.createCampaign | Create campaign | Yes |
| PUT | `/marketing/campaigns/:id` | MarketingController.updateCampaign | Update campaign | Yes |
| POST | `/marketing/campaigns/:id/send` | MarketingController.sendCampaign | Send/schedule campaign | Yes |
| GET | `/marketing/campaigns/:id/stats` | MarketingController.getCampaignStats | Get campaign analytics | Yes |
| GET | `/marketing/templates` | MarketingController.getTemplates | Get email templates | Yes |
| POST | `/marketing/social/schedule` | MarketingController.schedulePost | Schedule social post | Yes |
| GET | `/marketing/social/posts` | MarketingController.getSocialPosts | Get scheduled posts | Yes |
| DELETE | `/marketing/social/posts/:id` | MarketingController.deleteSocialPost | Delete scheduled post | Yes |

---

## 9. Reporting & Analytics API

### Base Path: `/api/v1/reports`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/reports/dashboard` | ReportController.getDashboard | Get dashboard metrics | Yes |
| GET | `/reports/properties` | ReportController.getPropertyReport | Property performance report | Yes |
| GET | `/reports/sales` | ReportController.getSalesReport | Sales report | Yes |
| GET | `/reports/leads` | ReportController.getLeadReport | Lead conversion report | Yes |
| GET | `/reports/agents` | ReportController.getAgentReport | Agent performance | Yes |
| GET | `/reports/financial` | ReportController.getFinancialReport | Financial report | Yes |
| POST | `/reports/custom` | ReportController.generateCustomReport | Generate custom report | Yes |
| POST | `/reports/:id/export` | ReportController.exportReport | Export report (PDF/Excel) | Yes |
| GET | `/analytics/events` | AnalyticsController.trackEvent | Track analytics event | Yes |

---

## 10. Subscription & Billing API

### Base Path: `/api/v1/billing`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/billing/subscription` | BillingController.getSubscription | Get current subscription | Yes |
| POST | `/billing/subscription/upgrade` | BillingController.upgradeSubscription | Upgrade plan | Yes |
| POST | `/billing/subscription/downgrade` | BillingController.downgradeSubscription | Downgrade plan | Yes |
| POST | `/billing/subscription/cancel` | BillingController.cancelSubscription | Cancel subscription | Yes |
| GET | `/billing/invoices` | BillingController.getInvoices | Get invoice history | Yes |
| GET | `/billing/invoices/:id` | BillingController.getInvoice | Get invoice details | Yes |
| GET | `/billing/payment-methods` | BillingController.getPaymentMethods | Get payment methods | Yes |
| POST | `/billing/payment-methods` | BillingController.addPaymentMethod | Add payment method | Yes |
| PUT | `/billing/payment-methods/:id/default` | BillingController.setDefaultPaymentMethod | Set default payment | Yes |
| DELETE | `/billing/payment-methods/:id` | BillingController.deletePaymentMethod | Delete payment method | Yes |
| POST | `/billing/apply-coupon` | BillingController.applyCoupon | Apply coupon code | Yes |

### Controller Structure: `BillingController.js`

```javascript
// controllers/BillingController.js
class BillingController {
  // POST /api/v1/billing/subscription/upgrade
  async upgradeSubscription(req, res, next) {
    // Extract: new plan ID
    // Get current subscription
    // Calculate proration
    // Create Stripe subscription update
    // Update database
    // Send confirmation email
    // Return: { subscription, prorationAmount }
  }

  // POST /api/v1/billing/payment-methods
  async addPaymentMethod(req, res, next) {
    // Extract: Stripe payment method ID
    // Attach to Stripe customer
    // Save payment method
    // Return: { paymentMethod }
  }

  // POST /api/v1/billing/apply-coupon
  async applyCoupon(req, res, next) {
    // Extract: coupon code
    // Validate coupon
    // Check eligibility
    // Apply to subscription
    // Return: { discount, newAmount }
  }
}
```

---

## 11. Settings API

### Base Path: `/api/v1/settings`

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/settings/tenant` | SettingsController.getTenantSettings | Get tenant settings | Yes |
| PUT | `/settings/tenant` | SettingsController.updateTenantSettings | Update tenant settings | Yes (Admin) |
| GET | `/settings/branding` | SettingsController.getBranding | Get branding settings | Yes |
| PUT | `/settings/branding` | SettingsController.updateBranding | Update branding | Yes (Admin) |
| POST | `/settings/branding/logo` | SettingsController.uploadLogo | Upload logo | Yes (Admin) |
| GET | `/settings/integrations` | SettingsController.getIntegrations | Get integration settings | Yes |
| PUT | `/settings/integrations/:name` | SettingsController.updateIntegration | Update integration | Yes (Admin) |
| POST | `/settings/custom-domain` | SettingsController.addCustomDomain | Add custom domain | Yes (Owner) |
| GET | `/settings/notifications` | SettingsController.getNotificationPreferences | Get notification prefs | Yes |
| PUT | `/settings/notifications` | SettingsController.updateNotificationPreferences | Update notification prefs | Yes |

---

## 12. Admin API

### Base Path: `/api/v1/admin` (Super Admin Only)

| Method | Endpoint | Controller Method | Description | Auth Required |
|--------|----------|------------------|-------------|---------------|
| GET | `/admin/tenants` | AdminController.getTenants | Get all tenants | Super Admin |
| GET | `/admin/tenants/:id` | AdminController.getTenant | Get tenant details | Super Admin |
| PUT | `/admin/tenants/:id/suspend` | AdminController.suspendTenant | Suspend tenant | Super Admin |
| PUT | `/admin/tenants/:id/activate` | AdminController.activateTenant | Activate tenant | Super Admin |
| DELETE | `/admin/tenants/:id` | AdminController.deleteTenant | Delete tenant | Super Admin |
| GET | `/admin/analytics` | AdminController.getPlatformAnalytics | Platform analytics | Super Admin |
| GET | `/admin/revenue` | AdminController.getRevenueMetrics | Revenue metrics | Super Admin |
| POST | `/admin/impersonate/:tenantId` | AdminController.impersonate | Impersonate tenant | Super Admin |

---

## Request/Response Formats

### Standard Success Response
```json
{
  "success": true,
  "data": {
    // Response data
  },
  "message": "Operation successful",
  "timestamp": "2025-11-15T10:30:00Z"
}
```

### Paginated Response
```json
{
  "success": true,
  "data": [
    // Array of items
  ],
  "pagination": {
    "page": 1,
    "limit": 20,
    "total": 150,
    "pages": 8,
    "hasNext": true,
    "hasPrev": false
  },
  "timestamp": "2025-11-15T10:30:00Z"
}
```

### Error Response
```json
{
  "success": false,
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Validation failed",
    "details": [
      {
        "field": "email",
        "message": "Email is required"
      }
    ]
  },
  "timestamp": "2025-11-15T10:30:00Z"
}
```

---

## Error Handling

### Error Codes

| Code | HTTP Status | Description |
|------|-------------|-------------|
| VALIDATION_ERROR | 400 | Request validation failed |
| UNAUTHORIZED | 401 | Authentication required |
| FORBIDDEN | 403 | Insufficient permissions |
| NOT_FOUND | 404 | Resource not found |
| CONFLICT | 409 | Resource conflict (duplicate) |
| RATE_LIMIT_EXCEEDED | 429 | Too many requests |
| INTERNAL_ERROR | 500 | Server error |
| SERVICE_UNAVAILABLE | 503 | Service temporarily unavailable |

### Error Middleware Structure

```javascript
// middleware/errorHandler.js
class ErrorHandler {
  static handle(err, req, res, next) {
    const statusCode = err.statusCode || 500;
    const errorCode = err.code || 'INTERNAL_ERROR';

    const response = {
      success: false,
      error: {
        code: errorCode,
        message: err.message,
        ...(err.details && { details: err.details }),
        ...(process.env.NODE_ENV === 'development' && { stack: err.stack })
      },
      timestamp: new Date().toISOString()
    };

    // Log error
    logger.error(err);

    res.status(statusCode).json(response);
  }
}
```

---

## Rate Limiting

### Rate Limit Rules

| Endpoint Pattern | Limit | Window | Scope |
|-----------------|-------|--------|-------|
| `/api/v1/auth/login` | 5 requests | 15 minutes | IP address |
| `/api/v1/auth/*` | 10 requests | 15 minutes | IP address |
| `/api/v1/*` (authenticated) | 1000 requests | 1 hour | User |
| `/api/v1/*` (public) | 100 requests | 15 minutes | IP address |
| `/api/v1/properties/search` | 60 requests | 1 minute | User/IP |

### Rate Limit Headers
```
X-RateLimit-Limit: 1000
X-RateLimit-Remaining: 995
X-RateLimit-Reset: 1699876543
```

### Rate Limit Exceeded Response
```json
{
  "success": false,
  "error": {
    "code": "RATE_LIMIT_EXCEEDED",
    "message": "Too many requests. Please try again later.",
    "retryAfter": 3600
  },
  "timestamp": "2025-11-15T10:30:00Z"
}
```

---

## Webhooks

### Webhook Events

| Event | Description | Payload |
|-------|-------------|---------|
| `lead.created` | New lead created | Lead object |
| `lead.assigned` | Lead assigned to agent | Lead + assignment |
| `property.created` | New property listed | Property object |
| `property.status_changed` | Property status updated | Property + old/new status |
| `transaction.stage_changed` | Transaction stage updated | Transaction + stage |
| `transaction.closed` | Transaction closed | Transaction object |
| `payment.succeeded` | Payment successful | Payment object |
| `payment.failed` | Payment failed | Payment + error |
| `subscription.updated` | Subscription changed | Subscription object |
| `subscription.cancelled` | Subscription cancelled | Subscription object |

### Webhook Payload Format
```json
{
  "event": "lead.created",
  "data": {
    // Event-specific data
  },
  "timestamp": "2025-11-15T10:30:00Z",
  "webhookId": "wh_1234567890",
  "tenantId": "tenant_abc123"
}
```

### Webhook Security
- HMAC signature verification
- Retry policy: 3 attempts with exponential backoff
- Timeout: 30 seconds
- Webhook secret configuration per tenant

---

## API Versioning

### Current Version: v1
All endpoints are prefixed with `/api/v1/`

### Future Versions
When breaking changes are needed:
- New version: `/api/v2/`
- Maintain v1 for 12 months
- Deprecation warnings in headers
- Migration guide provided

---

## SDK & Client Libraries

### Official SDKs
- JavaScript/TypeScript SDK
- PHP SDK
- Python SDK
- Ruby SDK

### Code Example (JavaScript SDK)
```javascript
import RealEstateSaaS from '@yourdomain/sdk';

const client = new RealEstateSaaS({
  apiKey: 'your-api-key',
  tenantId: 'your-tenant-id'
});

// Get properties
const properties = await client.properties.list({
  status: 'active',
  type: 'house',
  page: 1,
  limit: 20
});

// Create a lead
const lead = await client.leads.create({
  firstName: 'John',
  lastName: 'Doe',
  email: 'john@example.com',
  phone: '+1234567890',
  source: 'website'
});
```

---

## Testing the API

### Postman Collection
Import the Postman collection: [Download Link]

### Swagger/OpenAPI Documentation
Interactive API documentation: `https://api.yourdomain.com/docs`

### Sample cURL Requests

#### Login
```bash
curl -X POST https://api.yourdomain.com/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "user@example.com",
    "password": "password123"
  }'
```

#### Get Properties
```bash
curl -X GET "https://api.yourdomain.com/v1/properties?page=1&limit=20" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

#### Create Property
```bash
curl -X POST https://api.yourdomain.com/v1/properties \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Beautiful Family Home",
    "type": "house",
    "listingType": "sale",
    "price": 450000,
    "address": {
      "street": "123 Main St",
      "city": "San Francisco",
      "state": "CA",
      "zip": "94102"
    },
    "bedrooms": 4,
    "bathrooms": 3,
    "sqft": 2500
  }'
```

---

**API Version**: 1.0.0
**Last Updated**: 2025-11-15
**Support**: api-support@yourdomain.com
