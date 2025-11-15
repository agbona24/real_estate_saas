# Security, Compliance & Best Practices

## Table of Contents
1. [Security Architecture](#security-architecture)
2. [Authentication & Authorization](#authentication--authorization)
3. [Data Protection](#data-protection)
4. [API Security](#api-security)
5. [Infrastructure Security](#infrastructure-security)
6. [Compliance](#compliance)
7. [Security Best Practices](#security-best-practices)
8. [Vulnerability Management](#vulnerability-management)
9. [Incident Response](#incident-response)
10. [Security Audit Checklist](#security-audit-checklist)

---

## Security Architecture

### Defense in Depth Strategy

```
┌─────────────────────────────────────────────────────────┐
│ Layer 1: Network Security                               │
│ - Firewall rules                                        │
│ - DDoS protection (Cloudflare)                          │
│ - VPN for admin access                                  │
└─────────────────────────────────────────────────────────┘
                         ↓
┌─────────────────────────────────────────────────────────┐
│ Layer 2: Application Security                           │
│ - WAF (Web Application Firewall)                        │
│ - Rate limiting                                         │
│ - Input validation                                      │
│ - HTTPS/TLS encryption                                  │
└─────────────────────────────────────────────────────────┘
                         ↓
┌─────────────────────────────────────────────────────────┐
│ Layer 3: Authentication & Authorization                 │
│ - JWT tokens                                            │
│ - 2FA/MFA                                               │
│ - RBAC (Role-Based Access Control)                      │
│ - Session management                                    │
└─────────────────────────────────────────────────────────┘
                         ↓
┌─────────────────────────────────────────────────────────┐
│ Layer 4: Data Security                                  │
│ - Encryption at rest (AES-256)                          │
│ - Encryption in transit (TLS 1.3)                       │
│ - Database encryption                                   │
│ - Sensitive data masking                                │
└─────────────────────────────────────────────────────────┘
                         ↓
┌─────────────────────────────────────────────────────────┐
│ Layer 5: Monitoring & Logging                           │
│ - Security event logging                                │
│ - Intrusion detection                                   │
│ - Anomaly detection                                     │
│ - Audit trails                                          │
└─────────────────────────────────────────────────────────┘
```

---

## Authentication & Authorization

### Password Security

```javascript
// utils/passwordUtils.js
const bcrypt = require('bcrypt');
const zxcvbn = require('zxcvbn');

class PasswordUtils {
  async hashPassword(password) {
    const saltRounds = 12;
    return await bcrypt.hash(password, saltRounds);
  }

  async verifyPassword(password, hash) {
    return await bcrypt.compare(password, hash);
  }

  validatePasswordStrength(password) {
    const result = zxcvbn(password);

    const requirements = {
      minLength: password.length >= 8,
      hasUppercase: /[A-Z]/.test(password),
      hasLowercase: /[a-z]/.test(password),
      hasNumber: /\d/.test(password),
      hasSpecialChar: /[!@#$%^&*(),.?":{}|<>]/.test(password),
      strength: result.score >= 3, // 0-4 scale
    };

    const isValid = Object.values(requirements).every(Boolean);

    return {
      isValid,
      requirements,
      score: result.score,
      feedback: result.feedback,
    };
  }

  async checkPasswordHistory(userId, newPassword) {
    const passwordHistory = await PasswordHistory.findAll({
      where: { userId },
      order: [['createdAt', 'DESC']],
      limit: 5, // Last 5 passwords
    });

    for (const oldPassword of passwordHistory) {
      const isReused = await this.verifyPassword(newPassword, oldPassword.hash);
      if (isReused) {
        throw new Error('Password has been used recently. Please choose a different password.');
      }
    }
  }
}

module.exports = new PasswordUtils();
```

### JWT Token Management

```javascript
// utils/jwtUtils.js
const jwt = require('jsonwebtoken');
const crypto = require('crypto');

class JWTUtils {
  generateAccessToken(user, tenant) {
    const payload = {
      userId: user.id,
      email: user.email,
      role: user.role,
      tenantId: tenant.id,
      type: 'access',
    };

    return jwt.sign(payload, process.env.JWT_ACCESS_SECRET, {
      expiresIn: '15m', // 15 minutes
      issuer: 'real-estate-saas',
      audience: 'api',
    });
  }

  generateRefreshToken(user) {
    const payload = {
      userId: user.id,
      type: 'refresh',
      jti: crypto.randomBytes(16).toString('hex'), // Unique token ID
    };

    return jwt.sign(payload, process.env.JWT_REFRESH_SECRET, {
      expiresIn: '7d', // 7 days
      issuer: 'real-estate-saas',
      audience: 'refresh',
    });
  }

  verifyAccessToken(token) {
    try {
      return jwt.verify(token, process.env.JWT_ACCESS_SECRET, {
        issuer: 'real-estate-saas',
        audience: 'api',
      });
    } catch (error) {
      if (error.name === 'TokenExpiredError') {
        throw new Error('Access token expired');
      }
      throw new Error('Invalid access token');
    }
  }

  verifyRefreshToken(token) {
    try {
      return jwt.verify(token, process.env.JWT_REFRESH_SECRET, {
        issuer: 'real-estate-saas',
        audience: 'refresh',
      });
    } catch (error) {
      throw new Error('Invalid or expired refresh token');
    }
  }

  async revokeRefreshToken(tokenId) {
    await RevokedToken.create({
      tokenId,
      revokedAt: new Date(),
    });

    // Set expiry in Redis
    await redis.setex(`revoked:${tokenId}`, 7 * 24 * 60 * 60, '1');
  }

  async isTokenRevoked(tokenId) {
    const revoked = await redis.get(`revoked:${tokenId}`);
    return revoked === '1';
  }
}

module.exports = new JWTUtils();
```

### Multi-Factor Authentication (2FA)

```javascript
// services/TwoFactorAuth.js
const speakeasy = require('speakeasy');
const QRCode = require('qrcode');

class TwoFactorAuth {
  generateSecret(email) {
    const secret = speakeasy.generateSecret({
      name: `Real Estate SaaS (${email})`,
      issuer: 'Real Estate SaaS',
      length: 32,
    });

    return {
      secret: secret.base32,
      otpauthUrl: secret.otpauth_url,
    };
  }

  async generateQRCode(otpauthUrl) {
    return await QRCode.toDataURL(otpauthUrl);
  }

  verifyToken(secret, token) {
    return speakeasy.totp.verify({
      secret: secret,
      encoding: 'base32',
      token: token,
      window: 2, // Allow 2 steps before/after for time drift
    });
  }

  generateBackupCodes() {
    const codes = [];
    for (let i = 0; i < 10; i++) {
      const code = crypto.randomBytes(4).toString('hex').toUpperCase();
      codes.push(code);
    }
    return codes;
  }

  async saveBackupCodes(userId, codes) {
    const hashedCodes = await Promise.all(
      codes.map(code => bcrypt.hash(code, 10))
    );

    await BackupCode.bulkCreate(
      hashedCodes.map(hash => ({
        userId,
        code: hash,
        used: false,
      }))
    );
  }

  async verifyBackupCode(userId, code) {
    const backupCodes = await BackupCode.findAll({
      where: { userId, used: false },
    });

    for (const backupCode of backupCodes) {
      const isValid = await bcrypt.compare(code, backupCode.code);
      if (isValid) {
        await backupCode.update({ used: true, usedAt: new Date() });
        return true;
      }
    }

    return false;
  }
}

module.exports = new TwoFactorAuth();
```

### Role-Based Access Control (RBAC)

```javascript
// middleware/authorize.js
const permissions = {
  super_admin: ['*'], // All permissions

  agency_owner: [
    'users:*',
    'properties:*',
    'leads:*',
    'transactions:*',
    'settings:*',
    'billing:*',
    'reports:*',
  ],

  agency_admin: [
    'users:read',
    'users:create',
    'users:update',
    'properties:*',
    'leads:*',
    'transactions:*',
    'reports:read',
  ],

  team_leader: [
    'properties:*',
    'leads:*',
    'transactions:read',
    'transactions:update',
    'reports:read',
  ],

  agent: [
    'properties:read',
    'properties:create',
    'properties:update:own',
    'leads:read',
    'leads:create',
    'leads:update:own',
    'transactions:read:own',
    'transactions:update:own',
  ],

  client: [
    'properties:read',
    'transactions:read:own',
    'documents:read:own',
  ],
};

function authorize(requiredPermission) {
  return (req, res, next) => {
    const { role, userId } = req.user;
    const userPermissions = permissions[role] || [];

    // Check for wildcard permission
    if (userPermissions.includes('*')) {
      return next();
    }

    // Check exact permission
    if (userPermissions.includes(requiredPermission)) {
      return next();
    }

    // Check wildcard for resource (e.g., 'properties:*')
    const [resource, action] = requiredPermission.split(':');
    if (userPermissions.includes(`${resource}:*`)) {
      return next();
    }

    // Check for :own permissions
    if (action === 'own' && userPermissions.includes(`${resource}:${action}:own`)) {
      // Verify ownership in the route handler
      req.requireOwnership = true;
      return next();
    }

    return res.status(403).json({
      error: 'Forbidden',
      message: 'You do not have permission to perform this action',
    });
  };
}

module.exports = authorize;

// Usage in routes
router.get('/properties', authorize('properties:read'), PropertyController.getAll);
router.post('/properties', authorize('properties:create'), PropertyController.create);
router.put('/properties/:id', authorize('properties:update'), PropertyController.update);
router.delete('/users/:id', authorize('users:delete'), UserController.delete);
```

---

## Data Protection

### Encryption at Rest

```javascript
// utils/encryption.js
const crypto = require('crypto');

class Encryption {
  constructor() {
    this.algorithm = 'aes-256-gcm';
    this.key = Buffer.from(process.env.ENCRYPTION_KEY, 'hex'); // 32 bytes
  }

  encrypt(text) {
    const iv = crypto.randomBytes(16);
    const cipher = crypto.createCipheriv(this.algorithm, this.key, iv);

    let encrypted = cipher.update(text, 'utf8', 'hex');
    encrypted += cipher.final('hex');

    const authTag = cipher.getAuthTag();

    return {
      encrypted,
      iv: iv.toString('hex'),
      authTag: authTag.toString('hex'),
    };
  }

  decrypt(encrypted, iv, authTag) {
    const decipher = crypto.createDecipheriv(
      this.algorithm,
      this.key,
      Buffer.from(iv, 'hex')
    );

    decipher.setAuthTag(Buffer.from(authTag, 'hex'));

    let decrypted = decipher.update(encrypted, 'hex', 'utf8');
    decrypted += decipher.final('utf8');

    return decrypted;
  }

  // For encrypting sensitive database fields
  encryptField(value) {
    if (!value) return null;

    const { encrypted, iv, authTag } = this.encrypt(value);
    return JSON.stringify({ encrypted, iv, authTag });
  }

  decryptField(encryptedJson) {
    if (!encryptedJson) return null;

    const { encrypted, iv, authTag } = JSON.parse(encryptedJson);
    return this.decrypt(encrypted, iv, authTag);
  }
}

module.exports = new Encryption();
```

### Sensitive Data Handling

```javascript
// models/User.js
const { Model, DataTypes } = require('sequelize');
const Encryption = require('../utils/encryption');

class User extends Model {
  static init(sequelize) {
    return super.init(
      {
        email: DataTypes.STRING,
        password: DataTypes.STRING,
        ssn: {
          type: DataTypes.TEXT,
          get() {
            const encrypted = this.getDataValue('ssn');
            return encrypted ? Encryption.decryptField(encrypted) : null;
          },
          set(value) {
            this.setDataValue('ssn', Encryption.encryptField(value));
          },
        },
        phoneNumber: {
          type: DataTypes.TEXT,
          get() {
            const encrypted = this.getDataValue('phoneNumber');
            if (!encrypted) return null;

            const decrypted = Encryption.decryptField(encrypted);
            // Mask for non-admin users
            if (!this.constructor.currentUserIsAdmin) {
              return this.maskPhoneNumber(decrypted);
            }
            return decrypted;
          },
          set(value) {
            this.setDataValue('phoneNumber', Encryption.encryptField(value));
          },
        },
      },
      {
        sequelize,
        tableName: 'users',
      }
    );
  }

  maskPhoneNumber(phone) {
    if (!phone || phone.length < 4) return '****';
    return `******${phone.slice(-4)}`;
  }

  toJSON() {
    const values = Object.assign({}, this.get());

    // Never expose password in JSON
    delete values.password;

    // Never expose SSN in JSON (even if decrypted)
    delete values.ssn;

    return values;
  }
}
```

### Data Retention & Deletion

```javascript
// services/DataRetentionService.js
class DataRetentionService {
  async deleteInactiveAccounts() {
    // Delete accounts inactive for 3 years
    const threeYearsAgo = new Date();
    threeYearsAgo.setFullYear(threeYearsAgo.getFullYear() - 3);

    const inactiveAccounts = await Tenant.findAll({
      where: {
        lastActivityAt: { [Op.lt]: threeYearsAgo },
        status: 'inactive',
      },
    });

    for (const account of inactiveAccounts) {
      await this.permanentlyDeleteAccount(account);
    }
  }

  async permanentlyDeleteAccount(tenant) {
    // Log deletion for compliance
    await AuditLog.create({
      action: 'account_deletion',
      tenantId: tenant.id,
      reason: 'Data retention policy',
      deletedAt: new Date(),
    });

    // Delete all associated data
    await this.deleteAllData(tenant.id);

    // Finally delete tenant
    await tenant.destroy({ force: true });

    console.log(`Account ${tenant.id} permanently deleted`);
  }

  async deleteAllData(tenantId) {
    await sequelize.transaction(async (t) => {
      await Property.destroy({ where: { tenantId }, force: true, transaction: t });
      await Lead.destroy({ where: { tenantId }, force: true, transaction: t });
      await Transaction.destroy({ where: { tenantId }, force: true, transaction: t });
      await Document.destroy({ where: { tenantId }, force: true, transaction: t });
      await User.destroy({ where: { tenantId }, force: true, transaction: t });
      // ... delete all other tenant data
    });
  }

  async anonymizeUserData(userId) {
    // For GDPR compliance - anonymize rather than delete
    await User.update(
      {
        email: `deleted_${userId}@example.com`,
        firstName: 'Deleted',
        lastName: 'User',
        phone: null,
        ssn: null,
        address: null,
      },
      { where: { id: userId } }
    );
  }
}

module.exports = new DataRetentionService();
```

---

## API Security

### Input Validation & Sanitization

```javascript
// middleware/validator.js
const { body, param, query, validationResult } = require('express-validator');
const xss = require('xss');

// Validation rules
exports.createPropertyRules = [
  body('title')
    .trim()
    .isLength({ min: 5, max: 200 })
    .withMessage('Title must be between 5 and 200 characters')
    .customSanitizer(value => xss(value)),

  body('price')
    .isFloat({ min: 0 })
    .withMessage('Price must be a positive number'),

  body('bedrooms')
    .isInt({ min: 0, max: 100 })
    .withMessage('Bedrooms must be between 0 and 100'),

  body('email')
    .optional()
    .isEmail()
    .normalizeEmail()
    .withMessage('Invalid email address'),

  body('description')
    .optional()
    .trim()
    .isLength({ max: 5000 })
    .customSanitizer(value => xss(value)),
];

// Validation middleware
exports.validate = (req, res, next) => {
  const errors = validationResult(req);

  if (!errors.isEmpty()) {
    return res.status(400).json({
      error: 'Validation Error',
      details: errors.array(),
    });
  }

  next();
};

// SQL Injection Prevention (using parameterized queries)
// ❌ NEVER do this:
const query = `SELECT * FROM users WHERE email = '${req.body.email}'`;

// ✅ Always use parameterized queries:
const query = 'SELECT * FROM users WHERE email = $1';
const result = await db.query(query, [req.body.email]);
```

### Rate Limiting

```javascript
// middleware/rateLimiter.js
const rateLimit = require('express-rate-limit');
const RedisStore = require('rate-limit-redis');
const redis = require('../config/redis');

// General API rate limit
exports.apiLimiter = rateLimit({
  store: new RedisStore({
    client: redis,
    prefix: 'rate-limit:api:',
  }),
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 100, // 100 requests per window
  message: 'Too many requests from this IP, please try again later',
  standardHeaders: true,
  legacyHeaders: false,
});

// Strict limit for auth endpoints
exports.authLimiter = rateLimit({
  store: new RedisStore({
    client: redis,
    prefix: 'rate-limit:auth:',
  }),
  windowMs: 15 * 60 * 1000,
  max: 5, // Only 5 login attempts per 15 minutes
  skipSuccessfulRequests: true, // Don't count successful logins
  message: 'Too many login attempts, please try again later',
});

// Per-user rate limiting
exports.userLimiter = async (req, res, next) => {
  if (!req.user) return next();

  const key = `rate-limit:user:${req.user.userId}`;
  const limit = 1000; // Per hour
  const window = 60 * 60; // 1 hour in seconds

  const current = await redis.incr(key);

  if (current === 1) {
    await redis.expire(key, window);
  }

  if (current > limit) {
    return res.status(429).json({
      error: 'Rate limit exceeded',
      message: 'You have exceeded your API rate limit',
      retryAfter: await redis.ttl(key),
    });
  }

  res.setHeader('X-RateLimit-Limit', limit);
  res.setHeader('X-RateLimit-Remaining', Math.max(0, limit - current));

  next();
};
```

### CORS Configuration

```javascript
// config/cors.js
const cors = require('cors');

const corsOptions = {
  origin: function (origin, callback) {
    // Allow requests from your domains
    const allowedOrigins = [
      process.env.FRONTEND_URL,
      'https://yourdomain.com',
      'https://www.yourdomain.com',
      /\.yourdomain\.com$/, // All subdomains
    ];

    // Allow requests with no origin (mobile apps, Postman, etc.)
    if (!origin) return callback(null, true);

    const isAllowed = allowedOrigins.some(allowed => {
      if (allowed instanceof RegExp) {
        return allowed.test(origin);
      }
      return allowed === origin;
    });

    if (isAllowed) {
      callback(null, true);
    } else {
      callback(new Error('Not allowed by CORS'));
    }
  },
  credentials: true,
  optionsSuccessStatus: 200,
  methods: ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
  allowedHeaders: ['Content-Type', 'Authorization', 'X-Tenant-ID'],
  exposedHeaders: ['X-Total-Count', 'X-RateLimit-Remaining'],
};

module.exports = cors(corsOptions);
```

### Security Headers

```javascript
// middleware/securityHeaders.js
const helmet = require('helmet');

module.exports = helmet({
  contentSecurityPolicy: {
    directives: {
      defaultSrc: ["'self'"],
      styleSrc: ["'self'", "'unsafe-inline'", 'https://fonts.googleapis.com'],
      fontSrc: ["'self'", 'https://fonts.gstatic.com'],
      imgSrc: ["'self'", 'data:', 'https:'],
      scriptSrc: ["'self'"],
      connectSrc: ["'self'", 'https://api.yourdomain.com'],
      frameSrc: ["'none'"],
      objectSrc: ["'none'"],
    },
  },
  hsts: {
    maxAge: 31536000, // 1 year
    includeSubDomains: true,
    preload: true,
  },
  frameguard: {
    action: 'deny', // Prevent clickjacking
  },
  noSniff: true, // Prevent MIME sniffing
  xssFilter: true, // Enable XSS filter
  referrerPolicy: { policy: 'strict-origin-when-cross-origin' },
});
```

---

## Infrastructure Security

### Environment Variables

```bash
# .env.example
# NEVER commit the actual .env file to version control

# Application
NODE_ENV=production
APP_URL=https://yourdomain.com
PORT=3000

# Security
JWT_ACCESS_SECRET=generate-strong-random-string-here
JWT_REFRESH_SECRET=generate-different-strong-random-string
ENCRYPTION_KEY=generate-32-byte-hex-string-for-aes-256

# Database
DB_HOST=localhost
DB_PORT=5432
DB_NAME=realestate_db
DB_USER=dbuser
DB_PASSWORD=strong-database-password

# Redis
REDIS_HOST=localhost
REDIS_PORT=6379
REDIS_PASSWORD=redis-password

# Stripe
STRIPE_SECRET_KEY=sk_live_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx

# AWS
AWS_ACCESS_KEY_ID=xxx
AWS_SECRET_ACCESS_KEY=xxx
AWS_S3_BUCKET=your-bucket-name
AWS_REGION=us-east-1

# Email
SENDGRID_API_KEY=SG.xxx

# SMS
TWILIO_ACCOUNT_SID=ACxxx
TWILIO_AUTH_TOKEN=xxx
TWILIO_PHONE_NUMBER=+1xxx
```

### Database Security

```sql
-- Create read-only user for reporting
CREATE USER reporter WITH PASSWORD 'strong_password';
GRANT CONNECT ON DATABASE realestate_db TO reporter;
GRANT SELECT ON ALL TABLES IN SCHEMA public TO reporter;

-- Create application user with limited permissions
CREATE USER app_user WITH PASSWORD 'strong_password';
GRANT CONNECT ON DATABASE realestate_db TO app_user;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO app_user;
GRANT USAGE ON ALL SEQUENCES IN SCHEMA public TO app_user;

-- Enable row-level security for multi-tenancy
ALTER TABLE properties ENABLE ROW LEVEL SECURITY;

CREATE POLICY tenant_isolation ON properties
  USING (tenant_id = current_setting('app.current_tenant')::uuid);

-- Encrypt sensitive columns
CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- Example: Encrypted SSN column
ALTER TABLE users ADD COLUMN ssn_encrypted BYTEA;

UPDATE users SET ssn_encrypted = pgp_sym_encrypt(ssn, 'encryption_key');
```

### File Upload Security

```javascript
// middleware/fileUpload.js
const multer = require('multer');
const path = require('path');
const crypto = require('crypto');

const allowedMimeTypes = [
  'image/jpeg',
  'image/png',
  'image/gif',
  'image/webp',
  'application/pdf',
  'application/msword',
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
];

const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, 'uploads/temp');
  },
  filename: (req, file, cb) => {
    const uniqueName = `${crypto.randomBytes(16).toString('hex')}${path.extname(file.originalname)}`;
    cb(null, uniqueName);
  },
});

const fileFilter = (req, file, cb) => {
  // Check MIME type
  if (!allowedMimeTypes.includes(file.mimetype)) {
    return cb(new Error('File type not allowed'), false);
  }

  // Check file extension
  const ext = path.extname(file.originalname).toLowerCase();
  const allowedExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.pdf', '.doc', '.docx'];

  if (!allowedExtensions.includes(ext)) {
    return cb(new Error('File extension not allowed'), false);
  }

  cb(null, true);
};

const upload = multer({
  storage,
  fileFilter,
  limits: {
    fileSize: 50 * 1024 * 1024, // 50MB max
    files: 10, // Max 10 files per request
  },
});

module.exports = upload;

// Virus scanning (using ClamAV)
const NodeClam = require('clamscan');

async function scanFile(filePath) {
  const clam = await new NodeClam().init({
    clamdscan: {
      host: '127.0.0.1',
      port: 3310,
    },
  });

  const { isInfected, viruses } = await clam.scanFile(filePath);

  if (isInfected) {
    await fs.unlink(filePath); // Delete infected file
    throw new Error(`Virus detected: ${viruses.join(', ')}`);
  }

  return true;
}
```

---

## Compliance

### GDPR Compliance

```javascript
// controllers/GDPRController.js
class GDPRController {
  // Right to access
  async exportUserData(req, res) {
    const { userId } = req.user;

    const userData = await this.gatherAllUserData(userId);

    res.setHeader('Content-Type', 'application/json');
    res.setHeader('Content-Disposition', `attachment; filename="user-data-${userId}.json"`);
    res.send(JSON.stringify(userData, null, 2));
  }

  async gatherAllUserData(userId) {
    const user = await User.findByPk(userId);
    const properties = await Property.findAll({ where: { userId } });
    const leads = await Lead.findAll({ where: { userId } });
    const transactions = await Transaction.findAll({ where: { userId } });

    return {
      personal_information: {
        name: `${user.firstName} ${user.lastName}`,
        email: user.email,
        phone: user.phone,
        created_at: user.createdAt,
      },
      properties: properties.map(p => p.toJSON()),
      leads: leads.map(l => l.toJSON()),
      transactions: transactions.map(t => t.toJSON()),
      consent_history: await this.getConsentHistory(userId),
    };
  }

  // Right to be forgotten
  async deleteUserData(req, res) {
    const { userId } = req.user;

    // Log the deletion request
    await AuditLog.create({
      userId,
      action: 'gdpr_deletion_request',
      timestamp: new Date(),
    });

    // Anonymize user data
    await DataRetentionService.anonymizeUserData(userId);

    // Delete associated data
    await this.deleteAssociatedData(userId);

    res.json({
      message: 'Your data has been deleted as per GDPR regulations',
    });
  }

  // Consent management
  async updateConsent(req, res) {
    const { userId } = req.user;
    const { marketing, analytics, thirdParty } = req.body;

    await UserConsent.upsert({
      userId,
      marketing,
      analytics,
      thirdParty,
      updatedAt: new Date(),
    });

    res.json({ message: 'Consent preferences updated' });
  }
}
```

### PCI DSS Compliance

**Credit Card Data Handling:**
- ✅ Never store CVV/CVV2
- ✅ Never store full card numbers (use Stripe/PayPal tokenization)
- ✅ Store only last 4 digits for display
- ✅ All payment processing via PCI-compliant third parties

```javascript
// NEVER store credit card data directly
// ❌ BAD:
await PaymentMethod.create({
  cardNumber: '4111111111111111',
  cvv: '123',
  exp: '12/25',
});

// ✅ GOOD: Use Stripe tokens
const paymentMethod = await stripe.paymentMethods.create({
  type: 'card',
  card: { token: 'tok_xxx' },
});

await PaymentMethod.create({
  stripePaymentMethodId: paymentMethod.id,
  last4: paymentMethod.card.last4,
  brand: paymentMethod.card.brand,
  expMonth: paymentMethod.card.exp_month,
  expYear: paymentMethod.card.exp_year,
});
```

### SOC 2 Compliance

**Key Controls:**
1. Access controls and authentication
2. Encryption at rest and in transit
3. Security monitoring and logging
4. Incident response procedures
5. Vendor management
6. Business continuity planning
7. Change management

### CCPA Compliance

```javascript
// California Consumer Privacy Act
class CCPAController {
  async requestDataDeletion(req, res) {
    // Similar to GDPR but with California-specific requirements
    // Must respond within 45 days
    await DeletionRequest.create({
      userId: req.user.userId,
      requestedAt: new Date(),
      dueDate: new Date(Date.now() + 45 * 24 * 60 * 60 * 1000),
      status: 'pending',
    });

    res.json({
      message: 'Your data deletion request has been received and will be processed within 45 days',
    });
  }

  async optOutOfDataSale(req, res) {
    await User.update(
      { doNotSell: true },
      { where: { id: req.user.userId } }
    );

    res.json({ message: 'You have opted out of data sale' });
  }
}
```

---

## Security Best Practices

### Code Review Checklist

- [ ] No hardcoded credentials or API keys
- [ ] All user input validated and sanitized
- [ ] SQL injection prevention (parameterized queries)
- [ ] XSS prevention (output encoding)
- [ ] CSRF protection implemented
- [ ] Authentication required for sensitive endpoints
- [ ] Authorization checks in place
- [ ] Rate limiting configured
- [ ] Error messages don't leak sensitive info
- [ ] Logging doesn't contain sensitive data
- [ ] Dependencies up to date
- [ ] No console.log in production code
- [ ] Environment variables used for config
- [ ] HTTPS enforced
- [ ] Secure headers configured

### Secure Development Lifecycle

```
1. Requirements
   - Define security requirements
   - Identify sensitive data
   - Compliance requirements

2. Design
   - Threat modeling
   - Security architecture review
   - Data flow diagrams

3. Development
   - Secure coding practices
   - Code reviews
   - Static analysis (SAST)

4. Testing
   - Security testing
   - Penetration testing
   - Dynamic analysis (DAST)

5. Deployment
   - Security configuration
   - Secrets management
   - Infrastructure security

6. Maintenance
   - Vulnerability scanning
   - Dependency updates
   - Security monitoring
```

### Dependency Management

```javascript
// package.json scripts
{
  "scripts": {
    "audit": "npm audit",
    "audit:fix": "npm audit fix",
    "check-updates": "npx npm-check-updates",
    "update-deps": "npx npm-check-updates -u && npm install"
  }
}

// Automated dependency scanning (GitHub Dependabot, Snyk, etc.)
```

---

## Vulnerability Management

### Regular Security Scans

```bash
# Run npm audit
npm audit

# Fix automatically fixable vulnerabilities
npm audit fix

# For force updates (test thoroughly after)
npm audit fix --force

# OWASP Dependency Check
dependency-check --project "Real Estate SaaS" --scan ./

# Container scanning
docker scan your-image:tag

# SAST (Static Application Security Testing)
# Using SonarQube, Checkmarx, or similar
```

### Penetration Testing Schedule

- **Annual**: Full penetration test by third-party security firm
- **Quarterly**: Internal vulnerability assessment
- **Continuous**: Automated security scanning
- **Ad-hoc**: Before major releases

---

## Incident Response

### Incident Response Plan

```
1. Detection & Analysis
   - Monitor security alerts
   - Identify incident type
   - Assess severity

2. Containment
   - Isolate affected systems
   - Prevent further damage
   - Preserve evidence

3. Eradication
   - Remove threat
   - Patch vulnerabilities
   - Verify clean system

4. Recovery
   - Restore systems
   - Monitor for re-infection
   - Gradual return to normal

5. Post-Incident
   - Document incident
   - Lessons learned
   - Update procedures
```

### Security Incident Contacts

```
Security Team Lead: security@yourdomain.com
On-call Engineer: +1-555-SECURITY
Legal Team: legal@yourdomain.com
PR/Communications: pr@yourdomain.com
```

---

## Security Audit Checklist

### Application Security
- [ ] Authentication implemented securely
- [ ] Authorization enforced on all endpoints
- [ ] Input validation on all user inputs
- [ ] Output encoding to prevent XSS
- [ ] SQL injection protection (parameterized queries)
- [ ] CSRF protection enabled
- [ ] Rate limiting configured
- [ ] Session management secure
- [ ] Password policies enforced
- [ ] 2FA/MFA available

### Infrastructure Security
- [ ] Firewall configured
- [ ] DDoS protection in place
- [ ] SSL/TLS certificates valid
- [ ] Secure headers configured
- [ ] Database access restricted
- [ ] Principle of least privilege
- [ ] Backups encrypted
- [ ] Monitoring and alerting active

### Data Security
- [ ] Encryption at rest
- [ ] Encryption in transit
- [ ] Sensitive data identified
- [ ] PII/PHI properly handled
- [ ] Data retention policy
- [ ] Secure data disposal
- [ ] Access logging enabled

### Compliance
- [ ] GDPR compliance (if applicable)
- [ ] CCPA compliance (if applicable)
- [ ] PCI DSS compliance (if handling cards)
- [ ] Privacy policy published
- [ ] Terms of service published
- [ ] Cookie consent implemented
- [ ] Data processing agreements

### Operational Security
- [ ] Security training for team
- [ ] Incident response plan
- [ ] Disaster recovery plan
- [ ] Access controls documented
- [ ] Vendor security assessed
- [ ] Security documentation current
- [ ] Penetration testing scheduled

---

**Document Version**: 1.0
**Last Updated**: 2025-11-15
**Next Review**: 2026-02-15
