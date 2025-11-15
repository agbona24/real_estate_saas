# CodeCanyon Deployment & Packaging Strategy

## Table of Contents
1. [CodeCanyon Requirements](#codecanyon-requirements)
2. [Package Structure](#package-structure)
3. [Installation Wizard](#installation-wizard)
4. [Deployment Options](#deployment-options)
5. [Server Requirements](#server-requirements)
6. [Installation Guide](#installation-guide)
7. [Update Mechanism](#update-mechanism)
8. [White-Label Configuration](#white-label-configuration)
9. [License Management](#license-management)
10. [Support & Documentation](#support--documentation)

---

## CodeCanyon Requirements

### Submission Checklist

#### 1. Code Quality
- ✅ Clean, well-commented code
- ✅ Follow PSR standards (PHP) or Airbnb style (JavaScript)
- ✅ No hardcoded credentials or API keys
- ✅ Environment-based configuration
- ✅ Error handling and validation
- ✅ Security best practices (XSS, SQL injection prevention)

#### 2. Documentation
- ✅ Comprehensive README file
- ✅ Installation guide (step-by-step)
- ✅ User manual (PDF + online)
- ✅ Admin manual
- ✅ API documentation
- ✅ FAQ section
- ✅ Troubleshooting guide
- ✅ Video tutorials (optional but recommended)

#### 3. Demo & Presentation
- ✅ Live demo URL
- ✅ Demo credentials (admin, agent, client)
- ✅ Screenshot requirements (main.png, preview images)
- ✅ Feature list with screenshots
- ✅ Professional item description

#### 4. Support & Updates
- ✅ 6 months support included (minimum)
- ✅ Extended 12-month support option
- ✅ Regular updates commitment
- ✅ Changelog documentation
- ✅ Support ticket system or dedicated email

#### 5. Licensing
- ✅ Regular License (single end product)
- ✅ Extended License (multiple end products/SaaS)
- ✅ License verification system
- ✅ Terms of use documentation

---

## Package Structure

### Final Package Contents

```
real-estate-saas-v1.0.0.zip
│
├── 📄 README.md (Installation quick start)
├── 📄 LICENSE.txt (License agreement)
├── 📄 CHANGELOG.md (Version history)
│
├── 📁 source-code/
│   ├── 📁 backend/
│   │   ├── 📁 src/
│   │   ├── 📁 config/
│   │   ├── 📁 database/
│   │   ├── 📄 package.json
│   │   ├── 📄 .env.example
│   │   └── 📄 server.js
│   │
│   ├── 📁 frontend/
│   │   ├── 📁 src/
│   │   ├── 📁 public/
│   │   ├── 📄 package.json
│   │   ├── 📄 .env.example
│   │   └── 📄 README.md
│   │
│   └── 📁 installer/ (Web-based installation wizard)
│       ├── 📄 index.php
│       ├── 📄 install.css
│       ├── 📄 install.js
│       └── 📁 steps/
│
├── 📁 documentation/
│   ├── 📄 Installation-Guide.pdf
│   ├── 📄 User-Manual.pdf
│   ├── 📄 Admin-Manual.pdf
│   ├── 📄 API-Documentation.pdf
│   ├── 📄 Developer-Guide.pdf
│   ├── 📁 screenshots/
│   └── 📁 videos/ (tutorial links)
│
├── 📁 database/
│   ├── 📄 schema.sql (Database structure)
│   ├── 📄 seed-data.sql (Sample data - optional)
│   └── 📄 migrations/ (Version migrations)
│
├── 📁 assets/
│   ├── 📁 demo-images/ (Sample property images)
│   ├── 📁 icons/
│   └── 📁 templates/ (Email, document templates)
│
└── 📁 extras/
    ├── 📄 nginx.conf.example (Server config examples)
    ├── 📄 apache.conf.example
    ├── 📄 docker-compose.yml (Optional Docker setup)
    └── 📁 postman/ (API testing collection)
```

---

## Installation Wizard

### Wizard Flow (7 Steps)

#### Step 1: Welcome & Requirements Check

```
┌─────────────────────────────────────────────────────┐
│                                                     │
│   🏠 Real Estate SaaS Platform - Installation       │
│                                                     │
│   Welcome! This wizard will guide you through       │
│   the installation process.                         │
│                                                     │
│   ─────────────────────────────────────────────     │
│                                                     │
│   System Requirements Check:                        │
│                                                     │
│   ✅ PHP Version (>= 8.0)            8.1.0         │
│   ✅ Node.js Version (>= 16.0)       16.14.0       │
│   ✅ PostgreSQL (>= 13.0)            14.2          │
│   ✅ Redis                           6.2.6         │
│   ✅ PHP Extensions:                                │
│      ✅ PDO, PDO_PGSQL, OpenSSL, MBstring          │
│      ✅ GD, CURL, XML, ZIP                         │
│   ✅ File Permissions:                              │
│      ✅ storage/ (writable)                         │
│      ✅ public/uploads/ (writable)                  │
│   ✅ Available Disk Space            50 GB          │
│                                                     │
│   [Continue to License Verification →]              │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Step 2: License Verification

```
┌─────────────────────────────────────────────────────┐
│   License Verification                              │
│   ─────────────────────────────────────────────     │
│                                                     │
│   Please enter your purchase information:           │
│                                                     │
│   Purchase Code (from CodeCanyon):                  │
│   ┌───────────────────────────────────────────┐   │
│   │ xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx      │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
│   Your Email:                                       │
│   ┌───────────────────────────────────────────┐   │
│   │ buyer@email.com                           │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
│   Domain (where you'll install):                    │
│   ┌───────────────────────────────────────────┐   │
│   │ https://yourdomain.com                    │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
│   [Verify License]                                  │
│                                                     │
│   ℹ️  Your license will be validated with Envato   │
│      API. Internet connection required.             │
│                                                     │
│   [← Back] [Skip (Development)] [Continue →]       │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Step 3: Database Configuration

```
┌─────────────────────────────────────────────────────┐
│   Database Configuration                            │
│   ─────────────────────────────────────────────     │
│                                                     │
│   PostgreSQL Database Settings:                     │
│                                                     │
│   Host:          ┌────────────────────────┐        │
│                  │ localhost              │        │
│                  └────────────────────────┘        │
│                                                     │
│   Port:          ┌────────────────────────┐        │
│                  │ 5432                   │        │
│                  └────────────────────────┘        │
│                                                     │
│   Database Name: ┌────────────────────────┐        │
│                  │ realestate_db          │        │
│                  └────────────────────────┘        │
│                                                     │
│   Username:      ┌────────────────────────┐        │
│                  │ postgres               │        │
│                  └────────────────────────┘        │
│                                                     │
│   Password:      ┌────────────────────────┐        │
│                  │ ••••••••••             │        │
│                  └────────────────────────┘        │
│                                                     │
│   [Test Connection]                                 │
│                                                     │
│   ✅ Connection successful!                         │
│                                                     │
│   Redis Configuration:                              │
│   Host: localhost    Port: 6379   Password: (opt)  │
│                                                     │
│   [← Back] [Continue →]                            │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Step 4: Admin Account Setup

```
┌─────────────────────────────────────────────────────┐
│   Create Super Admin Account                       │
│   ─────────────────────────────────────────────     │
│                                                     │
│   First Name:    ┌────────────────────────┐        │
│                  │ John                   │        │
│                  └────────────────────────┘        │
│                                                     │
│   Last Name:     ┌────────────────────────┐        │
│                  │ Doe                    │        │
│                  └────────────────────────┘        │
│                                                     │
│   Email:         ┌────────────────────────┐        │
│                  │ admin@yourdomain.com   │        │
│                  └────────────────────────┘        │
│                                                     │
│   Password:      ┌────────────────────────┐        │
│                  │ ••••••••••             │        │
│                  └────────────────────────┘        │
│                  Password strength: Strong 💪       │
│                                                     │
│   Confirm:       ┌────────────────────────┐        │
│                  │ ••••••••••             │        │
│                  └────────────────────────┘        │
│                                                     │
│   ⚠️  Keep these credentials safe! You'll need     │
│      them to access the admin panel.                │
│                                                     │
│   [← Back] [Continue →]                            │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Step 5: Email & SMS Configuration

```
┌─────────────────────────────────────────────────────┐
│   Email & SMS Services                              │
│   ─────────────────────────────────────────────     │
│                                                     │
│   Email Provider: ● SendGrid  ○ AWS SES  ○ SMTP    │
│                                                     │
│   SendGrid API Key:                                 │
│   ┌───────────────────────────────────────────┐   │
│   │ SG.xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx       │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
│   From Email:  ┌──────────────────────────┐        │
│                │ noreply@yourdomain.com   │        │
│                └──────────────────────────┘        │
│                                                     │
│   From Name:   ┌──────────────────────────┐        │
│                │ Your Real Estate Agency  │        │
│                └──────────────────────────┘        │
│                                                     │
│   [Test Email Configuration]                        │
│                                                     │
│   ─────────────────────────────────────────────     │
│                                                     │
│   SMS Provider (Optional):                          │
│   ○ Twilio  ○ Nexmo  ○ Skip for now                │
│                                                     │
│   ℹ️  You can configure this later in settings      │
│                                                     │
│   [← Back] [Skip] [Continue →]                     │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Step 6: Installation Progress

```
┌─────────────────────────────────────────────────────┐
│   Installing...                                     │
│   ─────────────────────────────────────────────     │
│                                                     │
│   ✅ Creating database tables...         Complete  │
│   ✅ Running migrations...                Complete  │
│   ✅ Seeding initial data...             Complete  │
│   ✅ Creating admin account...           Complete  │
│   ✅ Generating application key...       Complete  │
│   ✅ Setting up file storage...          Complete  │
│   ✅ Configuring environment...          Complete  │
│   ⏳ Installing dependencies...          Running   │
│      ████████████████░░░░░░░░░░  60%               │
│                                                     │
│   Please wait, this may take a few minutes...       │
│                                                     │
│   ℹ️  Do not close this window or navigate away     │
│                                                     │
└─────────────────────────────────────────────────────┘
```

#### Step 7: Installation Complete

```
┌─────────────────────────────────────────────────────┐
│                                                     │
│        ✅ Installation Complete!                    │
│                                                     │
│   Your Real Estate SaaS platform is ready to use!   │
│                                                     │
│   ─────────────────────────────────────────────     │
│                                                     │
│   Admin Panel:                                      │
│   🔗 https://yourdomain.com/admin                   │
│   📧 admin@yourdomain.com                           │
│                                                     │
│   Frontend:                                         │
│   🔗 https://yourdomain.com                         │
│                                                     │
│   Important Next Steps:                             │
│   1. Delete the /installer directory for security   │
│   2. Configure branding and white-label settings    │
│   3. Set up payment gateway (Stripe/PayPal)         │
│   4. Configure backup system                        │
│   5. Review security settings                       │
│                                                     │
│   Documentation:                                    │
│   📚 /documentation/User-Manual.pdf                 │
│   📚 /documentation/Admin-Manual.pdf                │
│                                                     │
│   Need help?                                        │
│   📧 support@yourdomain.com                         │
│   📖 https://docs.yourdomain.com                    │
│                                                     │
│   [Go to Admin Panel →]                             │
│                                                     │
└─────────────────────────────────────────────────────┘
```

---

## Deployment Options

### Option 1: Traditional Server Deployment

**Recommended Stack:**
- **Web Server**: Nginx (recommended) or Apache
- **Application**: Node.js (Express) + React
- **Database**: PostgreSQL 13+
- **Cache**: Redis
- **Process Manager**: PM2
- **SSL**: Let's Encrypt (Certbot)

**Deployment Steps:**
1. Provision server (VPS, dedicated, or cloud)
2. Install required software (Node.js, PostgreSQL, Redis, Nginx)
3. Upload source code via FTP/SFTP or Git
4. Run installation wizard via browser
5. Configure Nginx reverse proxy
6. Set up SSL certificate
7. Configure PM2 for auto-restart
8. Set up automated backups

---

### Option 2: Docker Deployment

**Included Files:**
- `docker-compose.yml`
- `Dockerfile` (backend)
- `Dockerfile` (frontend)
- `.dockerignore`

**Docker Compose Services:**
```yaml
version: '3.8'

services:
  database:
    image: postgres:14-alpine
    environment:
      POSTGRES_DB: realestate_db
      POSTGRES_USER: postgres
      POSTGRES_PASSWORD: ${DB_PASSWORD}
    volumes:
      - postgres_data:/var/lib/postgresql/data
    ports:
      - "5432:5432"

  redis:
    image: redis:6-alpine
    ports:
      - "6379:6379"

  backend:
    build:
      context: ./backend
      dockerfile: Dockerfile
    environment:
      - NODE_ENV=production
      - DATABASE_URL=postgresql://postgres:${DB_PASSWORD}@database:5432/realestate_db
      - REDIS_URL=redis://redis:6379
    ports:
      - "3000:3000"
    depends_on:
      - database
      - redis
    volumes:
      - ./backend:/app
      - /app/node_modules

  frontend:
    build:
      context: ./frontend
      dockerfile: Dockerfile
    environment:
      - REACT_APP_API_URL=http://backend:3000/api
    ports:
      - "80:80"
    depends_on:
      - backend

  nginx:
    image: nginx:alpine
    ports:
      - "443:443"
    volumes:
      - ./nginx.conf:/etc/nginx/nginx.conf
      - ./ssl:/etc/nginx/ssl
    depends_on:
      - frontend
      - backend

volumes:
  postgres_data:
```

**Deployment Commands:**
```bash
# Clone repository
git clone https://github.com/yourusername/real-estate-saas.git
cd real-estate-saas

# Configure environment
cp .env.example .env
# Edit .env with your settings

# Build and start containers
docker-compose up -d

# Run migrations
docker-compose exec backend npm run migrate

# Create admin user
docker-compose exec backend npm run seed:admin
```

---

### Option 3: Cloud Platform Deployment

#### AWS Deployment
- **Compute**: EC2 or ECS (containerized)
- **Database**: RDS PostgreSQL
- **Cache**: ElastiCache Redis
- **Storage**: S3 for files
- **CDN**: CloudFront
- **Load Balancer**: ALB
- **DNS**: Route 53

#### Google Cloud Platform
- **Compute**: Compute Engine or Cloud Run
- **Database**: Cloud SQL PostgreSQL
- **Cache**: Memorystore Redis
- **Storage**: Cloud Storage
- **CDN**: Cloud CDN
- **Load Balancer**: Cloud Load Balancing

#### Microsoft Azure
- **Compute**: App Service or Container Instances
- **Database**: Azure Database for PostgreSQL
- **Cache**: Azure Cache for Redis
- **Storage**: Blob Storage
- **CDN**: Azure CDN

#### DigitalOcean (Budget-Friendly)
- **Compute**: Droplet or App Platform
- **Database**: Managed PostgreSQL
- **Cache**: Managed Redis
- **Storage**: Spaces (S3-compatible)
- **CDN**: Spaces CDN

---

### Option 4: Shared Hosting (Limited Support)

**Requirements:**
- PHP 8.0+ with required extensions
- MySQL 5.7+ or PostgreSQL (if supported)
- SSH access (recommended)
- Composer installed
- Node.js support (for build process)

**Note**: Shared hosting is not recommended for production SaaS due to performance and scaling limitations. Suitable for demos or small single-tenant deployments only.

---

## Server Requirements

### Minimum Requirements (Small Deployment)

- **CPU**: 2 cores
- **RAM**: 4 GB
- **Storage**: 50 GB SSD
- **Bandwidth**: 1 TB/month
- **OS**: Ubuntu 20.04 LTS or later

**Suitable for**: Up to 50 users, 500 properties

---

### Recommended Requirements (Medium Deployment)

- **CPU**: 4 cores
- **RAM**: 8 GB
- **Storage**: 100 GB SSD
- **Bandwidth**: 3 TB/month
- **OS**: Ubuntu 22.04 LTS

**Suitable for**: Up to 500 users, 5,000 properties

---

### Production Requirements (Large Deployment)

- **CPU**: 8+ cores
- **RAM**: 16+ GB
- **Storage**: 250+ GB SSD
- **Bandwidth**: Unlimited
- **OS**: Ubuntu 22.04 LTS
- **Architecture**: Load-balanced, multi-server

**Suitable for**: 1,000+ users, 10,000+ properties

---

### Software Requirements

**Required:**
- Node.js 16.x or higher
- PostgreSQL 13.x or higher
- Redis 6.x or higher
- Nginx 1.18+ or Apache 2.4+
- SSL certificate (Let's Encrypt recommended)

**Optional:**
- Elasticsearch 7.x+ (advanced search)
- Docker & Docker Compose (containerized deployment)
- PM2 (process management)
- Git (version control)

---

## Installation Guide

### Manual Installation (Step-by-Step)

#### 1. Prepare Server

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
sudo apt install -y nodejs

# Install PostgreSQL
sudo apt install -y postgresql postgresql-contrib

# Install Redis
sudo apt install -y redis-server

# Install Nginx
sudo apt install -y nginx

# Install PM2 globally
sudo npm install -g pm2
```

#### 2. Configure PostgreSQL

```bash
# Switch to postgres user
sudo -u postgres psql

# Create database and user
CREATE DATABASE realestate_db;
CREATE USER realestate_user WITH PASSWORD 'your_secure_password';
GRANT ALL PRIVILEGES ON DATABASE realestate_db TO realestate_user;
\q
```

#### 3. Upload Application Files

```bash
# Create application directory
sudo mkdir -p /var/www/realestate-saas
sudo chown $USER:$USER /var/www/realestate-saas

# Upload files (via SCP, FTP, or Git)
cd /var/www/realestate-saas
# Extract uploaded zip or clone repository
```

#### 4. Backend Setup

```bash
cd /var/www/realestate-saas/backend

# Install dependencies
npm install

# Copy environment file
cp .env.example .env

# Edit .env file with your settings
nano .env

# Run database migrations
npm run migrate

# Seed initial data (optional)
npm run seed

# Build application (if needed)
npm run build
```

#### 5. Frontend Setup

```bash
cd /var/www/realestate-saas/frontend

# Install dependencies
npm install

# Copy environment file
cp .env.example .env

# Edit .env file
nano .env

# Build production files
npm run build
```

#### 6. Configure Nginx

```bash
# Create Nginx configuration
sudo nano /etc/nginx/sites-available/realestate-saas
```

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;

    # Redirect to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;

    ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;

    # Frontend (React build)
    root /var/www/realestate-saas/frontend/build;
    index index.html;

    # Backend API proxy
    location /api {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }

    # WebSocket support
    location /socket.io {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }

    # Frontend routes (React Router)
    location / {
        try_files $uri $uri/ /index.html;
    }

    # File uploads
    client_max_body_size 50M;
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/realestate-saas /etc/nginx/sites-enabled/

# Test configuration
sudo nginx -t

# Restart Nginx
sudo systemctl restart nginx
```

#### 7. Set Up SSL with Let's Encrypt

```bash
# Install Certbot
sudo apt install -y certbot python3-certbot-nginx

# Obtain certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Test auto-renewal
sudo certbot renew --dry-run
```

#### 8. Start Application with PM2

```bash
cd /var/www/realestate-saas/backend

# Start application
pm2 start npm --name "realestate-api" -- start

# Set to start on boot
pm2 startup
pm2 save

# Monitor application
pm2 monit
```

#### 9. Set Up Automated Backups

```bash
# Create backup script
sudo nano /usr/local/bin/backup-realestate.sh
```

```bash
#!/bin/bash
BACKUP_DIR="/var/backups/realestate"
DATE=$(date +%Y%m%d_%H%M%S)

# Create backup directory
mkdir -p $BACKUP_DIR

# Backup database
pg_dump -U realestate_user realestate_db | gzip > $BACKUP_DIR/db_$DATE.sql.gz

# Backup uploaded files
tar -czf $BACKUP_DIR/uploads_$DATE.tar.gz /var/www/realestate-saas/backend/uploads

# Delete backups older than 30 days
find $BACKUP_DIR -type f -mtime +30 -delete

echo "Backup completed: $DATE"
```

```bash
# Make executable
sudo chmod +x /usr/local/bin/backup-realestate.sh

# Add to crontab (daily at 2 AM)
sudo crontab -e
# Add line:
0 2 * * * /usr/local/bin/backup-realestate.sh
```

---

## Update Mechanism

### Automatic Update System

**Features:**
- One-click updates from admin panel
- Automatic database migrations
- Backup before update
- Rollback capability
- Change log display

**Update Process:**

1. **Check for Updates**
   - Admin panel shows available updates
   - Displays version number and changelog
   - "Update Now" button

2. **Pre-Update**
   - Automatic backup of database
   - Automatic backup of files
   - Maintenance mode enabled

3. **Update Execution**
   - Download new version
   - Extract files
   - Run database migrations
   - Clear caches
   - Update dependencies

4. **Post-Update**
   - Verify installation
   - Disable maintenance mode
   - Log update completion
   - Send notification to admin

5. **Rollback (if needed)**
   - Restore database from backup
   - Restore files from backup
   - Log rollback event

### Manual Update Process

```bash
# 1. Backup current installation
cd /var/www/realestate-saas
tar -czf ../backup-$(date +%Y%m%d).tar.gz .
pg_dump -U realestate_user realestate_db > ../db-backup-$(date +%Y%m%d).sql

# 2. Enable maintenance mode
touch backend/maintenance.flag

# 3. Download new version
wget https://downloads.yourdomain.com/realestate-saas-v1.1.0.zip
unzip realestate-saas-v1.1.0.zip -d ../update-temp

# 4. Stop application
pm2 stop realestate-api

# 5. Replace files (preserve uploads and config)
rsync -av --exclude='uploads' --exclude='.env' ../update-temp/ .

# 6. Update dependencies
cd backend && npm install
cd ../frontend && npm install && npm run build

# 7. Run migrations
cd ../backend
npm run migrate

# 8. Restart application
pm2 restart realestate-api

# 9. Disable maintenance mode
rm backend/maintenance.flag

# 10. Verify
pm2 logs realestate-api
```

---

## White-Label Configuration

### Branding Customization

**Via Admin Panel:**
1. Login to admin panel
2. Navigate to Settings → Branding
3. Configure:
   - Company name
   - Logo upload (light/dark versions)
   - Favicon
   - Color scheme (primary, secondary, accent)
   - Typography (font selection)
   - Email templates branding
   - Footer text and links

**Via Configuration File:**

```javascript
// config/branding.js
module.exports = {
  companyName: 'Your Real Estate Agency',
  domain: 'yourdomain.com',
  logo: {
    light: '/assets/logo-light.png',
    dark: '/assets/logo-dark.png',
  },
  colors: {
    primary: '#2563EB',
    secondary: '#10B981',
    accent: '#F59E0B',
  },
  fonts: {
    heading: 'Inter',
    body: 'Inter',
  },
  contact: {
    email: 'info@yourdomain.com',
    phone: '+1 (555) 123-4567',
    address: '123 Main St, City, State 12345',
  },
  social: {
    facebook: 'https://facebook.com/yourpage',
    twitter: 'https://twitter.com/yourhandle',
    linkedin: 'https://linkedin.com/company/yourcompany',
    instagram: 'https://instagram.com/yourhandle',
  },
  poweredBy: {
    show: false, // Set to true to show "Powered by YourBrand"
    text: 'Powered by YourBrand',
    link: 'https://yourdomain.com',
  },
};
```

---

## License Management

### Purchase Code Verification

**Implementation:**

```javascript
// utils/licenseVerifier.js
const axios = require('axios');

class LicenseVerifier {
  constructor() {
    this.apiUrl = 'https://api.envato.com/v3/market';
  }

  async verifyPurchaseCode(code, buyerEmail) {
    try {
      const response = await axios.get(
        `${this.apiUrl}/author/sale`,
        {
          headers: {
            'Authorization': `Bearer ${process.env.ENVATO_API_TOKEN}`,
          },
          params: {
            code: code,
          },
        }
      );

      if (response.data && response.data.buyer === buyerEmail) {
        return {
          valid: true,
          purchaseDate: response.data.sold_at,
          license: response.data.license,
          supportedUntil: response.data.supported_until,
        };
      }

      return { valid: false, error: 'Invalid purchase code or email' };
    } catch (error) {
      return { valid: false, error: error.message };
    }
  }

  async checkSupport(purchaseCode) {
    // Check if support is still active
    const verification = await this.verifyPurchaseCode(purchaseCode);
    if (!verification.valid) return false;

    const supportEnd = new Date(verification.supportedUntil);
    const now = new Date();

    return now <= supportEnd;
  }
}

module.exports = new LicenseVerifier();
```

### License Types

**Regular License** ($59 - example pricing)
- Single end product for one client
- Cannot be resold as-is
- Free updates for 6 months
- 6 months support

**Extended License** ($299 - example pricing)
- Multiple end products
- Can be used in SaaS products
- Charge end users
- Free updates for 12 months
- 12 months support
- Priority support

---

## Support & Documentation

### Support Channels

1. **Documentation Site**
   - URL: https://docs.yourdomain.com
   - Searchable knowledge base
   - Video tutorials
   - API reference

2. **Support Ticket System**
   - Email: support@yourdomain.com
   - Response time: 24-48 hours
   - Premium support: 12-24 hours

3. **Community Forum**
   - User community
   - Feature requests
   - Bug reports
   - Knowledge sharing

4. **Live Chat** (Premium support only)
   - Business hours: 9 AM - 5 PM EST
   - Instant assistance

### Documentation Structure

```
docs.yourdomain.com/
├── Getting Started
│   ├── Installation Guide
│   ├── Quick Start Tutorial
│   └── System Requirements
├── User Guide
│   ├── Dashboard Overview
│   ├── Managing Properties
│   ├── Lead Management
│   ├── Transactions
│   └── Reports & Analytics
├── Admin Guide
│   ├── User Management
│   ├── Branding & White-Label
│   ├── Payment Configuration
│   ├── Email & SMS Setup
│   └── Backup & Security
├── Developer Guide
│   ├── API Documentation
│   ├── Webhooks
│   ├── Customization
│   └── Troubleshooting
├── Video Tutorials
├── FAQ
└── Changelog
```

### Update & Support Policy

**Included with Purchase:**
- Free updates for 6 months (Regular) / 12 months (Extended)
- Support for 6 months (Regular) / 12 months (Extended)
- Access to documentation and tutorials
- Bug fixes and security patches

**After Support Period:**
- Continued access to existing version
- Option to extend support (annual fee)
- Major updates may require additional purchase
- Community forum access remains free

---

## CodeCanyon Submission Checklist

### Pre-Submission

- [ ] Complete all features as described
- [ ] Test on fresh server installation
- [ ] Review code for hardcoded values
- [ ] Prepare comprehensive documentation
- [ ] Create installation wizard
- [ ] Set up demo site with sample data
- [ ] Create promotional screenshots
- [ ] Write detailed item description
- [ ] Prepare feature list
- [ ] Create preview video (recommended)
- [ ] Test license verification system
- [ ] Ensure GPL-compatible (if applicable)

### Submission Requirements

- [ ] Main file (source code ZIP)
- [ ] Documentation (PDF and online)
- [ ] Demo URL and credentials
- [ ] Main preview image (590x300px)
- [ ] Additional screenshots
- [ ] Item description (clear, detailed)
- [ ] Feature list
- [ ] Category selection
- [ ] Tags (relevant keywords)
- [ ] Compatible browsers/versions
- [ ] Software version (PHP, Node.js, etc.)
- [ ] Demo content (optional)

### Post-Submission

- [ ] Respond to reviewer feedback
- [ ] Make required changes promptly
- [ ] Test all requested modifications
- [ ] Monitor for approval status
- [ ] Prepare for launch (marketing)
- [ ] Set up support system
- [ ] Create social media presence
- [ ] Prepare launch announcement

---

**Version**: 1.0
**Last Updated**: 2025-11-15
**Support**: support@yourdomain.com
