# Real Estate SaaS Platform - Complete Development Blueprint

**Version:** 1.0
**Last Updated:** 2025-11-15
**Tech Stack:** Laravel 11 + Blade/Livewire + MySQL
**Deployment Target:** cPanel Shared Hosting
**Marketplace:** CodeCanyon Compliant

---

## Table of Contents

1. [High-Level Architecture](#1-high-level-architecture)
2. [Multi-Tenancy Strategy](#2-multi-tenancy-strategy)
3. [Authentication & RBAC](#3-authentication--rbac)
4. [Data Model (Database Schema)](#4-data-model-database-schema)
5. [Feature-by-Feature Specification](#5-feature-by-feature-specification)
6. [API Routes & Controllers](#6-api-routes--controllers)
7. [UI/UX Flow Documentation](#7-uiux-flow-documentation)
8. [Deployment Plan (CodeCanyon Compliant)](#8-deployment-plan-codecanyon-compliant)
9. [Payments & Subscription Billing](#9-payments--subscription-billing)
10. [Security, Compliance & Best Practices](#10-security-compliance--best-practices)
11. [Testing Strategy](#11-testing-strategy)
12. [Full MVP Roadmap (10 Weeks)](#12-full-mvp-roadmap-10-weeks)
13. [Deliverables List](#13-deliverables-list)

---

## 1. High-Level Architecture

### 1.1 Architecture Overview

This is a **monolithic multi-tenant SaaS application** built on Laravel 11, designed to run on shared hosting environments (cPanel) without requiring Docker, Node.js build processes, or modern deployment pipelines.

```
┌─────────────────────────────────────────────────────────────┐
│                    Real Estate SaaS Platform                 │
│                   (Single Laravel Application)               │
└─────────────────────────────────────────────────────────────┘
                              │
                              │
        ┌─────────────────────┼─────────────────────┐
        │                     │                     │
   ┌────▼────┐          ┌────▼────┐          ┌────▼────┐
   │  Public │          │ Agency  │          │  Super  │
   │   Site  │          │Dashboard│          │  Admin  │
   │         │          │ (Multi) │          │  Panel  │
   └─────────┘          └─────────┘          └─────────┘
        │                     │                     │
        │                     │                     │
        └─────────────────────┼─────────────────────┘
                              │
                    ┌─────────▼─────────┐
                    │   MySQL Database   │
                    │  (Single Database) │
                    │   tenant_id based  │
                    └────────────────────┘
```

### 1.2 Core Components

#### **Monolithic Laravel Application**
- Single codebase serving multiple user types
- Modular structure using Laravel's native structure + custom modules
- Blade templating with Livewire for reactive components (better for shared hosting)
- Traditional MVC pattern with service layer

#### **Modular Structure**

```
app/
├── Modules/
│   ├── Core/           # Core system functionality
│   ├── Agency/         # Agency management
│   ├── CRM/            # Leads, prospects, clients
│   ├── Property/       # Property listings, media
│   ├── Payment/        # Billing, subscriptions, transactions
│   ├── WebsiteBuilder/ # Theme engine, pages, menus
│   ├── ClientPortal/   # Client-facing features
│   └── SuperAdmin/     # Platform administration
```

#### **Tenant Resolution Middleware**

Every HTTP request passes through tenant resolution:

1. **Identify tenant** via:
   - Subdomain: `agency-slug.yourapp.com`
   - Path-based: `yourapp.com/agency/agency-slug`
   - Session (for logged-in users)

2. **Set tenant context** in middleware
3. **Apply global scopes** to Eloquent models
4. **Route to appropriate controller** based on user role

#### **Hierarchy Model**

```
Super Admin (Platform Owner)
    │
    ├── Agency 1 (tenant_id: 1)
    │   ├── Agency Admin
    │   ├── Branch 1
    │   │   ├── Realtor 1
    │   │   └── Realtor 2
    │   ├── Branch 2
    │   │   └── Realtor 3
    │   └── Clients
    │       ├── Client 1
    │       └── Client 2
    │
    ├── Agency 2 (tenant_id: 2)
    │   └── ...
```

#### **Multi-Theme Rendering System**

```
Themes/
├── default/
│   ├── layouts/
│   ├── partials/
│   └── pages/
├── modern/
├── classic/
└── minimal/
```

Each agency can:
- Select a theme from available themes
- Customize colors, logos, fonts
- Add custom CSS
- Enable/disable sections

#### **Three Application Contexts**

1. **Public Site Context** (`public.{domain}` or `www.{domain}`)
   - Landing page for SaaS platform
   - Pricing, features, registration

2. **Agency Context** (`{agency-slug}.{domain}`)
   - Agency's public website (theme-based)
   - Property listings
   - Contact forms
   - Blog

3. **Dashboard Context** (`app.{domain}` or `{domain}/dashboard`)
   - Super Admin Dashboard
   - Agency Admin Dashboard
   - Realtor Dashboard
   - Client Portal

### 1.3 Request Flow

```
User Request
    ↓
Web Server (Apache/Nginx)
    ↓
public/index.php
    ↓
Laravel Router
    ↓
TenantIdentification Middleware
    ↓
Authentication Middleware
    ↓
Role-Based Middleware
    ↓
Controller
    ↓
Service Layer
    ↓
Repository/Model (with tenant scope)
    ↓
Database (filtered by tenant_id)
    ↓
View (theme-aware)
    ↓
Response
```

### 1.4 Technology Decisions

| Component | Technology | Reason |
|-----------|-----------|--------|
| Backend Framework | Laravel 11 | Modern PHP framework, great for SaaS |
| Frontend | Blade + Livewire | Works on shared hosting, no build process |
| Database | MySQL 8.0+ | Universal hosting support |
| Cache | File/Database | Shared hosting compatible |
| Queue | Database | No Redis required |
| Session | Database | Scalable, shared hosting friendly |
| File Storage | Local + S3 (optional) | Flexibility for hosting |
| Email | SMTP/Mailgun/SES | Configurable |
| Payment Gateway | Stripe + Paystack | International + African markets |

### 1.5 Why NOT React/Vue SPA?

**For CodeCanyon and shared hosting:**
- No build process required
- No Node.js dependency
- Easier for buyers to customize
- Better SEO out of the box
- Simpler deployment
- Lower server requirements

**Livewire provides:**
- Reactive components
- AJAX without writing JavaScript
- Laravel-native
- Works with traditional hosting

---

## 2. Multi-Tenancy Strategy

### 2.1 Strategy Overview

**Approach:** Single Database with `tenant_id` column (Shared Database Pattern)

**Why this approach?**
- Simpler for shared hosting
- Easier to query across tenants (for super admin)
- Lower cost for buyers
- Easier to maintain
- Better for CodeCanyon marketplace

### 2.2 Tenant Identification

#### **Tenant Resolution Methods**

**Method 1: Subdomain-based (Recommended)**
```
agency-abc.realestate-saas.com → tenant: agency-abc
agency-xyz.realestate-saas.com → tenant: agency-xyz
```

**Method 2: Path-based (Fallback)**
```
realestate-saas.com/agency/agency-abc → tenant: agency-abc
realestate-saas.com/agency/agency-xyz → tenant: agency-xyz
```

**Method 3: Session-based (Authenticated Users)**
```php
// After login, store tenant in session
session(['tenant_id' => $user->agency_id]);
```

#### **Tenant Resolution Middleware**

```php
// app/Http/Middleware/IdentifyTenant.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next)
    {
        $tenant = null;

        // Method 1: Check subdomain
        $host = $request->getHost();
        $subdomain = $this->getSubdomain($host);

        if ($subdomain && $subdomain !== 'www' && $subdomain !== 'app') {
            $tenant = Agency::where('slug', $subdomain)
                ->where('status', 'active')
                ->first();
        }

        // Method 2: Check path
        if (!$tenant && $request->segment(1) === 'agency') {
            $slug = $request->segment(2);
            $tenant = Agency::where('slug', $slug)
                ->where('status', 'active')
                ->first();
        }

        // Method 3: Check authenticated user
        if (!$tenant && Auth::check()) {
            $user = Auth::user();
            if ($user->agency_id) {
                $tenant = Agency::find($user->agency_id);
            }
        }

        if ($tenant) {
            // Set tenant in application
            app()->instance('tenant', $tenant);
            session(['tenant_id' => $tenant->id]);

            // Set tenant for global scope
            config(['app.tenant_id' => $tenant->id]);
        }

        return $next($request);
    }

    private function getSubdomain($host)
    {
        $parts = explode('.', $host);
        if (count($parts) > 2) {
            return $parts[0];
        }
        return null;
    }
}
```

### 2.3 Database Design: Central vs Tenant-Aware

#### **Central Tables (NO tenant_id)**

These tables are global and not scoped by tenant:

- `users` (with agency_id reference)
- `agencies`
- `roles`
- `permissions`
- `role_user`
- `permission_role`
- `subscription_plans`
- `themes`
- `system_settings`
- `migrations`

#### **Tenant-Aware Tables (WITH tenant_id)**

These tables contain data specific to each agency:

**CRM & Leads:**
- `leads` (tenant_id = agency_id)
- `clients` (tenant_id = agency_id)
- `followups` (tenant_id = agency_id)
- `appointments` (tenant_id = agency_id)

**Properties:**
- `properties` (tenant_id = agency_id)
- `property_media` (tenant_id = agency_id)
- `property_documents` (tenant_id = agency_id)
- `property_views` (tenant_id = agency_id)

**Transactions:**
- `transactions` (tenant_id = agency_id)
- `payments` (tenant_id = agency_id)
- `invoices` (tenant_id = agency_id)
- `contracts` (tenant_id = agency_id)

**Website Builder:**
- `pages` (tenant_id = agency_id)
- `menus` (tenant_id = agency_id)
- `blog_posts` (tenant_id = agency_id)
- `inquiries` (tenant_id = agency_id)

**Agency Specific:**
- `agency_branches` (tenant_id = agency_id)
- `agency_settings` (tenant_id = agency_id)
- `team_members` (tenant_id = agency_id)

### 2.4 Global Scopes for Data Isolation

#### **Base Tenant Model**

```php
// app/Models/TenantScoped.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\TenantScope;

abstract class TenantScoped extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (!$model->tenant_id) {
                $model->tenant_id = config('app.tenant_id') ?? session('tenant_id');
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Agency::class, 'tenant_id');
    }
}
```

#### **Tenant Scope**

```php
// app/Scopes/TenantScope.php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $tenantId = config('app.tenant_id') ?? session('tenant_id');

        if ($tenantId) {
            $builder->where($model->getTable() . '.tenant_id', $tenantId);
        }
    }
}
```

#### **Example Usage**

```php
// app/Models/Property.php

namespace App\Models;

class Property extends TenantScoped
{
    protected $fillable = [
        'tenant_id',
        'title',
        'description',
        'price',
        // ...
    ];

    // All queries automatically scoped by tenant_id
}

// Usage in controller:
$properties = Property::all(); // Only returns properties for current tenant
$property = Property::find(1); // Only finds if belongs to current tenant
```

### 2.5 Breaking Tenant Scope (Super Admin)

```php
// When Super Admin needs to see all data
use App\Models\Property;

// Method 1: Without global scope
$allProperties = Property::withoutGlobalScope(TenantScope::class)->get();

// Method 2: For specific tenant
$agencyProperties = Property::withoutGlobalScope(TenantScope::class)
    ->where('tenant_id', $specificAgencyId)
    ->get();
```

### 2.6 Seeder Rules for Multi-Tenancy

#### **Database Seeder Structure**

```php
// database/seeders/DatabaseSeeder.php

public function run()
{
    // 1. Seed global data (no tenant_id)
    $this->call([
        RolePermissionSeeder::class,
        SubscriptionPlanSeeder::class,
        ThemeSeeder::class,
        SystemSettingsSeeder::class,
    ]);

    // 2. Create demo agencies
    $this->call([
        AgencySeeder::class, // Creates 3 demo agencies
    ]);

    // 3. For each agency, seed tenant data
    $agencies = \App\Models\Agency::all();

    foreach ($agencies as $agency) {
        // Set tenant context
        config(['app.tenant_id' => $agency->id]);

        $this->call([
            BranchSeeder::class,
            UserSeeder::class,
            LeadSeeder::class,
            PropertySeeder::class,
            ClientSeeder::class,
        ]);
    }
}
```

#### **Agency Seeder**

```php
// database/seeders/AgencySeeder.php

public function run()
{
    $agencies = [
        [
            'name' => 'Prime Properties Ltd',
            'slug' => 'prime-properties',
            'email' => 'admin@prime.demo',
            'phone' => '+1234567890',
            'status' => 'active',
        ],
        [
            'name' => 'Urban Realty',
            'slug' => 'urban-realty',
            'email' => 'admin@urban.demo',
            'phone' => '+1234567891',
            'status' => 'active',
        ],
        [
            'name' => 'Coastal Estates',
            'slug' => 'coastal-estates',
            'email' => 'admin@coastal.demo',
            'phone' => '+1234567892',
            'status' => 'active',
        ],
    ];

    foreach ($agencies as $agencyData) {
        $agency = Agency::create($agencyData);

        // Create agency admin user
        $admin = User::create([
            'name' => 'Agency Admin',
            'email' => $agencyData['email'],
            'password' => bcrypt('password'),
            'agency_id' => $agency->id,
        ]);

        $admin->assignRole('agency_admin');

        // Create default subscription
        $agency->subscriptions()->create([
            'plan_id' => 1, // Basic plan
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addDays(30),
        ]);
    }
}
```

### 2.7 Tenant Registration Flow

```
┌──────────────────────────────────────────────────────────┐
│ AGENCY REGISTRATION FLOW                                  │
└──────────────────────────────────────────────────────────┘

Step 1: Agency Information
  ├── Agency Name
  ├── Agency Email
  ├── Phone
  ├── Address
  └── Slug (auto-generated from name, editable)

Step 2: Admin Account
  ├── Admin Name
  ├── Admin Email
  ├── Password
  └── Password Confirmation

Step 3: Select Plan (Optional - can start with trial)
  ├── Free Trial (14 days)
  ├── Basic Plan
  ├── Professional Plan
  └── Enterprise Plan

Step 4: Payment (if not trial)
  ├── Stripe/Paystack
  └── Payment confirmation

Step 5: Account Setup
  ├── Create agency record (tenant_id)
  ├── Create admin user
  ├── Assign role: agency_admin
  ├── Create default subscription
  ├── Create agency_settings
  ├── Setup default branch
  └── Send welcome email

Step 6: Onboarding Wizard
  ├── Upload logo
  ├── Set brand colors
  ├── Select theme
  ├── Add team members (optional)
  └── Complete setup

Step 7: Redirect to Dashboard
  └── Agency dashboard at {slug}.domain.com/dashboard
```

#### **Registration Controller Example**

```php
// app/Http/Controllers/RegistrationController.php

public function register(Request $request)
{
    $validated = $request->validate([
        'agency_name' => 'required|string|max:255',
        'agency_slug' => 'required|string|unique:agencies,slug',
        'agency_email' => 'required|email|unique:agencies,email',
        'agency_phone' => 'required|string',
        'admin_name' => 'required|string',
        'admin_email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'plan_id' => 'nullable|exists:subscription_plans,id',
    ]);

    DB::beginTransaction();

    try {
        // 1. Create agency
        $agency = Agency::create([
            'name' => $validated['agency_name'],
            'slug' => $validated['agency_slug'],
            'email' => $validated['agency_email'],
            'phone' => $validated['agency_phone'],
            'status' => 'pending', // Will be 'active' after payment
        ]);

        // 2. Create admin user
        $admin = User::create([
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'password' => Hash::make($validated['password']),
            'agency_id' => $agency->id,
            'status' => 'active',
        ]);

        $admin->assignRole('agency_admin');

        // 3. Create trial subscription or redirect to payment
        if (!$validated['plan_id']) {
            // Free trial
            $agency->subscriptions()->create([
                'plan_id' => 1, // Trial plan
                'status' => 'trialing',
                'trial_ends_at' => now()->addDays(14),
                'starts_at' => now(),
            ]);

            $agency->update(['status' => 'active']);
        }

        // 4. Create default settings
        $agency->settings()->create([
            'timezone' => 'UTC',
            'currency' => 'USD',
            'date_format' => 'Y-m-d',
            'theme' => 'default',
        ]);

        // 5. Create default branch
        $agency->branches()->create([
            'name' => 'Main Office',
            'is_primary' => true,
            'tenant_id' => $agency->id,
        ]);

        DB::commit();

        // 6. Send welcome email
        Mail::to($admin)->send(new WelcomeEmail($agency, $admin));

        // 7. Login and redirect
        Auth::login($admin);

        if ($validated['plan_id']) {
            return redirect()->route('checkout', ['plan' => $validated['plan_id']]);
        }

        return redirect()->route('onboarding.wizard');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Registration failed. Please try again.']);
    }
}
```

### 2.8 Agency Subdomain/Path Routing

#### **Subdomain Routing**

```php
// routes/web.php

// Subdomain routing for agencies
Route::domain('{agency}.{domain}')
    ->middleware(['web', 'tenant'])
    ->group(function () {
        Route::get('/', [AgencyWebsiteController::class, 'home'])->name('agency.home');
        Route::get('/properties', [AgencyWebsiteController::class, 'properties'])->name('agency.properties');
        Route::get('/properties/{property}', [AgencyWebsiteController::class, 'propertyDetail'])->name('agency.property.detail');
        Route::get('/about', [AgencyWebsiteController::class, 'about'])->name('agency.about');
        Route::get('/contact', [AgencyWebsiteController::class, 'contact'])->name('agency.contact');
        Route::post('/inquiries', [InquiryController::class, 'store'])->name('agency.inquiry.store');
    });

// Main app dashboard (app.domain.com or domain.com/dashboard)
Route::domain('app.{domain}')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // ... other dashboard routes
    });

// Super admin (admin.domain.com)
Route::domain('admin.{domain}')
    ->middleware(['web', 'auth', 'role:super_admin'])
    ->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
        // ... other admin routes
    });
```

#### **Path-Based Routing (Fallback)**

```php
// routes/web.php

Route::prefix('agency/{agency_slug}')
    ->middleware(['web', 'tenant'])
    ->group(function () {
        Route::get('/', [AgencyWebsiteController::class, 'home'])->name('agency.home');
        Route::get('/properties', [AgencyWebsiteController::class, 'properties'])->name('agency.properties');
        // ... other routes
    });
```

#### **Environment Configuration**

```env
# .env
APP_URL=https://realestate-saas.com
APP_DOMAIN=realestate-saas.com
TENANT_MODE=subdomain # or 'path'
```

### 2.9 Data Isolation Checklist

- [ ] All tenant-aware models extend `TenantScoped`
- [ ] `TenantScope` applied globally to all queries
- [ ] `tenant_id` automatically set on creation
- [ ] Foreign keys include tenant_id in composite indexes
- [ ] Super admin can bypass scopes when needed
- [ ] Seeders respect tenant context
- [ ] File uploads segregated by tenant
- [ ] Cache keys prefixed with tenant_id
- [ ] Queue jobs include tenant context
- [ ] Email templates can be tenant-customized

---

## 3. Authentication & RBAC

### 3.1 Role Hierarchy

```
┌─────────────────────────────────────────────────────────┐
│                    ROLE HIERARCHY                        │
└─────────────────────────────────────────────────────────┘

Level 1: Super Admin (Platform Owner)
    ↓
Level 2: Agency Admin (Tenant Owner)
    ↓
Level 3: Realtor (Agency Employee)
    ↓
Level 4: Client (Agency Customer)
```

### 3.2 Role Definitions

#### **1. Super Admin**

**Description:** Platform owner who manages the entire SaaS

**Access Level:** Global (all agencies)

**Permissions:**
- `superadmin.access` - Access super admin panel
- `agencies.view_all` - View all agencies
- `agencies.create` - Create new agencies
- `agencies.edit_all` - Edit any agency
- `agencies.delete` - Delete agencies
- `agencies.suspend` - Suspend/activate agencies
- `subscriptions.view_all` - View all subscriptions
- `subscriptions.manage` - Manage all subscriptions
- `plans.create` - Create subscription plans
- `plans.edit` - Edit subscription plans
- `plans.delete` - Delete subscription plans
- `themes.upload` - Upload new themes
- `themes.manage` - Manage theme marketplace
- `settings.global` - Manage global settings
- `users.view_all` - View all platform users
- `users.impersonate` - Login as any user
- `reports.global` - Access global reports
- `payments.view_all` - View all payments
- `analytics.global` - Global analytics access

**Example Policy:**

```php
// app/Policies/AgencyPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Agency;

class AgencyPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('super_admin');
    }

    public function view(User $user, Agency $agency)
    {
        return $user->hasRole('super_admin') ||
               $user->agency_id === $agency->id;
    }

    public function create(User $user)
    {
        return $user->hasRole('super_admin');
    }

    public function update(User $user, Agency $agency)
    {
        return $user->hasRole('super_admin') ||
               ($user->hasRole('agency_admin') && $user->agency_id === $agency->id);
    }

    public function delete(User $user, Agency $agency)
    {
        return $user->hasRole('super_admin');
    }

    public function suspend(User $user, Agency $agency)
    {
        return $user->hasRole('super_admin');
    }
}
```

---

#### **2. Agency Admin**

**Description:** Owner/Manager of the agency (tenant)

**Access Level:** Agency-wide (single tenant)

**Permissions:**
- `agency.dashboard` - Access agency dashboard
- `agency.settings` - Manage agency settings
- `agency.branches.manage` - Manage branches
- `agency.theme.select` - Select/customize theme
- `agency.theme.customize` - Customize colors, logo
- `realtors.view` - View all realtors
- `realtors.create` - Add new realtors
- `realtors.edit` - Edit realtor details
- `realtors.delete` - Remove realtors
- `realtors.assign_leads` - Assign leads to realtors
- `clients.view_all` - View all clients
- `clients.create` - Create new clients
- `clients.edit` - Edit client details
- `clients.delete` - Delete clients
- `leads.view_all` - View all leads
- `leads.create` - Create leads
- `leads.edit` - Edit leads
- `leads.delete` - Delete leads
- `leads.assign` - Assign leads to realtors
- `properties.view_all` - View all properties
- `properties.create` - Create properties
- `properties.edit` - Edit properties
- `properties.delete` - Delete properties
- `properties.publish` - Publish/unpublish properties
- `transactions.view_all` - View all transactions
- `transactions.create` - Create transactions
- `transactions.edit` - Edit transactions
- `payments.view_all` - View all payments
- `payments.record` - Record payments
- `documents.view_all` - View all documents
- `documents.upload` - Upload documents
- `documents.delete` - Delete documents
- `website.manage` - Manage website pages
- `website.blog` - Manage blog posts
- `reports.agency` - Access agency reports
- `subscription.manage` - Manage agency subscription
- `billing.view` - View billing history
- `team.manage` - Manage team members
- `audit_logs.view` - View activity logs

**Example Policy:**

```php
// app/Policies/PropertyPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Property;

class PropertyPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['super_admin', 'agency_admin', 'realtor']);
    }

    public function view(User $user, Property $property)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        // Check if user belongs to same agency
        return $user->agency_id === $property->tenant_id;
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['agency_admin', 'realtor']);
    }

    public function update(User $user, Property $property)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('agency_admin') && $user->agency_id === $property->tenant_id) {
            return true;
        }

        // Realtor can only update own properties
        if ($user->hasRole('realtor') && $property->created_by === $user->id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Property $property)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        // Only agency admin can delete
        return $user->hasRole('agency_admin') && $user->agency_id === $property->tenant_id;
    }

    public function publish(User $user, Property $property)
    {
        return $user->hasRole('agency_admin') && $user->agency_id === $property->tenant_id;
    }
}
```

---

#### **3. Realtor**

**Description:** Agency employee who handles leads, clients, and properties

**Access Level:** Assigned data + own data

**Permissions:**
- `realtor.dashboard` - Access realtor dashboard
- `leads.view_assigned` - View assigned leads
- `leads.edit_assigned` - Edit assigned leads
- `leads.create` - Create new leads
- `clients.view_assigned` - View assigned clients
- `clients.edit_assigned` - Edit assigned clients
- `followups.create` - Create followups
- `followups.edit_own` - Edit own followups
- `appointments.create` - Create appointments
- `appointments.edit_own` - Edit own appointments
- `properties.view_all` - View all properties
- `properties.create` - Create properties
- `properties.edit_own` - Edit own properties
- `property_documents.upload` - Upload property documents
- `property_documents.view` - View property documents
- `transactions.view_assigned` - View assigned transactions
- `transactions.create` - Create transactions
- `commissions.view_own` - View own commissions
- `clients.portal_access` - Grant client portal access
- `reports.own` - View own performance reports

**Example Policy:**

```php
// app/Policies/LeadPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Lead;

class LeadPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['super_admin', 'agency_admin', 'realtor']);
    }

    public function view(User $user, Lead $lead)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('agency_admin') && $user->agency_id === $lead->tenant_id) {
            return true;
        }

        // Realtor can view if assigned or created by them
        if ($user->hasRole('realtor')) {
            return $lead->assigned_to === $user->id || $lead->created_by === $user->id;
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['agency_admin', 'realtor']);
    }

    public function update(User $user, Lead $lead)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('agency_admin') && $user->agency_id === $lead->tenant_id) {
            return true;
        }

        // Realtor can update if assigned or created by them
        if ($user->hasRole('realtor')) {
            return $lead->assigned_to === $user->id || $lead->created_by === $user->id;
        }

        return false;
    }

    public function delete(User $user, Lead $lead)
    {
        // Only agency admin can delete
        return $user->hasRole('agency_admin') && $user->agency_id === $lead->tenant_id;
    }

    public function assign(User $user, Lead $lead)
    {
        return $user->hasRole('agency_admin') && $user->agency_id === $lead->tenant_id;
    }
}
```

---

#### **4. Client**

**Description:** Customer who purchased property or using client portal

**Access Level:** Own data only

**Permissions:**
- `client.portal` - Access client portal
- `properties.view_own` - View own purchased properties
- `documents.view_own` - View own documents
- `documents.download` - Download own documents
- `payments.view_own` - View own payment history
- `invoices.view_own` - View own invoices
- `contracts.view_own` - View own contracts
- `contracts.sign` - E-sign contracts
- `support.create` - Create support tickets
- `support.view_own` - View own support tickets
- `profile.edit` - Edit own profile

**Example Policy:**

```php
// app/Policies/ClientPortalPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\ClientProperty;

class ClientPortalPolicy
{
    public function viewProperty(User $user, ClientProperty $property)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('agency_admin') && $user->agency_id === $property->tenant_id) {
            return true;
        }

        // Client can only view own properties
        if ($user->hasRole('client')) {
            return $property->client_id === $user->id;
        }

        return false;
    }

    public function downloadDocument(User $user, $document)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('agency_admin') && $user->agency_id === $document->tenant_id) {
            return true;
        }

        // Client can only download own documents
        if ($user->hasRole('client')) {
            return $document->client_id === $user->id;
        }

        return false;
    }

    public function viewPaymentHistory(User $user, $clientId)
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($user->hasRole('agency_admin')) {
            // Can view any client in their agency
            $client = User::find($clientId);
            return $client && $user->agency_id === $client->agency_id;
        }

        // Client can only view own payment history
        if ($user->hasRole('client')) {
            return $user->id === $clientId;
        }

        return false;
    }
}
```

### 3.3 Roles & Permissions Table Structure

```php
// database/migrations/create_roles_permissions_tables.php

Schema::create('roles', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique(); // super_admin, agency_admin, realtor, client
    $table->string('display_name');
    $table->text('description')->nullable();
    $table->timestamps();
});

Schema::create('permissions', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique(); // leads.create, properties.edit, etc.
    $table->string('display_name');
    $table->string('group'); // leads, properties, clients, etc.
    $table->text('description')->nullable();
    $table->timestamps();
});

Schema::create('role_user', function (Blueprint $table) {
    $table->id();
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    $table->unique(['role_id', 'user_id']);
});

Schema::create('permission_role', function (Blueprint $table) {
    $table->id();
    $table->foreignId('permission_id')->constrained()->onDelete('cascade');
    $table->foreignId('role_id')->constrained()->onDelete('cascade');
    $table->timestamps();

    $table->unique(['permission_id', 'role_id']);
});
```

### 3.4 Role & Permission Seeder

```php
// database/seeders/RolePermissionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Roles
        $superAdmin = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Administrator',
            'description' => 'Platform owner with full access',
        ]);

        $agencyAdmin = Role::create([
            'name' => 'agency_admin',
            'display_name' => 'Agency Administrator',
            'description' => 'Agency owner/manager',
        ]);

        $realtor = Role::create([
            'name' => 'realtor',
            'display_name' => 'Realtor',
            'description' => 'Agency employee',
        ]);

        $client = Role::create([
            'name' => 'client',
            'display_name' => 'Client',
            'description' => 'Agency customer',
        ]);

        // Define Permissions
        $permissions = [
            // Super Admin
            ['name' => 'superadmin.access', 'display_name' => 'Access Super Admin Panel', 'group' => 'superadmin'],
            ['name' => 'agencies.view_all', 'display_name' => 'View All Agencies', 'group' => 'agencies'],
            ['name' => 'agencies.create', 'display_name' => 'Create Agencies', 'group' => 'agencies'],
            ['name' => 'agencies.edit_all', 'display_name' => 'Edit Any Agency', 'group' => 'agencies'],
            ['name' => 'agencies.delete', 'display_name' => 'Delete Agencies', 'group' => 'agencies'],
            ['name' => 'plans.manage', 'display_name' => 'Manage Subscription Plans', 'group' => 'subscriptions'],
            ['name' => 'themes.manage', 'display_name' => 'Manage Themes', 'group' => 'themes'],

            // Agency Admin
            ['name' => 'agency.dashboard', 'display_name' => 'Access Agency Dashboard', 'group' => 'agency'],
            ['name' => 'agency.settings', 'display_name' => 'Manage Agency Settings', 'group' => 'agency'],
            ['name' => 'realtors.manage', 'display_name' => 'Manage Realtors', 'group' => 'realtors'],
            ['name' => 'clients.manage', 'display_name' => 'Manage Clients', 'group' => 'clients'],
            ['name' => 'leads.manage', 'display_name' => 'Manage All Leads', 'group' => 'leads'],
            ['name' => 'properties.manage', 'display_name' => 'Manage All Properties', 'group' => 'properties'],
            ['name' => 'website.manage', 'display_name' => 'Manage Website', 'group' => 'website'],

            // Realtor
            ['name' => 'leads.view_assigned', 'display_name' => 'View Assigned Leads', 'group' => 'leads'],
            ['name' => 'leads.create', 'display_name' => 'Create Leads', 'group' => 'leads'],
            ['name' => 'properties.create', 'display_name' => 'Create Properties', 'group' => 'properties'],
            ['name' => 'properties.edit_own', 'display_name' => 'Edit Own Properties', 'group' => 'properties'],
            ['name' => 'followups.manage', 'display_name' => 'Manage Followups', 'group' => 'crm'],

            // Client
            ['name' => 'client.portal', 'display_name' => 'Access Client Portal', 'group' => 'client'],
            ['name' => 'properties.view_own', 'display_name' => 'View Own Properties', 'group' => 'client'],
            ['name' => 'documents.view_own', 'display_name' => 'View Own Documents', 'group' => 'client'],
            ['name' => 'payments.view_own', 'display_name' => 'View Own Payments', 'group' => 'client'],
        ];

        foreach ($permissions as $permissionData) {
            Permission::create($permissionData);
        }

        // Assign all permissions to Super Admin
        $superAdmin->permissions()->attach(Permission::all());

        // Assign specific permissions to Agency Admin
        $agencyAdminPermissions = Permission::whereIn('group', [
            'agency', 'realtors', 'clients', 'leads', 'properties', 'website', 'crm'
        ])->get();
        $agencyAdmin->permissions()->attach($agencyAdminPermissions);

        // Assign specific permissions to Realtor
        $realtorPermissions = Permission::whereIn('name', [
            'leads.view_assigned',
            'leads.create',
            'properties.create',
            'properties.edit_own',
            'followups.manage',
        ])->get();
        $realtor->permissions()->attach($realtorPermissions);

        // Assign specific permissions to Client
        $clientPermissions = Permission::where('group', 'client')->get();
        $client->permissions()->attach($clientPermissions);
    }
}
```

### 3.5 Middleware for Role-Based Access

```php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}

// app/Http/Middleware/CheckPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'You do not have permission to perform this action.');
    }
}
```

### 3.6 User Model Traits

```php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'agency_id',
        'status',
    ];

    // Relationships
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Helper Methods
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return $this->roles->contains('id', $role);
    }

    public function hasAnyRole($roles)
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }

    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->detach($role);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function isAgencyAdmin()
    {
        return $this->hasRole('agency_admin');
    }

    public function isRealtor()
    {
        return $this->hasRole('realtor');
    }

    public function isClient()
    {
        return $this->hasRole('client');
    }
}
```

### 3.7 Route Protection Examples

```php
// routes/web.php

// Super Admin Routes
Route::prefix('superadmin')
    ->middleware(['auth', 'role:super_admin'])
    ->name('superadmin.')
    ->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('agencies', AgencyController::class);
        Route::resource('plans', SubscriptionPlanController::class);
        Route::resource('themes', ThemeController::class);
    });

// Agency Admin Routes
Route::prefix('agency')
    ->middleware(['auth', 'role:agency_admin'])
    ->name('agency.')
    ->group(function () {
        Route::get('/dashboard', [AgencyDashboardController::class, 'index'])->name('dashboard');
        Route::resource('realtors', RealtorController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('leads', LeadController::class);
        Route::resource('properties', PropertyController::class);
        Route::get('/settings', [AgencySettingsController::class, 'index'])->name('settings');
    });

// Realtor Routes
Route::prefix('realtor')
    ->middleware(['auth', 'role:realtor'])
    ->name('realtor.')
    ->group(function () {
        Route::get('/dashboard', [RealtorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/leads', [RealtorLeadController::class, 'index'])->name('leads.index');
        Route::get('/clients', [RealtorClientController::class, 'index'])->name('clients.index');
        Route::resource('followups', FollowupController::class);
    });

// Client Portal Routes
Route::prefix('portal')
    ->middleware(['auth', 'role:client'])
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', [ClientPortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/properties', [ClientPortalController::class, 'properties'])->name('properties');
        Route::get('/documents', [ClientPortalController::class, 'documents'])->name('documents');
        Route::get('/payments', [ClientPortalController::class, 'payments'])->name('payments');
    });
```

### 3.8 Access Control in Blade Templates

```blade
{{-- resources/views/layouts/navigation.blade.php --}}

@role('super_admin')
    <li><a href="{{ route('superadmin.dashboard') }}">Super Admin</a></li>
@endrole

@role('agency_admin')
    <li><a href="{{ route('agency.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('agency.leads.index') }}">Leads</a></li>
    <li><a href="{{ route('agency.properties.index') }}">Properties</a></li>
@endrole

@role('realtor')
    <li><a href="{{ route('realtor.dashboard') }}">My Dashboard</a></li>
    <li><a href="{{ route('realtor.leads.index') }}">My Leads</a></li>
@endrole

@role('client')
    <li><a href="{{ route('client.dashboard') }}">My Portal</a></li>
    <li><a href="{{ route('client.properties') }}">My Properties</a></li>
@endrole

@permission('leads.create')
    <button>Create New Lead</button>
@endpermission
```

### 3.9 Blade Directives for Roles & Permissions

```php
// app/Providers/AppServiceProvider.php

use Illuminate\Support\Facades\Blade;

public function boot()
{
    // Role directive
    Blade::if('role', function ($role) {
        return auth()->check() && auth()->user()->hasRole($role);
    });

    // Permission directive
    Blade::if('permission', function ($permission) {
        return auth()->check() && auth()->user()->hasPermission($permission);
    });

    // Any role directive
    Blade::if('anyrole', function (...$roles) {
        return auth()->check() && auth()->user()->hasAnyRole($roles);
    });
}
```

---

## 4. Data Model (Database Schema)

### 4.1 ERD Overview (Text Description)

```
CORE TABLES
├── users (agency_id FK)
├── agencies
├── agency_branches (tenant_id FK)
├── agency_settings (tenant_id FK)
├── roles
├── permissions
├── role_user (pivot)
├── permission_role (pivot)
├── subscriptions (agency_id FK)
├── subscription_plans
├── themes
└── domain_mappings (agency_id FK)

CRM & LEADS
├── leads (tenant_id FK, assigned_to FK)
├── clients (tenant_id FK, assigned_to FK)
├── followups (tenant_id FK, lead_id FK, user_id FK)
├── appointments (tenant_id FK, client_id FK, user_id FK)
└── notes (tenant_id FK, notable_type, notable_id)

PROPERTIES
├── properties (tenant_id FK, created_by FK)
├── property_media (property_id FK)
├── property_documents (property_id FK, tenant_id FK)
├── property_features (property_id FK)
├── property_views (property_id FK, tenant_id FK)
└── property_categories

TRANSACTIONS & PAYMENTS
├── transactions (tenant_id FK, property_id FK, client_id FK)
├── payments (tenant_id FK, transaction_id FK)
├── invoices (tenant_id FK, client_id FK)
├── contracts (tenant_id FK, client_id FK, property_id FK)
└── payment_schedules (tenant_id FK, transaction_id FK)

CLIENT PORTAL
├── client_properties (tenant_id FK, client_id FK, property_id FK)
├── client_documents (tenant_id FK, client_id FK)
└── support_tickets (tenant_id FK, client_id FK)

WEBSITE BUILDER
├── pages (tenant_id FK)
├── menus (tenant_id FK)
├── menu_items (menu_id FK)
├── blog_posts (tenant_id FK, author_id FK)
├── blog_categories (tenant_id FK)
└── inquiries (tenant_id FK)

SYSTEM
├── activity_logs (user_id FK, tenant_id FK)
├── notifications (user_id FK)
└── system_settings
```

### 4.2 Detailed Table Schemas

#### **CORE TABLES**

##### **users**
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->string('phone')->nullable();
    $table->string('avatar')->nullable();
    $table->foreignId('agency_id')->nullable()->constrained()->onDelete('cascade');
    $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
    $table->rememberToken();
    $table->timestamps();
    $table->softDeletes();

    $table->index('agency_id');
    $table->index('status');
});
```

##### **agencies**
```php
Schema::create('agencies', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('email')->unique();
    $table->string('phone');
    $table->text('address')->nullable();
    $table->string('city')->nullable();
    $table->string('state')->nullable();
    $table->string('country')->nullable();
    $table->string('logo')->nullable();
    $table->string('website')->nullable();
    $table->enum('status', ['active', 'suspended', 'pending', 'cancelled'])->default('pending');
    $table->text('description')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->index('slug');
    $table->index('status');
});
```

##### **agency_branches**
```php
Schema::create('agency_branches', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('name');
    $table->string('email')->nullable();
    $table->string('phone')->nullable();
    $table->text('address')->nullable();
    $table->string('city')->nullable();
    $table->string('state')->nullable();
    $table->boolean('is_primary')->default(false);
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
});
```

##### **agency_settings**
```php
Schema::create('agency_settings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('timezone')->default('UTC');
    $table->string('currency')->default('USD');
    $table->string('date_format')->default('Y-m-d');
    $table->string('time_format')->default('H:i');
    $table->string('theme')->default('default');
    $table->json('theme_settings')->nullable(); // colors, fonts, etc.
    $table->string('primary_color')->default('#3B82F6');
    $table->string('secondary_color')->default('#10B981');
    $table->json('email_settings')->nullable();
    $table->json('sms_settings')->nullable();
    $table->boolean('allow_client_registration')->default(true);
    $table->boolean('require_email_verification')->default(true);
    $table->timestamps();

    $table->unique('tenant_id');
});
```

##### **subscriptions**
```php
Schema::create('subscriptions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('agency_id')->constrained()->onDelete('cascade');
    $table->foreignId('plan_id')->constrained('subscription_plans')->onDelete('cascade');
    $table->enum('status', ['active', 'trialing', 'past_due', 'cancelled', 'expired'])->default('active');
    $table->timestamp('trial_ends_at')->nullable();
    $table->timestamp('starts_at');
    $table->timestamp('ends_at')->nullable();
    $table->timestamp('cancelled_at')->nullable();
    $table->string('stripe_subscription_id')->nullable();
    $table->string('paystack_subscription_code')->nullable();
    $table->timestamps();

    $table->index(['agency_id', 'status']);
});
```

##### **subscription_plans**
```php
Schema::create('subscription_plans', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->enum('interval', ['monthly', 'yearly'])->default('monthly');
    $table->integer('trial_days')->default(0);
    $table->json('features'); // JSON array of features
    $table->integer('max_users')->nullable(); // null = unlimited
    $table->integer('max_properties')->nullable();
    $table->integer('max_clients')->nullable();
    $table->boolean('is_active')->default(true);
    $table->boolean('is_featured')->default(false);
    $table->string('stripe_price_id')->nullable();
    $table->string('paystack_plan_code')->nullable();
    $table->timestamps();

    $table->index('slug');
    $table->index('is_active');
});
```

##### **themes**
```php
Schema::create('themes', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->string('thumbnail')->nullable();
    $table->string('version')->default('1.0');
    $table->string('author')->nullable();
    $table->boolean('is_active')->default(true);
    $table->boolean('is_premium')->default(false);
    $table->decimal('price', 10, 2)->default(0);
    $table->json('preview_images')->nullable();
    $table->timestamps();

    $table->index('slug');
    $table->index('is_active');
});
```

---

#### **CRM & LEADS TABLES**

##### **leads**
```php
Schema::create('leads', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('name');
    $table->string('email')->nullable();
    $table->string('phone');
    $table->enum('source', ['website', 'referral', 'walk_in', 'phone_call', 'social_media', 'other'])->default('website');
    $table->enum('status', ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'])->default('new');
    $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
    $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
    $table->text('notes')->nullable();
    $table->decimal('budget', 15, 2)->nullable();
    $table->string('location_preference')->nullable();
    $table->string('property_type_preference')->nullable();
    $table->timestamp('last_contacted_at')->nullable();
    $table->timestamp('converted_at')->nullable(); // When became client
    $table->timestamps();
    $table->softDeletes();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'assigned_to']);
    $table->index('created_at');
});
```

##### **clients**
```php
Schema::create('clients', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Linked user account
    $table->string('name');
    $table->string('email');
    $table->string('phone');
    $table->text('address')->nullable();
    $table->string('city')->nullable();
    $table->string('state')->nullable();
    $table->string('country')->nullable();
    $table->enum('type', ['individual', 'corporate'])->default('individual');
    $table->string('company_name')->nullable();
    $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('converted_from_lead_id')->nullable()->constrained('leads')->onDelete('set null');
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->text('notes')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'assigned_to']);
});
```

##### **followups**
```php
Schema::create('followups', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('lead_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who created
    $table->enum('type', ['call', 'email', 'meeting', 'site_visit', 'other'])->default('call');
    $table->text('notes');
    $table->timestamp('scheduled_at')->nullable();
    $table->timestamp('completed_at')->nullable();
    $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'user_id']);
    $table->index('scheduled_at');
});
```

##### **appointments**
```php
Schema::create('appointments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Realtor
    $table->foreignId('property_id')->nullable()->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('description')->nullable();
    $table->timestamp('start_time');
    $table->timestamp('end_time');
    $table->string('location')->nullable();
    $table->enum('status', ['scheduled', 'completed', 'cancelled', 'no_show'])->default('scheduled');
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'user_id']);
    $table->index('start_time');
});
```

---

#### **PROPERTIES TABLES**

##### **properties**
```php
Schema::create('properties', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('title');
    $table->string('slug');
    $table->text('description');
    $table->foreignId('category_id')->constrained('property_categories')->onDelete('cascade');
    $table->enum('type', ['sale', 'rent', 'lease', 'shortlet'])->default('sale');
    $table->enum('status', ['available', 'sold', 'rented', 'pending', 'draft'])->default('draft');
    $table->decimal('price', 15, 2);
    $table->string('price_period')->nullable(); // per month, per year, per night
    $table->text('address');
    $table->string('city');
    $table->string('state');
    $table->string('country');
    $table->string('zip_code')->nullable();
    $table->decimal('latitude', 10, 7)->nullable();
    $table->decimal('longitude', 10, 7)->nullable();
    $table->integer('bedrooms')->nullable();
    $table->integer('bathrooms')->nullable();
    $table->decimal('area', 10, 2)->nullable(); // in sqft or sqm
    $table->string('area_unit')->default('sqft');
    $table->integer('year_built')->nullable();
    $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_published')->default(false);
    $table->integer('view_count')->default(0);
    $table->json('amenities')->nullable(); // Pool, Gym, Parking, etc.
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'category_id']);
    $table->index('is_published');
    $table->index('created_at');
    $table->unique(['tenant_id', 'slug']);
});
```

##### **property_categories**
```php
Schema::create('property_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->string('icon')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();

    $table->index('slug');
});

// Seed with: Land, Houses, Apartments, Commercial, Shortlet, Estates, etc.
```

##### **property_media**
```php
Schema::create('property_media', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['image', 'video', 'document', '360_view'])->default('image');
    $table->string('file_path');
    $table->string('file_name');
    $table->integer('file_size')->nullable(); // in bytes
    $table->boolean('is_primary')->default(false);
    $table->integer('sort_order')->default(0);
    $table->timestamps();

    $table->index(['property_id', 'type']);
});
```

##### **property_documents**
```php
Schema::create('property_documents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->enum('type', ['deed', 'survey', 'permit', 'contract', 'other'])->default('other');
    $table->string('file_path');
    $table->string('file_name');
    $table->integer('file_size')->nullable();
    $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
    $table->timestamps();

    $table->index(['tenant_id', 'property_id']);
});
```

##### **property_features**
```php
Schema::create('property_features', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->string('name'); // e.g., "Swimming Pool", "Gym", "Security"
    $table->string('value')->nullable(); // e.g., "24/7"
    $table->timestamps();

    $table->index('property_id');
});
```

---

#### **TRANSACTIONS & PAYMENTS TABLES**

##### **transactions**
```php
Schema::create('transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('transaction_number')->unique();
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('realtor_id')->constrained('users')->onDelete('cascade');
    $table->enum('type', ['sale', 'rental', 'lease'])->default('sale');
    $table->decimal('amount', 15, 2);
    $table->decimal('commission_rate', 5, 2)->nullable(); // Percentage
    $table->decimal('commission_amount', 15, 2)->nullable();
    $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
    $table->timestamp('closed_at')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'client_id']);
    $table->index('transaction_number');
});
```

##### **payments**
```php
Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->string('payment_number')->unique();
    $table->decimal('amount', 15, 2);
    $table->enum('method', ['cash', 'bank_transfer', 'card', 'cheque', 'other'])->default('cash');
    $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
    $table->string('reference')->nullable();
    $table->text('notes')->nullable();
    $table->timestamp('paid_at')->nullable();
    $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index(['tenant_id', 'client_id']);
    $table->index('payment_number');
});
```

##### **invoices**
```php
Schema::create('invoices', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('invoice_number')->unique();
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('cascade');
    $table->decimal('subtotal', 15, 2);
    $table->decimal('tax', 15, 2)->default(0);
    $table->decimal('total', 15, 2);
    $table->enum('status', ['draft', 'sent', 'paid', 'overdue', 'cancelled'])->default('draft');
    $table->timestamp('issued_at')->nullable();
    $table->timestamp('due_at')->nullable();
    $table->timestamp('paid_at')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index('invoice_number');
});
```

##### **contracts**
```php
Schema::create('contracts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('contract_number')->unique();
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('cascade');
    $table->enum('type', ['sale', 'rental', 'lease'])->default('sale');
    $table->text('terms');
    $table->string('file_path')->nullable();
    $table->timestamp('start_date')->nullable();
    $table->timestamp('end_date')->nullable();
    $table->enum('status', ['draft', 'sent', 'signed', 'expired', 'terminated'])->default('draft');
    $table->timestamp('signed_at')->nullable();
    $table->string('signature_path')->nullable(); // E-signature
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index('contract_number');
});
```

---

#### **CLIENT PORTAL TABLES**

##### **client_properties**
```php
Schema::create('client_properties', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('property_id')->constrained()->onDelete('cascade');
    $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('cascade');
    $table->timestamp('purchased_at')->nullable();
    $table->decimal('purchase_price', 15, 2)->nullable();
    $table->timestamps();

    $table->index(['tenant_id', 'client_id']);
    $table->unique(['client_id', 'property_id']);
});
```

##### **client_documents**
```php
Schema::create('client_documents', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->enum('type', ['contract', 'invoice', 'receipt', 'deed', 'other'])->default('other');
    $table->string('file_path');
    $table->string('file_name');
    $table->integer('file_size')->nullable();
    $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
    $table->timestamps();

    $table->index(['tenant_id', 'client_id']);
});
```

##### **support_tickets**
```php
Schema::create('support_tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('ticket_number')->unique();
    $table->foreignId('client_id')->constrained()->onDelete('cascade');
    $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
    $table->string('subject');
    $table->text('message');
    $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
    $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
    $table->index('ticket_number');
});
```

---

#### **WEBSITE BUILDER TABLES**

##### **pages**
```php
Schema::create('pages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('title');
    $table->string('slug');
    $table->longText('content');
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->string('meta_keywords')->nullable();
    $table->boolean('is_published')->default(false);
    $table->integer('sort_order')->default(0);
    $table->timestamps();

    $table->index(['tenant_id', 'slug']);
    $table->index('is_published');
});
```

##### **menus**
```php
Schema::create('menus', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('name');
    $table->string('location'); // header, footer, sidebar
    $table->boolean('is_active')->default(true);
    $table->timestamps();

    $table->index(['tenant_id', 'location']);
});
```

##### **menu_items**
```php
Schema::create('menu_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('menu_id')->constrained()->onDelete('cascade');
    $table->string('label');
    $table->string('url');
    $table->foreignId('parent_id')->nullable()->constrained('menu_items')->onDelete('cascade');
    $table->integer('sort_order')->default(0);
    $table->boolean('open_new_tab')->default(false);
    $table->timestamps();

    $table->index('menu_id');
    $table->index('parent_id');
});
```

##### **blog_posts**
```php
Schema::create('blog_posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('title');
    $table->string('slug');
    $table->text('excerpt')->nullable();
    $table->longText('content');
    $table->string('featured_image')->nullable();
    $table->foreignId('category_id')->nullable()->constrained('blog_categories')->onDelete('set null');
    $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
    $table->boolean('is_published')->default(false);
    $table->timestamp('published_at')->nullable();
    $table->integer('view_count')->default(0);
    $table->timestamps();

    $table->index(['tenant_id', 'is_published']);
    $table->index(['tenant_id', 'slug']);
});
```

##### **blog_categories**
```php
Schema::create('blog_categories', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->string('name');
    $table->string('slug');
    $table->text('description')->nullable();
    $table->timestamps();

    $table->index(['tenant_id', 'slug']);
});
```

##### **inquiries**
```php
Schema::create('inquiries', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->constrained('agencies')->onDelete('cascade');
    $table->foreignId('property_id')->nullable()->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->text('message');
    $table->enum('status', ['new', 'contacted', 'converted', 'spam'])->default('new');
    $table->string('ip_address')->nullable();
    $table->timestamps();

    $table->index(['tenant_id', 'status']);
});
```

---

#### **SYSTEM TABLES**

##### **activity_logs**
```php
Schema::create('activity_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('tenant_id')->nullable()->constrained('agencies')->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('action'); // created, updated, deleted, viewed
    $table->string('model'); // Property, Lead, Client, etc.
    $table->unsignedBigInteger('model_id')->nullable();
    $table->text('description');
    $table->json('changes')->nullable(); // Before and after values
    $table->string('ip_address')->nullable();
    $table->string('user_agent')->nullable();
    $table->timestamps();

    $table->index(['tenant_id', 'user_id']);
    $table->index('created_at');
});
```

##### **notifications**
```php
Schema::create('notifications', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('type');
    $table->morphs('notifiable');
    $table->text('data');
    $table->timestamp('read_at')->nullable();
    $table->timestamps();

    $table->index(['notifiable_type', 'notifiable_id']);
});
```

##### **system_settings**
```php
Schema::create('system_settings', function (Blueprint $table) {
    $table->id();
    $table->string('key')->unique();
    $table->text('value')->nullable();
    $table->string('type')->default('string'); // string, boolean, json, integer
    $table->text('description')->nullable();
    $table->timestamps();

    $table->index('key');
});
```

---

### 4.3 Relationships Summary

```
User
├── belongsTo: Agency
├── belongsToMany: Roles
├── hasMany: Leads (as created_by)
├── hasMany: Leads (as assigned_to)
├── hasMany: Properties (as created_by)
├── hasMany: Followups
└── hasMany: ActivityLogs

Agency (Tenant)
├── hasMany: Users
├── hasMany: Branches
├── hasOne: AgencySettings
├── hasMany: Subscriptions
├── hasMany: Leads
├── hasMany: Clients
├── hasMany: Properties
├── hasMany: Transactions
└── hasMany: Pages

Property
├── belongsTo: Agency (tenant)
├── belongsTo: Category
├── belongsTo: User (created_by)
├── hasMany: PropertyMedia
├── hasMany: PropertyDocuments
├── hasMany: PropertyFeatures
└── hasMany: Transactions

Lead
├── belongsTo: Agency (tenant)
├── belongsTo: User (assigned_to)
├── belongsTo: User (created_by)
└── hasMany: Followups

Client
├── belongsTo: Agency (tenant)
├── belongsTo: User (user account)
├── belongsTo: User (assigned_to)
├── belongsTo: Lead (converted_from)
├── hasMany: Transactions
├── hasMany: ClientProperties
└── hasMany: ClientDocuments

Transaction
├── belongsTo: Agency (tenant)
├── belongsTo: Property
├── belongsTo: Client
├── belongsTo: User (realtor)
├── hasMany: Payments
└── hasOne: Contract
```

### 4.4 Indexes Strategy

**Critical Indexes:**
```sql
-- Multi-column indexes for tenant isolation
INDEX idx_tenant_status ON properties(tenant_id, status);
INDEX idx_tenant_published ON properties(tenant_id, is_published);
INDEX idx_tenant_assigned ON leads(tenant_id, assigned_to);
INDEX idx_tenant_client ON transactions(tenant_id, client_id);

-- Performance indexes
INDEX idx_created_at ON leads(created_at);
INDEX idx_published_at ON properties(published_at);
INDEX idx_scheduled_at ON followups(scheduled_at);

-- Unique indexes
UNIQUE INDEX idx_slug ON agencies(slug);
UNIQUE INDEX idx_transaction_number ON transactions(transaction_number);
UNIQUE INDEX idx_invoice_number ON invoices(invoice_number);
```

---

## 5. Feature-by-Feature Specification

### 5.1 Super Admin Panel Features

#### **Dashboard Overview**
- Total agencies count (active, suspended, trial)
- Monthly recurring revenue (MRR)
- Total users across all agencies
- Total properties listed
- Revenue charts (monthly, yearly)
- Recent agency registrations
- System health metrics

#### **Agency Management**
- List all agencies with filters (status, plan, registration date)
- View agency details
- Edit agency information
- Suspend/Activate agencies
- Delete agencies (with confirmation)
- View agency statistics
- Impersonate agency admin (login as)
- Agency activity log

#### **Subscription Plan Management**
- Create subscription plans
- Edit plan details (name, price, features, limits)
- Set plan features
