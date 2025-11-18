# Real Estate SaaS Platform - High-Level Architecture

**Version:** 1.0
**Last Updated:** 2025-11-16
**Platform:** Laravel 11 Multi-Tenant SaaS
**Target Deployment:** Shared Hosting (cPanel) Compatible

---

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [System Context](#system-context)
3. [Technology Stack](#technology-stack)
4. [Multi-Tenancy Architecture](#multi-tenancy-architecture)
5. [Application Layers](#application-layers)
6. [Data Architecture](#data-architecture)
7. [Security Architecture](#security-architecture)
8. [Deployment Architecture](#deployment-architecture)
9. [Scalability Considerations](#scalability-considerations)
10. [Development Workflow](#development-workflow)

---

## Architecture Overview

### Executive Summary

The Real Estate SaaS Platform is a **monolithic multi-tenant application** built with Laravel 11, designed to enable real estate agencies to manage their operations, listings, clients, and public-facing websites from a single unified platform.

### Core Principles

1. **Multi-Tenancy First**: Every feature designed with tenant isolation in mind
2. **Shared Hosting Compatible**: No Docker, Redis, or complex infrastructure required
3. **Marketplace Ready**: CodeCanyon compliant with easy installation
4. **Modular Design**: Clean separation of concerns for maintainability
5. **Security by Default**: Built-in protection against common vulnerabilities

### Architecture Pattern

```
┌─────────────────────────────────────────────────────────────────┐
│                   MONOLITHIC ARCHITECTURE                        │
│                    Single Laravel Application                    │
└─────────────────────────────────────────────────────────────────┘
                              │
        ┌─────────────────────┼─────────────────────┐
        │                     │                     │
   ┌────▼────┐          ┌────▼────┐          ┌────▼────┐
   │  Public │          │ Agency  │          │  Super  │
   │   Site  │          │Dashboard│          │  Admin  │
   │         │          │(Tenants)│          │  Panel  │
   └─────────┘          └─────────┘          └─────────┘
        │                     │                     │
        └─────────────────────┼─────────────────────┘
                              │
                    ┌─────────▼─────────┐
                    │   MySQL Database   │
                    │  (Single Database) │
                    │   tenant_id based  │
                    └────────────────────┘
```

---

## System Context

### High-Level System Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                         USERS & ACTORS                           │
├─────────────────┬─────────────────┬─────────────────────────────┤
│ Platform Owner  │  Agency Admin   │  Realtor    │  Client       │
│ (Super Admin)   │  (Tenant Owner) │  (Employee) │  (Customer)   │
└────────┬────────┴────────┬────────┴──────┬──────┴───────┬───────┘
         │                 │               │              │
         │                 │               │              │
┌────────▼─────────────────▼───────────────▼──────────────▼────────┐
│                                                                   │
│                     WEB/HTTP INTERFACE                            │
│             (Subdomain/Path-based Routing)                        │
│                                                                   │
├───────────────────────────────────────────────────────────────────┤
│                                                                   │
│               LARAVEL 11 APPLICATION CORE                         │
│                                                                   │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐           │
│  │   Routing    │  │ Middleware   │  │ Controllers  │           │
│  └──────┬───────┘  └──────┬───────┘  └──────┬───────┘           │
│         │                 │                  │                   │
│  ┌──────▼─────────────────▼──────────────────▼───────┐           │
│  │          BUSINESS LOGIC LAYER                     │           │
│  │    (Services, Repositories, Domain Logic)         │           │
│  └──────┬────────────────────────────────────────────┘           │
│         │                                                         │
│  ┌──────▼─────────────────────────────────────┐                  │
│  │   DATA ACCESS LAYER (Eloquent ORM)        │                  │
│  │   - Models with Relationships              │                  │
│  │   - Global Tenant Scopes                   │                  │
│  │   - Query Builders                         │                  │
│  └──────┬─────────────────────────────────────┘                  │
│         │                                                         │
└─────────┼─────────────────────────────────────────────────────────┘
          │
┌─────────▼─────────────────────────────────────────────────────────┐
│                      DATA PERSISTENCE LAYER                       │
├───────────────────┬───────────────────┬───────────────────────────┤
│   MySQL Database  │  File Storage     │  Cache (File/Database)   │
│   (Primary Data)  │  (Media/Docs)     │  (Session/App Cache)     │
└───────────────────┴───────────────────┴───────────────────────────┘
          │                   │                     │
┌─────────▼───────────────────▼─────────────────────▼───────────────┐
│                    EXTERNAL SERVICES                              │
├──────────────┬──────────────┬──────────────┬─────────────────────┤
│   Stripe     │   Paystack   │  Email SMTP  │  S3 (Optional)      │
│  (Payments)  │  (Payments)  │  (Mailgun)   │  (File Storage)     │
└──────────────┴──────────────┴──────────────┴─────────────────────┘
```

### User Roles & Access Patterns

```
┌──────────────────────────────────────────────────────────────┐
│                      ROLE HIERARCHY                           │
└──────────────────────────────────────────────────────────────┘

Level 1: Super Admin (Platform Owner)
├── Access: Global (all tenants)
├── URL: admin.{domain}.com
└── Capabilities:
    ├── Manage all agencies
    ├── Create/edit subscription plans
    ├── Manage themes
    ├── View global analytics
    └── System configuration

Level 2: Agency Admin (Tenant Owner)
├── Access: Agency-wide (single tenant)
├── URL: app.{domain}.com or {agency-slug}.{domain}.com/dashboard
└── Capabilities:
    ├── Manage agency settings
    ├── Manage team members (realtors)
    ├── Manage all properties
    ├── Manage all leads and clients
    ├── View agency analytics
    ├── Customize website theme
    └── Subscription management

Level 3: Realtor (Agency Employee)
├── Access: Assigned data + own data
├── URL: {agency-slug}.{domain}.com/dashboard
└── Capabilities:
    ├── Manage assigned leads
    ├── Manage assigned clients
    ├── Create/edit own properties
    ├── Schedule appointments
    ├── Track followups
    └── View own performance

Level 4: Client (Customer)
├── Access: Own data only
├── URL: {agency-slug}.{domain}.com/portal
└── Capabilities:
    ├── View own properties
    ├── Download documents
    ├── View payment history
    ├── E-sign contracts
    └── Submit support tickets
```

---

## Technology Stack

### Backend Technologies

```
┌────────────────────────────────────────────────────────────┐
│                    BACKEND STACK                            │
├─────────────────────┬──────────────────────────────────────┤
│ Component           │ Technology                           │
├─────────────────────┼──────────────────────────────────────┤
│ Framework           │ Laravel 11 (PHP 8.2+)               │
│ Language            │ PHP 8.2+                             │
│ ORM                 │ Eloquent                             │
│ Database            │ MySQL 8.0+                           │
│ Authentication      │ Laravel Sanctum/Session              │
│ Authorization       │ Custom RBAC (Roles & Permissions)    │
│ Queue System        │ Database Queue                       │
│ Cache Driver        │ File/Database (No Redis required)    │
│ Session Storage     │ Database                             │
│ File Storage        │ Local + S3 (configurable)            │
│ Email               │ SMTP/Mailgun/SES                     │
│ Payment Gateways    │ Stripe + Paystack                    │
└─────────────────────┴──────────────────────────────────────┘
```

### Frontend Technologies

```
┌────────────────────────────────────────────────────────────┐
│                    FRONTEND STACK                           │
├─────────────────────┬──────────────────────────────────────┤
│ Component           │ Technology                           │
├─────────────────────┼──────────────────────────────────────┤
│ Templating Engine   │ Blade Templates                      │
│ Reactive Components │ Livewire 3                           │
│ CSS Framework       │ Tailwind CSS                         │
│ JavaScript          │ Alpine.js (minimal)                  │
│ Charts/Analytics    │ Chart.js                             │
│ File Upload         │ FilePond/Dropzone                    │
│ Date Picker         │ Flatpickr                            │
│ Rich Text Editor    │ TinyMCE/Quill                        │
│ Build Tool          │ Vite (optional, pre-compiled)        │
└─────────────────────┴──────────────────────────────────────┘
```

### Why This Stack?

| Decision | Reason |
|----------|--------|
| **Laravel 11** | Modern PHP framework with excellent SaaS features |
| **Blade + Livewire** | No build process required, shared hosting friendly |
| **MySQL** | Universal hosting support, reliable, well-documented |
| **Database Queue** | No Redis dependency, works on basic hosting |
| **File Cache** | Shared hosting compatible, no external services |
| **Tailwind CSS** | Utility-first, easy to customize per tenant |
| **Vite (optional)** | Can ship pre-compiled assets for no-build deployment |

---

## Multi-Tenancy Architecture

### Tenant Identification Strategy

The platform uses a **hybrid tenant identification** approach:

```
┌─────────────────────────────────────────────────────────────┐
│              TENANT RESOLUTION FLOW                          │
└─────────────────────────────────────────────────────────────┘

HTTP Request
    │
    ▼
┌────────────────────────────────────────┐
│  TenantIdentification Middleware       │
└────────────────────────────────────────┘
    │
    ├─► Method 1: Subdomain Detection
    │   agency-abc.domain.com → tenant: agency-abc
    │
    ├─► Method 2: Path-based Detection
    │   domain.com/agency/agency-abc → tenant: agency-abc
    │
    └─► Method 3: Session-based (Authenticated)
        session('tenant_id') → tenant: ID from session
    │
    ▼
┌────────────────────────────────────────┐
│  Set Tenant Context                    │
│  - app()->instance('tenant', $agency)  │
│  - session(['tenant_id' => $id])       │
│  - config(['app.tenant_id' => $id])    │
└────────────────────────────────────────┘
    │
    ▼
┌────────────────────────────────────────┐
│  Apply Global Scopes to Eloquent       │
│  - All queries filtered by tenant_id   │
└────────────────────────────────────────┘
    │
    ▼
Request continues to Controller
```

### Data Isolation Pattern

```
┌──────────────────────────────────────────────────────────────┐
│                  SHARED DATABASE SCHEMA                       │
└──────────────────────────────────────────────────────────────┘

Central Tables (NO tenant_id)        Tenant Tables (WITH tenant_id)
┌──────────────────────┐             ┌──────────────────────┐
│ • users              │             │ • leads              │
│ • agencies           │             │ • clients            │
│ • roles              │             │ • properties         │
│ • permissions        │             │ • transactions       │
│ • subscription_plans │             │ • payments           │
│ • themes             │             │ • documents          │
└──────────────────────┘             │ • pages              │
                                     │ • blog_posts         │
                                     └──────────────────────┘

┌──────────────────────────────────────────────────────────────┐
│                   TENANT SCOPE MECHANISM                      │
└──────────────────────────────────────────────────────────────┘

Without Scope:
SELECT * FROM properties;
→ Returns ALL properties (security risk!)

With Global Scope (Automatic):
SELECT * FROM properties WHERE tenant_id = 1;
→ Returns only Agency #1's properties ✓

Super Admin Override:
Property::withoutGlobalScope(TenantScope::class)->get();
→ Returns all properties for platform management
```

### Tenant Model Inheritance

```php
┌──────────────────────────────────────────────────────────────┐
│               TENANT-SCOPED MODEL HIERARCHY                   │
└──────────────────────────────────────────────────────────────┘

                    Model (Laravel)
                         │
                         ▼
                  TenantScoped
              (Abstract Base Model)
                         │
        ┌────────────────┼────────────────┐
        │                │                │
        ▼                ▼                ▼
    Property          Lead            Client

Features:
✓ Automatic tenant_id on create
✓ Global scope applied to all queries
✓ tenant() relationship defined
✓ Consistent behavior across models
```

---

## Application Layers

### Layered Architecture

```
┌──────────────────────────────────────────────────────────────┐
│                    PRESENTATION LAYER                         │
│  Routes → Middleware → Controllers → Views (Blade/Livewire)  │
└──────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌──────────────────────────────────────────────────────────────┐
│                   APPLICATION LAYER                           │
│     Services, Actions, Jobs, Events, Listeners               │
└──────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌──────────────────────────────────────────────────────────────┐
│                      DOMAIN LAYER                             │
│         Models, Repositories, Policies, Validators           │
└──────────────────────────────────────────────────────────────┘
                            │
                            ▼
┌──────────────────────────────────────────────────────────────┐
│                  INFRASTRUCTURE LAYER                         │
│    Database, Cache, Queue, File Storage, External APIs       │
└──────────────────────────────────────────────────────────────┘
```

### Request Flow

```
┌──────────────────────────────────────────────────────────────┐
│                   TYPICAL REQUEST FLOW                        │
└──────────────────────────────────────────────────────────────┘

1. User Request
   https://prime-properties.domain.com/properties

2. Web Server (Apache/Nginx)
   ├─► Handles static files
   └─► Forwards PHP requests to Laravel

3. Laravel Router
   ├─► Matches route pattern
   └─► Loads route middleware stack

4. Middleware Pipeline
   ├─► EncryptCookies
   ├─► VerifyCsrfToken
   ├─► TenantIdentification ← Sets tenant context
   ├─► Authenticate ← Checks if logged in
   └─► CheckRole ← Verifies permissions

5. Controller
   ├─► Validates request data
   └─► Delegates to Service layer

6. Service Layer
   ├─► Business logic execution
   ├─► Calls Repository/Model
   └─► Dispatches events/jobs

7. Repository/Model (Eloquent)
   ├─► Applies TenantScope automatically
   ├─► Executes database queries
   └─► Returns Eloquent collections

8. Controller (continued)
   ├─► Prepares response data
   └─► Returns view or JSON

9. View Rendering
   ├─► Blade template compilation
   ├─► Livewire component rendering
   └─► Theme-aware output

10. Response
    └─► HTML/JSON sent to browser
```

### Modular Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── SuperAdmin/      # Platform management
│   │   ├── Agency/          # Agency admin features
│   │   ├── Realtor/         # Realtor features
│   │   ├── Client/          # Client portal
│   │   └── Website/         # Public agency sites
│   │
│   ├── Middleware/
│   │   ├── TenantIdentification.php
│   │   ├── CheckRole.php
│   │   ├── CheckPermission.php
│   │   └── CheckSubscription.php
│   │
│   └── Requests/           # Form validation requests
│
├── Models/                 # Eloquent models
│   ├── TenantScoped.php   # Base tenant model
│   ├── Agency.php
│   ├── User.php
│   ├── Property.php
│   ├── Lead.php
│   └── ...
│
├── Services/              # Business logic
│   ├── TenantService.php
│   ├── PropertyService.php
│   ├── LeadService.php
│   ├── PaymentService.php
│   └── SubscriptionService.php
│
├── Repositories/          # Data access abstraction (optional)
│   ├── PropertyRepository.php
│   ├── LeadRepository.php
│   └── ...
│
├── Policies/              # Authorization policies
│   ├── PropertyPolicy.php
│   ├── LeadPolicy.php
│   └── ...
│
├── Scopes/                # Eloquent global scopes
│   └── TenantScope.php
│
├── Events/                # Domain events
│   ├── LeadConverted.php
│   ├── PropertyPublished.php
│   └── SubscriptionExpired.php
│
├── Listeners/             # Event listeners
│   ├── SendLeadNotification.php
│   ├── UpdatePropertyStatus.php
│   └── NotifySubscriptionExpiry.php
│
├── Jobs/                  # Queue jobs
│   ├── ProcessPropertyImages.php
│   ├── SendBulkEmail.php
│   └── GenerateInvoice.php
│
└── Providers/
    ├── AppServiceProvider.php
    ├── AuthServiceProvider.php
    └── EventServiceProvider.php
```

---

## Data Architecture

### Database Design Philosophy

1. **Single Shared Database** - All tenants in one database
2. **Tenant Isolation via tenant_id** - Column-based separation
3. **Strategic Indexing** - Performance optimization for multi-tenant queries
4. **Soft Deletes** - Data recovery and audit trails
5. **Normalized Structure** - Reduce redundancy, maintain integrity

### Entity Relationship Overview

```
┌──────────────────────────────────────────────────────────────┐
│                  CORE DOMAIN ENTITIES                         │
└──────────────────────────────────────────────────────────────┘

    Agency (Tenant)
         │
         ├──────── has many ────────► Users
         │                              │
         │                              ├─► Super Admin
         │                              ├─► Agency Admin
         │                              ├─► Realtor
         │                              └─► Client
         │
         ├──────── has many ────────► Leads
         │                              │
         │                              └─► can convert to ─► Client
         │
         ├──────── has many ────────► Properties
         │                              │
         │                              ├─► PropertyMedia
         │                              ├─► PropertyDocuments
         │                              └─► PropertyFeatures
         │
         ├──────── has many ────────► Transactions
         │                              │
         │                              ├─► involves ─► Property
         │                              ├─► involves ─► Client
         │                              ├─► involves ─► Realtor
         │                              └─► has many ─► Payments
         │
         ├──────── has many ────────► Pages (Website Builder)
         │
         ├──────── has many ────────► BlogPosts
         │
         ├──────── has one  ────────► AgencySettings
         │
         └──────── has many ────────► Subscriptions
                                        │
                                        └─► belongs to ─► SubscriptionPlan
```

### Data Flow Patterns

#### Property Listing Flow

```
┌─────────────────────────────────────────────────────────────┐
│            PROPERTY LISTING DATA FLOW                        │
└─────────────────────────────────────────────────────────────┘

1. Realtor creates property (Draft)
   └─► properties table (status: draft, is_published: false)

2. Upload media
   └─► property_media table (images, videos, 360 views)

3. Upload documents
   └─► property_documents table (deeds, surveys)

4. Add features/amenities
   └─► property_features table

5. Agency Admin reviews & publishes
   └─► properties.is_published = true
   └─► properties.published_at = now()

6. Property appears on agency website
   └─► Public query: WHERE is_published = true AND status = 'available'

7. Visitor views property
   └─► properties.view_count incremented
   └─► activity_logs table (tracking)

8. Visitor submits inquiry
   └─► inquiries table (lead capture)
   └─► leads table (CRM entry)
```

#### Lead to Client Conversion Flow

```
┌─────────────────────────────────────────────────────────────┐
│         LEAD TO CLIENT CONVERSION DATA FLOW                  │
└─────────────────────────────────────────────────────────────┘

1. Lead captured
   └─► leads table (status: new)

2. Assigned to realtor
   └─► leads.assigned_to = realtor_id

3. Followups logged
   └─► followups table (calls, meetings, site visits)

4. Appointments scheduled
   └─► appointments table

5. Lead qualified and converted
   └─► clients table created
   └─► clients.converted_from_lead_id = lead.id
   └─► leads.status = 'won'
   └─► leads.converted_at = now()

6. Optional: User account created
   └─► users table (if client needs portal access)
   └─► clients.user_id = user.id
   └─► role_user (assign 'client' role)
```

---

## Security Architecture

### Security Layers

```
┌──────────────────────────────────────────────────────────────┐
│                  SECURITY ARCHITECTURE                        │
└──────────────────────────────────────────────────────────────┘

Layer 1: Network Security
├─► HTTPS/TLS encryption
├─► Firewall rules
└─► DDoS protection (if available)

Layer 2: Application Security
├─► CSRF protection (VerifyCsrfToken middleware)
├─► XSS prevention (Blade auto-escaping)
├─► SQL injection prevention (Eloquent ORM)
├─► Input validation (Form Requests)
├─► Output sanitization
└─► Rate limiting

Layer 3: Authentication
├─► Laravel Sanctum/Session authentication
├─► Password hashing (bcrypt)
├─► Email verification
├─► Two-factor authentication (optional)
└─► Account lockout after failed attempts

Layer 4: Authorization
├─► Role-Based Access Control (RBAC)
├─► Permission-based authorization
├─► Laravel Policies
├─► Middleware checks (CheckRole, CheckPermission)
└─► Tenant isolation enforcement

Layer 5: Data Security
├─► Tenant data isolation (TenantScope)
├─► Soft deletes for data recovery
├─► Activity logging/audit trails
├─► Encrypted sensitive data
├─► Secure file uploads
└─► Database backups

Layer 6: API Security (if applicable)
├─► API token authentication
├─► Rate limiting
├─► Request throttling
└─► CORS configuration
```

### Tenant Isolation Security

```
┌──────────────────────────────────────────────────────────────┐
│             TENANT ISOLATION MECHANISMS                       │
└──────────────────────────────────────────────────────────────┘

Mechanism 1: Global Scopes
✓ Automatic WHERE tenant_id = X on all queries
✓ Applied at Eloquent model level
✓ Prevents cross-tenant data access

Mechanism 2: Middleware Enforcement
✓ TenantIdentification runs on every request
✓ Sets tenant context before controllers
✓ Validates tenant exists and is active

Mechanism 3: Policy Authorization
✓ Checks if user belongs to tenant
✓ Verifies user has required role/permission
✓ Prevents unauthorized access

Mechanism 4: Foreign Key Constraints
✓ Database-level referential integrity
✓ Cascade deletes maintain data consistency
✓ Prevents orphaned records

Mechanism 5: File Storage Segregation
✓ Files stored in tenant-specific directories
✓ Path: storage/app/tenants/{tenant_id}/...
✓ Access controlled via policies
```

### OWASP Top 10 Mitigations

| Vulnerability | Mitigation Strategy |
|---------------|---------------------|
| **Injection** | Eloquent ORM, parameterized queries, input validation |
| **Broken Auth** | Laravel Sanctum, bcrypt, session management |
| **Sensitive Data Exposure** | HTTPS, encrypted fields, secure storage |
| **XML External Entities** | Not applicable (no XML processing) |
| **Broken Access Control** | RBAC, policies, middleware checks, tenant scopes |
| **Security Misconfiguration** | Environment configs, secure defaults |
| **XSS** | Blade auto-escaping, Content Security Policy |
| **Insecure Deserialization** | Laravel's secure serialization |
| **Using Components with Known Vulnerabilities** | Regular Composer updates |
| **Insufficient Logging & Monitoring** | Activity logs, error logging, audit trails |

---

## Deployment Architecture

### Shared Hosting Deployment

```
┌──────────────────────────────────────────────────────────────┐
│             cPANEL SHARED HOSTING STRUCTURE                   │
└──────────────────────────────────────────────────────────────┘

public_html/                        (Web root)
├── index.php                       (Laravel entry point)
├── .htaccess                       (Apache config)
├── css/                            (Compiled assets)
├── js/                             (Compiled assets)
└── storage -> ../storage/app/public (Symbolic link)

app_root/                           (Above web root)
├── app/                            (Laravel app)
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
├── routes/
├── storage/
│   ├── app/
│   │   ├── public/
│   │   └── tenants/                (Tenant files)
│   ├── framework/
│   └── logs/
├── vendor/                         (Composer dependencies)
├── .env                            (Environment config)
├── artisan
└── composer.json

MySQL Database
├── Host: localhost
├── Database: username_realestatedb
├── User: username_dbuser
└── Prefix: (optional) res_
```

### Environment Configuration

```env
# .env for Production (Shared Hosting)

APP_NAME="Real Estate SaaS"
APP_ENV=production
APP_KEY=base64:GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_DOMAIN=yourdomain.com
TENANT_MODE=subdomain

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_realestatedb
DB_USERNAME=username_dbuser
DB_PASSWORD=secure_password

# Cache & Sessions (Database - No Redis)
CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database

# File Storage
FILESYSTEM_DISK=local
# For S3 (optional):
# FILESYSTEM_DISK=s3
# AWS_ACCESS_KEY_ID=
# AWS_SECRET_ACCESS_KEY=
# AWS_DEFAULT_REGION=
# AWS_BUCKET=

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Payment Gateways
STRIPE_KEY=pk_live_xxx
STRIPE_SECRET=sk_live_xxx
PAYSTACK_PUBLIC_KEY=pk_live_xxx
PAYSTACK_SECRET_KEY=sk_live_xxx
```

### Deployment Steps

```
┌──────────────────────────────────────────────────────────────┐
│                  DEPLOYMENT WORKFLOW                          │
└──────────────────────────────────────────────────────────────┘

1. Prepare Local Environment
   ├─► composer install --no-dev --optimize-autoloader
   ├─► npm run build (if using Vite)
   └─► php artisan config:cache

2. Upload Files to Server
   ├─► Upload via FTP/SFTP or Git
   ├─► Set permissions: storage/ and bootstrap/cache/ (775)
   └─► Create symbolic link: storage/app/public → public_html/storage

3. Configure Environment
   ├─► Copy .env.example to .env
   ├─► Generate app key: php artisan key:generate
   └─► Update database credentials

4. Database Setup
   ├─► Create MySQL database via cPanel
   ├─► Run migrations: php artisan migrate --force
   └─► Run seeders: php artisan db:seed --force

5. Post-Deployment
   ├─► Clear caches: php artisan cache:clear
   ├─► Optimize: php artisan optimize
   ├─► Queue worker (optional): php artisan queue:work --daemon
   └─► Verify installation: visit domain.com

6. Subdomain Configuration
   ├─► Wildcard subdomain: *.domain.com → public_html
   ├─► Or configure via cPanel: Domains → Subdomains
   └─► DNS: Add A record for *.domain.com
```

---

## Scalability Considerations

### Horizontal Scaling Path

```
┌──────────────────────────────────────────────────────────────┐
│                    SCALING STRATEGY                           │
└──────────────────────────────────────────────────────────────┘

Stage 1: Single Server (Initial)
┌─────────────────────────┐
│   Shared Hosting        │
│   • Web Server          │
│   • MySQL Database      │
│   • File Storage        │
└─────────────────────────┘
Capacity: 10-50 agencies

Stage 2: Optimized Single Server
┌─────────────────────────┐
│   VPS/Dedicated Server  │
│   • Nginx/Apache        │
│   • MySQL 8.0           │
│   • PHP-FPM             │
│   • File Cache          │
└─────────────────────────┘
Capacity: 50-200 agencies

Stage 3: Separated Database
┌──────────────┐       ┌──────────────┐
│ Web Server   │ ────► │ Database     │
│ • App Code   │       │ • MySQL      │
│ • File Cache │       │ • Optimized  │
└──────────────┘       └──────────────┘
Capacity: 200-500 agencies

Stage 4: Load Balanced (Future)
┌──────────────┐
│ Load         │
│ Balancer     │
└──────┬───────┘
       │
   ┌───┴────┬─────────┬─────────┐
   │        │         │         │
┌──▼───┐ ┌──▼───┐ ┌──▼───┐  ┌──▼────────┐
│ Web  │ │ Web  │ │ Web  │  │ Database  │
│ App1 │ │ App2 │ │ App3 │  │ Cluster   │
└──────┘ └──────┘ └──────┘  └───────────┘
   │        │         │
   └────────┴─────────┴──────────┐
                                 │
                         ┌───────▼────────┐
                         │ Shared Storage │
                         │ (S3/NFS)       │
                         └────────────────┘
Capacity: 500+ agencies
```

### Performance Optimization

```
┌──────────────────────────────────────────────────────────────┐
│               PERFORMANCE OPTIMIZATION                        │
└──────────────────────────────────────────────────────────────┘

Database Level:
├─► Indexed queries (tenant_id + status, etc.)
├─► Query optimization (eager loading relationships)
├─► Database query caching
└─► Periodic table optimization

Application Level:
├─► Route caching: php artisan route:cache
├─► Config caching: php artisan config:cache
├─► View caching: php artisan view:cache
├─► Eloquent query caching
├─► Lazy loading prevention (N+1 query fixes)
└─► Job queuing for heavy operations

Frontend Level:
├─► Asset minification and compression
├─► Image optimization and lazy loading
├─► Browser caching headers
├─► CDN for static assets (optional)
└─► Livewire lazy loading

Infrastructure Level:
├─► PHP OPcache enabled
├─► Gzip compression enabled
├─► HTTP/2 enabled
└─► Database connection pooling
```

---

## Development Workflow

### Local Development Setup

```bash
# 1. Clone repository
git clone <repository-url>
cd real_estate_saas

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Database setup
# Create database, update .env
php artisan migrate
php artisan db:seed

# 5. Start development server
php artisan serve
# Visit: http://localhost:8000

# 6. Watch assets (optional)
npm run dev
```

### Git Workflow

```
┌──────────────────────────────────────────────────────────────┐
│                    GIT BRANCHING STRATEGY                     │
└──────────────────────────────────────────────────────────────┘

main/master
├─► Production-ready code
└─► Protected branch

develop
├─► Integration branch
└─► Feature branches merge here

feature/<feature-name>
├─► New features
└─► Branch from: develop

bugfix/<bug-name>
├─► Bug fixes
└─► Branch from: develop

hotfix/<issue-name>
├─► Critical production fixes
└─► Branch from: main

release/<version>
├─► Release preparation
└─► Branch from: develop
```

### Testing Strategy

```
┌──────────────────────────────────────────────────────────────┐
│                    TESTING PYRAMID                            │
└──────────────────────────────────────────────────────────────┘

                    ┌────────────────┐
                    │   E2E Tests    │ (Minimal)
                    │   (Browser)    │
                    └────────────────┘
                  ┌──────────────────────┐
                  │  Feature/Integration │
                  │  Tests (Laravel)     │
                  └──────────────────────┘
              ┌──────────────────────────────┐
              │    Unit Tests (PHPUnit)      │
              │    Models, Services, etc.    │
              └──────────────────────────────┘

Test Coverage Goals:
├─► Unit Tests: 70%+ coverage
├─► Feature Tests: Key user flows
├─► Integration Tests: API endpoints
└─► E2E Tests: Critical business workflows
```

### Code Quality Tools

```
composer.json devDependencies:
├─► PHPUnit (testing)
├─► Laravel Pint (code formatting)
├─► PHPStan (static analysis)
├─► PHP CS Fixer (code style)
└─► Laravel Dusk (browser testing)
```

---

## Architectural Decisions Record (ADR)

### ADR-001: Single Database Multi-Tenancy

**Status:** Accepted
**Context:** Need to choose multi-tenancy approach
**Decision:** Use single shared database with tenant_id column
**Consequences:**
- ✅ Simpler deployment and maintenance
- ✅ Lower infrastructure costs
- ✅ Easier for shared hosting
- ⚠️ Must ensure proper tenant isolation
- ⚠️ Scaling requires database optimization

### ADR-002: Blade + Livewire over SPA

**Status:** Accepted
**Context:** Choose frontend architecture
**Decision:** Use Blade templates with Livewire components
**Consequences:**
- ✅ No build process required
- ✅ Better for shared hosting
- ✅ Easier for buyers to customize
- ✅ Better SEO out of the box
- ❌ Limited real-time interactions
- ❌ Full page reloads for some operations

### ADR-003: Database Queue over Redis

**Status:** Accepted
**Context:** Queue system for background jobs
**Decision:** Use database queue driver instead of Redis
**Consequences:**
- ✅ No external dependencies
- ✅ Works on basic shared hosting
- ✅ Simpler deployment
- ❌ Slower than Redis
- ❌ Database load for queue operations

### ADR-004: Subdomain-based Tenant Resolution

**Status:** Accepted
**Context:** How to identify tenants in URLs
**Decision:** Primary: subdomain, Fallback: path-based
**Consequences:**
- ✅ Clean URLs (agency.domain.com)
- ✅ Better branding for agencies
- ✅ Easier theme customization
- ⚠️ Requires wildcard DNS setup
- ⚠️ SSL certificate considerations

---

## Conclusion

This architecture document provides a high-level overview of the Real Estate SaaS Platform. For detailed implementation specifications, refer to:

- **REAL_ESTATE_SAAS_BLUEPRINT.md** - Detailed technical specifications
- **PROGRESS.md** - Development progress tracking
- **database/migrations/** - Database schema definitions
- **routes/web.php** - Application routing

### Key Takeaways

1. **Monolithic multi-tenant** architecture for simplicity
2. **Shared hosting friendly** - no complex infrastructure
3. **Security-first** design with tenant isolation
4. **Scalable** from 10 to 500+ agencies
5. **Developer-friendly** with clear separation of concerns
6. **Marketplace ready** for CodeCanyon deployment

---

**Document Version:** 1.0
**Last Updated:** 2025-11-16
**Maintained By:** Development Team
**Next Review:** After Phase 1 implementation
