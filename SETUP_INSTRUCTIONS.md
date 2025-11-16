# Real Estate SaaS - Setup Instructions

## Database Setup

### 1. Run Migrations
First, run the database migrations to create all necessary tables:

```bash
php artisan migrate
```

### 2. Seed Demo Users
Seed the database with demo user accounts for testing:

```bash
php artisan db:seed
```

Or specifically run the demo users seeder:

```bash
php artisan db:seed --class=DemoUsersSeeder
```

## Demo Login Credentials

After seeding, you can login with these demo accounts:

| Role | Email | Password |
|------|-------|----------|
| **Super Admin** | admin@demo.com | password |
| **Agency Admin** | agency@demo.com | password |
| **Realtor** | realtor@demo.com | password |
| **Client** | client@demo.com | password |

## Accessing the Application

1. **Landing Page**: `http://127.0.0.1:8000/`
2. **Login**: `http://127.0.0.1:8000/login`
3. **Register**: `http://127.0.0.1:8000/register`
4. **Dashboard**: `http://127.0.0.1:8000/dashboard` (after login)

## Quick Start

```bash
# 1. Install dependencies (if not already done)
composer install

# 2. Create .env file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Run migrations
php artisan migrate

# 5. Seed demo users
php artisan db:seed

# 6. Start development server
php artisan serve
```

## Testing the Authentication Flow

1. Visit the landing page at `http://127.0.0.1:8000/`
2. Click "Get Started Free" or "Log in"
3. Use any of the demo credentials above
4. You'll be redirected to a role-specific dashboard

## Role-Based Dashboards

Each user role has access to a different dashboard:

- **Super Admin** → `/superadmin/dashboard`
- **Agency Admin** → `/agency/dashboard`
- **Realtor** → `/realtor/dashboard`
- **Client** → `/client/dashboard`

---

**Note**: All demo accounts use the password `password` for easy testing.
