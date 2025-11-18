# Real Estate SaaS - Installation Guide

## Requirements

- PHP >= 8.1
- MySQL >= 5.7 or 8.0
- Apache or Nginx Web Server
- Composer (for local development)

## Installation on cPanel/Shared Hosting

### Step 1: Upload Files

1. Download the ZIP file from CodeCanyon
2. Extract the ZIP file
3. Upload all files to your hosting account (usually `public_html` or `www` folder)

### Step 2: Configure Database

1. Log in to your cPanel
2. Create a new MySQL database
3. Create a new MySQL user
4. Assign the user to the database with all privileges
5. Note down:
   - Database name
   - Database username
   - Database password
   - Database host (usually `localhost`)

### Step 3: Environment Configuration

1. Rename `.env.example` to `.env`
2. Open `.env` file and update these values:

```env
APP_NAME="Real Estate SaaS"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Step 4: Set Permissions

Set the following folder permissions to 755 (or 775):
- `storage/`
- `bootstrap/cache/`

### Step 5: Run Installation

**Option A: Using Browser (Recommended for cPanel)**

1. Navigate to: `https://yourdomain.com/install`
2. Follow the installation wizard
3. The wizard will:
   - Verify server requirements
   - Configure database
   - Run migrations
   - Seed demo data
   - Create admin account

**Option B: Using SSH/Terminal**

If you have SSH access:

```bash
# Navigate to your project directory
cd /home/username/public_html

# Install dependencies
composer install --optimize-autoloader --no-dev

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Seed demo data (optional)
php artisan db:seed --force

# Create storage link
php artisan storage:link

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Access the Application

1. Visit your domain: `https://yourdomain.com`
2. Log in with default credentials:
   - **Super Admin**: admin@example.com / password
   - **Agency**: agency@example.com / password
   - **Realtor**: realtor@example.com / password
   - **Client**: client@example.com / password

**IMPORTANT**: Change all default passwords immediately!

## Installation on Local Development (XAMPP/WAMP/MAMP)

### Step 1: Prerequisites

1. Install XAMPP/WAMP/MAMP
2. Install Composer from https://getcomposer.org
3. Start Apache and MySQL

### Step 2: Setup Project

```bash
# Clone/Extract project
cd /path/to/htdocs  # or www folder

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 3: Configure Database

1. Open phpMyAdmin
2. Create a new database (e.g., `real_estate_saas`)
3. Update `.env` file:

```env
DB_DATABASE=real_estate_saas
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations & Seeders

```bash
# Run migrations
php artisan migrate

# Seed demo data
php artisan db:seed

# Create storage link
php artisan storage:link
```

### Step 5: Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Post-Installation Configuration

### 1. Email Configuration

Update `.env` with your SMTP details:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Payment Gateway Setup

**Stripe:**
```env
STRIPE_KEY=your-stripe-publishable-key
STRIPE_SECRET=your-stripe-secret-key
STRIPE_WEBHOOK_SECRET=your-stripe-webhook-secret
```

**Paystack:**
```env
PAYSTACK_PUBLIC_KEY=your-paystack-public-key
PAYSTACK_SECRET_KEY=your-paystack-secret-key
PAYSTACK_MERCHANT_EMAIL=your-email@example.com
```

### 3. Storage Configuration

For production, configure cloud storage (AWS S3, DigitalOcean Spaces, etc.):

```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

### 4. Multi-Tenancy Configuration

Choose subdomain or path-based tenancy:

```env
TENANT_MODE=subdomain
MAIN_DOMAIN=yourdomain.com
```

For subdomain mode, configure wildcard DNS:
- Create an A record: `*.yourdomain.com` → Your server IP

## Troubleshooting

### 500 Internal Server Error

1. Check file permissions (755 for folders, 644 for files)
2. Ensure `storage/` and `bootstrap/cache/` are writable
3. Check `.htaccess` file exists in `public/` folder
4. Enable error reporting in `.env`: `APP_DEBUG=true`

### Database Connection Error

1. Verify database credentials in `.env`
2. Ensure MySQL service is running
3. Test database connection from cPanel/phpMyAdmin
4. Check if database user has correct privileges

### White Screen / Blank Page

1. Clear cache: `php artisan cache:clear`
2. Clear config: `php artisan config:clear`
3. Regenerate autoload files: `composer dump-autoload`
4. Check PHP error logs

### Images Not Loading

1. Run: `php artisan storage:link`
2. Check file permissions on `storage/` and `public/storage/`
3. Verify `APP_URL` in `.env` matches your domain

## Updating the Application

1. Backup your database
2. Backup your `.env` file
3. Upload new files (overwrite existing)
4. Restore your `.env` file
5. Run migrations: `php artisan migrate --force`
6. Clear cache: `php artisan cache:clear`

## Security Best Practices

1. ✅ Change all default passwords
2. ✅ Set `APP_DEBUG=false` in production
3. ✅ Use strong database passwords
4. ✅ Keep Laravel and dependencies updated
5. ✅ Configure HTTPS/SSL certificate
6. ✅ Set proper file permissions
7. ✅ Enable CSRF protection
8. ✅ Configure rate limiting
9. ✅ Regular database backups
10. ✅ Monitor application logs

## Support

For support, please:
1. Check the documentation
2. Search the FAQs
3. Contact via CodeCanyon support tab

## License

This is a CodeCanyon Commercial License.
You may use this software for one website per license purchased.
