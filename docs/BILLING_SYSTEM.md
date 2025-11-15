# Payment & Subscription Billing System

## Table of Contents
1. [System Overview](#system-overview)
2. [Subscription Plans](#subscription-plans)
3. [Payment Gateway Integration](#payment-gateway-integration)
4. [Billing Cycle Management](#billing-cycle-management)
5. [Usage-Based Billing](#usage-based-billing)
6. [Invoice Generation](#invoice-generation)
7. [Payment Methods](#payment-methods)
8. [Dunning Management](#dunning-management)
9. [Proration & Upgrades](#proration--upgrades)
10. [Tax Calculation](#tax-calculation)
11. [Refunds & Credits](#refunds--credits)
12. [Reporting & Analytics](#reporting--analytics)
13. [Database Schema](#database-schema)
14. [API Endpoints](#api-endpoints)

---

## System Overview

### Architecture

```
┌─────────────────────────────────────────────────────────┐
│                   Frontend (React)                      │
│  ┌───────────┐  ┌───────────┐  ┌────────────────────┐  │
│  │  Pricing  │  │  Checkout │  │  Billing Dashboard │  │
│  │   Page    │  │   Flow    │  │                    │  │
│  └───────────┘  └───────────┘  └────────────────────┘  │
└────────────────────────┬────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────┐
│               Backend API (Node.js/Express)             │
│  ┌────────────────┐  ┌─────────────┐  ┌──────────────┐ │
│  │ Subscription   │  │  Billing    │  │   Invoice    │ │
│  │  Controller    │  │ Controller  │  │  Generator   │ │
│  └────────────────┘  └─────────────┘  └──────────────┘ │
│  ┌────────────────┐  ┌─────────────┐  ┌──────────────┐ │
│  │   Payment      │  │   Webhook   │  │    Dunning   │ │
│  │   Processor    │  │   Handler   │  │    Manager   │ │
│  └────────────────┘  └─────────────┘  └──────────────┘ │
└────────────────────────┬───────────────────────┬────────┘
                         │                       │
                         ▼                       ▼
           ┌──────────────────────┐   ┌──────────────────┐
           │  Stripe API          │   │   PayPal API     │
           │  - Subscriptions     │   │   - Billing      │
           │  - Payments          │   │   - Payments     │
           │  - Webhooks          │   │                  │
           └──────────────────────┘   └──────────────────┘
                         │
                         ▼
           ┌──────────────────────────┐
           │   PostgreSQL Database    │
           │  - Subscriptions         │
           │  - Invoices              │
           │  - Payments              │
           │  - Payment Methods       │
           └──────────────────────────┘
```

### Key Components

1. **Subscription Management**
   - Plan selection and signup
   - Upgrades and downgrades
   - Cancellations and reactivations
   - Trial management

2. **Payment Processing**
   - Credit/debit card payments
   - ACH/bank transfers
   - Alternative payment methods
   - Payment method storage

3. **Billing Engine**
   - Recurring billing automation
   - Usage tracking and metering
   - Invoice generation
   - Payment collection

4. **Webhook Handlers**
   - Payment success/failure
   - Subscription updates
   - Dispute notifications
   - Refund processing

5. **Dunning Management**
   - Failed payment retries
   - Customer notifications
   - Account suspension
   - Collection workflows

---

## Subscription Plans

### Plan Structure

#### Starter Plan
**Price**: $49/month or $470/year (20% discount)

**Features**:
- Up to 3 users
- 25 active property listings
- 100 leads/month
- 500 MB file storage
- Basic CRM features
- Email support
- Mobile app access
- Property search & filters
- Basic reporting

**Limits**:
```javascript
{
  planId: 'starter',
  price: {
    monthly: 49,
    annual: 470
  },
  limits: {
    users: 3,
    activeListings: 25,
    leadsPerMonth: 100,
    storage: 524288000, // 500 MB in bytes
    emailsPerMonth: 1000,
    smsPerMonth: 100,
    apiCallsPerDay: 1000
  },
  features: {
    crm: 'basic',
    marketing: false,
    advancedReporting: false,
    whiteLabel: false,
    apiAccess: 'limited',
    support: 'email',
    mobileApp: true
  }
}
```

---

#### Professional Plan (Most Popular)
**Price**: $99/month or $950/year (20% discount)

**Features**:
- Up to 10 users
- Unlimited property listings
- Unlimited leads
- 5 GB file storage
- Advanced CRM features
- Marketing automation
- Email & SMS campaigns
- Priority support
- Advanced reporting
- Custom branding
- API access

**Limits**:
```javascript
{
  planId: 'professional',
  price: {
    monthly: 99,
    annual: 950
  },
  limits: {
    users: 10,
    activeListings: -1, // unlimited
    leadsPerMonth: -1, // unlimited
    storage: 5368709120, // 5 GB
    emailsPerMonth: 5000,
    smsPerMonth: 500,
    apiCallsPerDay: 10000
  },
  features: {
    crm: 'advanced',
    marketing: true,
    advancedReporting: true,
    whiteLabel: 'partial',
    apiAccess: 'full',
    support: 'priority',
    mobileApp: true,
    transactions: true,
    documentSigning: true
  }
}
```

---

#### Enterprise Plan
**Price**: $249/month or $2,390/year (20% discount)

**Features**:
- Unlimited users
- Unlimited listings
- Unlimited leads
- 50 GB file storage
- All Professional features
- Full white-label
- Custom integrations
- Dedicated account manager
- Phone support
- SLA guarantee (99.9% uptime)
- Custom onboarding
- Advanced security features

**Limits**:
```javascript
{
  planId: 'enterprise',
  price: {
    monthly: 249,
    annual: 2390
  },
  limits: {
    users: -1, // unlimited
    activeListings: -1,
    leadsPerMonth: -1,
    storage: 53687091200, // 50 GB
    emailsPerMonth: 20000,
    smsPerMonth: 2000,
    apiCallsPerDay: 100000
  },
  features: {
    crm: 'advanced',
    marketing: true,
    advancedReporting: true,
    whiteLabel: 'full',
    apiAccess: 'unlimited',
    support: 'dedicated',
    mobileApp: true,
    transactions: true,
    documentSigning: true,
    customIntegrations: true,
    sso: true,
    auditLogs: true
  }
}
```

---

#### Custom Plan
**Price**: Contact Sales

**Features**:
- Custom pricing
- Tailored feature set
- Volume discounts
- Multi-location support
- Dedicated infrastructure
- Custom SLA
- White-glove onboarding
- Training sessions

---

### Add-ons & Usage-Based Charges

#### Per-User Pricing (over plan limit)
- $10/user/month for additional users

#### Extra Storage
- $5/GB/month for storage over limit

#### SMS Credits
- $0.05 per SMS (over plan limit)
- Bulk packages: 1,000 SMS for $40 (20% discount)

#### Premium Features
- Featured property placement: $10/property/month
- Virtual tour hosting: $20/month
- Advanced analytics module: $30/month
- Zapier integration: $15/month

#### Professional Services
- Custom integration: Starting at $500
- Data migration: Starting at $300
- Training session (1 hour): $150
- Custom report development: $200/report

---

## Payment Gateway Integration

### Stripe Integration (Primary)

#### Setup

```javascript
// config/stripe.js
const stripe = require('stripe')(process.env.STRIPE_SECRET_KEY);

module.exports = stripe;
```

#### Create Customer

```javascript
// services/StripeService.js
class StripeService {
  async createCustomer(tenant, user) {
    const customer = await stripe.customers.create({
      email: user.email,
      name: `${user.firstName} ${user.lastName}`,
      metadata: {
        tenantId: tenant.id,
        userId: user.id,
      },
      address: {
        line1: tenant.billingAddress,
        city: tenant.billingCity,
        state: tenant.billingState,
        postal_code: tenant.billingZip,
        country: tenant.billingCountry,
      },
    });

    // Save Stripe customer ID
    await tenant.update({ stripeCustomerId: customer.id });

    return customer;
  }

  async attachPaymentMethod(customerId, paymentMethodId) {
    const paymentMethod = await stripe.paymentMethods.attach(
      paymentMethodId,
      { customer: customerId }
    );

    // Set as default payment method
    await stripe.customers.update(customerId, {
      invoice_settings: {
        default_payment_method: paymentMethodId,
      },
    });

    return paymentMethod;
  }

  async createSubscription(customerId, priceId, trialDays = 14) {
    const subscription = await stripe.subscriptions.create({
      customer: customerId,
      items: [{ price: priceId }],
      trial_period_days: trialDays,
      payment_behavior: 'default_incomplete',
      payment_settings: { save_default_payment_method: 'on_subscription' },
      expand: ['latest_invoice.payment_intent'],
      metadata: {
        source: 'real_estate_saas',
      },
    });

    return subscription;
  }

  async upgradeSubscription(subscriptionId, newPriceId) {
    const subscription = await stripe.subscriptions.retrieve(subscriptionId);

    const updatedSubscription = await stripe.subscriptions.update(
      subscriptionId,
      {
        items: [{
          id: subscription.items.data[0].id,
          price: newPriceId,
        }],
        proration_behavior: 'create_prorations',
      }
    );

    return updatedSubscription;
  }

  async cancelSubscription(subscriptionId, immediately = false) {
    if (immediately) {
      return await stripe.subscriptions.cancel(subscriptionId);
    } else {
      // Cancel at period end
      return await stripe.subscriptions.update(subscriptionId, {
        cancel_at_period_end: true,
      });
    }
  }

  async createPaymentIntent(amount, currency, customerId) {
    return await stripe.paymentIntents.create({
      amount: amount * 100, // Convert to cents
      currency: currency,
      customer: customerId,
      automatic_payment_methods: { enabled: true },
    });
  }
}

module.exports = new StripeService();
```

#### Webhook Handler

```javascript
// routes/webhooks.js
const express = require('express');
const router = express.Router();
const stripe = require('../config/stripe');
const { handleStripeWebhook } = require('../controllers/WebhookController');

router.post(
  '/stripe',
  express.raw({ type: 'application/json' }),
  async (req, res) => {
    const sig = req.headers['stripe-signature'];
    let event;

    try {
      event = stripe.webhooks.constructEvent(
        req.body,
        sig,
        process.env.STRIPE_WEBHOOK_SECRET
      );
    } catch (err) {
      console.error('Webhook signature verification failed:', err.message);
      return res.status(400).send(`Webhook Error: ${err.message}`);
    }

    // Handle the event
    await handleStripeWebhook(event);

    res.json({ received: true });
  }
);

module.exports = router;
```

```javascript
// controllers/WebhookController.js
exports.handleStripeWebhook = async (event) => {
  switch (event.type) {
    case 'customer.subscription.created':
      await handleSubscriptionCreated(event.data.object);
      break;

    case 'customer.subscription.updated':
      await handleSubscriptionUpdated(event.data.object);
      break;

    case 'customer.subscription.deleted':
      await handleSubscriptionDeleted(event.data.object);
      break;

    case 'invoice.payment_succeeded':
      await handlePaymentSucceeded(event.data.object);
      break;

    case 'invoice.payment_failed':
      await handlePaymentFailed(event.data.object);
      break;

    case 'customer.subscription.trial_will_end':
      await handleTrialWillEnd(event.data.object);
      break;

    case 'charge.refunded':
      await handleChargeRefunded(event.data.object);
      break;

    default:
      console.log(`Unhandled event type: ${event.type}`);
  }
};

async function handlePaymentSucceeded(invoice) {
  const subscription = await Subscription.findOne({
    where: { stripeSubscriptionId: invoice.subscription }
  });

  if (!subscription) return;

  // Create invoice record
  await Invoice.create({
    tenantId: subscription.tenantId,
    subscriptionId: subscription.id,
    stripeInvoiceId: invoice.id,
    amount: invoice.amount_paid / 100,
    currency: invoice.currency,
    status: 'paid',
    paidAt: new Date(invoice.status_transitions.paid_at * 1000),
    invoicePdf: invoice.invoice_pdf,
  });

  // Update subscription status
  await subscription.update({
    status: 'active',
    currentPeriodStart: new Date(invoice.period_start * 1000),
    currentPeriodEnd: new Date(invoice.period_end * 1000),
  });

  // Send payment confirmation email
  await EmailService.sendPaymentConfirmation(subscription.tenantId, invoice);
}

async function handlePaymentFailed(invoice) {
  const subscription = await Subscription.findOne({
    where: { stripeSubscriptionId: invoice.subscription }
  });

  if (!subscription) return;

  // Update subscription status
  await subscription.update({ status: 'past_due' });

  // Create failed payment record
  await FailedPayment.create({
    tenantId: subscription.tenantId,
    subscriptionId: subscription.id,
    invoiceId: invoice.id,
    amount: invoice.amount_due / 100,
    attemptCount: invoice.attempt_count,
    nextRetryAt: invoice.next_payment_attempt
      ? new Date(invoice.next_payment_attempt * 1000)
      : null,
  });

  // Trigger dunning process
  await DunningService.handleFailedPayment(subscription);
}
```

---

### PayPal Integration (Alternative)

```javascript
// services/PayPalService.js
const paypal = require('@paypal/checkout-server-sdk');

class PayPalService {
  constructor() {
    const environment = process.env.NODE_ENV === 'production'
      ? new paypal.core.LiveEnvironment(
          process.env.PAYPAL_CLIENT_ID,
          process.env.PAYPAL_CLIENT_SECRET
        )
      : new paypal.core.SandboxEnvironment(
          process.env.PAYPAL_CLIENT_ID,
          process.env.PAYPAL_CLIENT_SECRET
        );

    this.client = new paypal.core.PayPalHttpClient(environment);
  }

  async createSubscription(planId, customerId) {
    const request = new paypal.billing.SubscriptionsCreateRequest();
    request.requestBody({
      plan_id: planId,
      subscriber: {
        email_address: customerId.email,
      },
      application_context: {
        brand_name: 'Real Estate SaaS',
        return_url: `${process.env.APP_URL}/billing/success`,
        cancel_url: `${process.env.APP_URL}/billing/cancel`,
      },
    });

    const response = await this.client.execute(request);
    return response.result;
  }

  async cancelSubscription(subscriptionId) {
    const request = new paypal.billing.SubscriptionsCancelRequest(subscriptionId);
    request.requestBody({
      reason: 'Customer request',
    });

    const response = await this.client.execute(request);
    return response.result;
  }
}

module.exports = new PayPalService();
```

---

## Billing Cycle Management

### Subscription Lifecycle

```javascript
// models/Subscription.js
const { Model, DataTypes } = require('sequelize');

class Subscription extends Model {
  static init(sequelize) {
    return super.init(
      {
        id: {
          type: DataTypes.UUID,
          defaultValue: DataTypes.UUIDV4,
          primaryKey: true,
        },
        tenantId: {
          type: DataTypes.UUID,
          allowNull: false,
        },
        planId: {
          type: DataTypes.STRING,
          allowNull: false,
        },
        status: {
          type: DataTypes.ENUM(
            'trialing',
            'active',
            'past_due',
            'canceled',
            'unpaid',
            'paused'
          ),
          defaultValue: 'trialing',
        },
        billingCycle: {
          type: DataTypes.ENUM('monthly', 'annual'),
          defaultValue: 'monthly',
        },
        amount: {
          type: DataTypes.DECIMAL(10, 2),
          allowNull: false,
        },
        currency: {
          type: DataTypes.STRING(3),
          defaultValue: 'USD',
        },
        trialEndsAt: {
          type: DataTypes.DATE,
        },
        currentPeriodStart: {
          type: DataTypes.DATE,
        },
        currentPeriodEnd: {
          type: DataTypes.DATE,
        },
        cancelAtPeriodEnd: {
          type: DataTypes.BOOLEAN,
          defaultValue: false,
        },
        canceledAt: {
          type: DataTypes.DATE,
        },
        stripeSubscriptionId: {
          type: DataTypes.STRING,
        },
        stripeCustomerId: {
          type: DataTypes.STRING,
        },
      },
      {
        sequelize,
        tableName: 'subscriptions',
        timestamps: true,
      }
    );
  }

  async isActive() {
    return this.status === 'active' || this.status === 'trialing';
  }

  async hasFeature(feature) {
    const plan = await Plan.findByPk(this.planId);
    return plan.features[feature] === true;
  }

  async isWithinLimit(limitType, currentUsage) {
    const plan = await Plan.findByPk(this.planId);
    const limit = plan.limits[limitType];

    if (limit === -1) return true; // unlimited
    return currentUsage < limit;
  }
}

module.exports = Subscription;
```

### Automated Billing Task

```javascript
// jobs/billingJob.js
const cron = require('node-cron');
const { Subscription, Invoice } = require('../models');
const { Op } = require('sequelize');

// Run daily at 2 AM
cron.schedule('0 2 * * *', async () => {
  console.log('Running billing job...');

  // Check for ending trials
  const endingTrials = await Subscription.findAll({
    where: {
      status: 'trialing',
      trialEndsAt: {
        [Op.lte]: new Date(Date.now() + 3 * 24 * 60 * 60 * 1000), // 3 days
      },
    },
  });

  for (const subscription of endingTrials) {
    await EmailService.sendTrialEndingReminder(subscription);
  }

  // Check for upcoming renewals (7 days notice)
  const upcomingRenewals = await Subscription.findAll({
    where: {
      status: 'active',
      currentPeriodEnd: {
        [Op.between]: [
          new Date(),
          new Date(Date.now() + 7 * 24 * 60 * 60 * 1000),
        ],
      },
    },
  });

  for (const subscription of upcomingRenewals) {
    await EmailService.sendRenewalReminder(subscription);
  }

  // Process usage-based charges
  await processUsageCharges();
});

async function processUsageCharges() {
  const subscriptions = await Subscription.findAll({
    where: { status: 'active' },
  });

  for (const subscription of subscriptions) {
    const usage = await calculateMonthlyUsage(subscription.tenantId);
    const overageCharges = await calculateOverageCharges(subscription, usage);

    if (overageCharges > 0) {
      await createUsageInvoice(subscription, overageCharges, usage);
    }
  }
}

async function calculateOverageCharges(subscription, usage) {
  const plan = await Plan.findByPk(subscription.planId);
  let charges = 0;

  // Extra users
  if (usage.users > plan.limits.users && plan.limits.users !== -1) {
    const extraUsers = usage.users - plan.limits.users;
    charges += extraUsers * 10; // $10 per extra user
  }

  // Extra storage
  const storageGB = usage.storage / (1024 * 1024 * 1024);
  const planStorageGB = plan.limits.storage / (1024 * 1024 * 1024);
  if (storageGB > planStorageGB) {
    const extraGB = Math.ceil(storageGB - planStorageGB);
    charges += extraGB * 5; // $5 per GB
  }

  // Extra SMS
  if (usage.sms > plan.limits.smsPerMonth) {
    const extraSMS = usage.sms - plan.limits.smsPerMonth;
    charges += extraSMS * 0.05; // $0.05 per SMS
  }

  return charges;
}
```

---

## Usage-Based Billing

### Usage Tracking

```javascript
// services/UsageTracker.js
class UsageTracker {
  async trackEvent(tenantId, eventType, metadata = {}) {
    await UsageEvent.create({
      tenantId,
      eventType,
      metadata,
      timestamp: new Date(),
    });

    // Update usage cache in Redis
    await this.updateUsageCache(tenantId, eventType);
  }

  async updateUsageCache(tenantId, eventType) {
    const cacheKey = `usage:${tenantId}:${eventType}:${this.getCurrentMonth()}`;
    await redis.incr(cacheKey);
    await redis.expire(cacheKey, 60 * 60 * 24 * 31); // 31 days
  }

  async getCurrentUsage(tenantId) {
    const month = this.getCurrentMonth();

    const [users, storage, sms, emails, apiCalls] = await Promise.all([
      this.getUserCount(tenantId),
      this.getStorageUsage(tenantId),
      this.getSMSCount(tenantId, month),
      this.getEmailCount(tenantId, month),
      this.getAPICallCount(tenantId, month),
    ]);

    return { users, storage, sms, emails, apiCalls };
  }

  async getUserCount(tenantId) {
    return await User.count({ where: { tenantId, status: 'active' } });
  }

  async getStorageUsage(tenantId) {
    const result = await Document.sum('fileSize', { where: { tenantId } });
    return result || 0;
  }

  async getSMSCount(tenantId, month) {
    const cacheKey = `usage:${tenantId}:sms:${month}`;
    const cached = await redis.get(cacheKey);
    if (cached) return parseInt(cached);

    const count = await SMSMessage.count({
      where: {
        tenantId,
        createdAt: {
          [Op.gte]: this.getMonthStart(month),
          [Op.lt]: this.getMonthEnd(month),
        },
      },
    });

    await redis.set(cacheKey, count, 'EX', 60 * 60); // Cache for 1 hour
    return count;
  }

  getCurrentMonth() {
    const now = new Date();
    return `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`;
  }

  getMonthStart(month) {
    const [year, mon] = month.split('-');
    return new Date(year, mon - 1, 1);
  }

  getMonthEnd(month) {
    const [year, mon] = month.split('-');
    return new Date(year, mon, 1);
  }
}

module.exports = new UsageTracker();
```

### Usage Enforcement Middleware

```javascript
// middleware/usageLimit.js
const UsageTracker = require('../services/UsageTracker');

exports.checkUsageLimit = (limitType) => {
  return async (req, res, next) => {
    const { tenantId } = req.user;
    const subscription = await Subscription.findOne({
      where: { tenantId, status: ['active', 'trialing'] },
    });

    if (!subscription) {
      return res.status(403).json({
        error: 'No active subscription found',
      });
    }

    const usage = await UsageTracker.getCurrentUsage(tenantId);
    const withinLimit = await subscription.isWithinLimit(
      limitType,
      usage[limitType]
    );

    if (!withinLimit) {
      return res.status(429).json({
        error: `${limitType} limit exceeded`,
        message: 'Please upgrade your plan to continue',
        currentUsage: usage[limitType],
        upgrade Url: '/billing/upgrade',
      });
    }

    next();
  };
};

// Usage in routes
router.post('/users', checkUsageLimit('users'), UserController.create);
router.post('/properties', checkUsageLimit('activeListings'), PropertyController.create);
router.post('/sms/send', checkUsageLimit('smsPerMonth'), SMSController.send);
```

---

## Invoice Generation

### Invoice Model

```javascript
// models/Invoice.js
class Invoice extends Model {
  static init(sequelize) {
    return super.init(
      {
        id: {
          type: DataTypes.UUID,
          defaultValue: DataTypes.UUIDV4,
          primaryKey: true,
        },
        tenantId: {
          type: DataTypes.UUID,
          allowNull: false,
        },
        subscriptionId: {
          type: DataTypes.UUID,
        },
        invoiceNumber: {
          type: DataTypes.STRING,
          unique: true,
        },
        status: {
          type: DataTypes.ENUM('draft', 'open', 'paid', 'void', 'uncollectible'),
          defaultValue: 'open',
        },
        amount: {
          type: DataTypes.DECIMAL(10, 2),
          allowNull: false,
        },
        tax: {
          type: DataTypes.DECIMAL(10, 2),
          defaultValue: 0,
        },
        total: {
          type: DataTypes.DECIMAL(10, 2),
          allowNull: false,
        },
        currency: {
          type: DataTypes.STRING(3),
          defaultValue: 'USD',
        },
        dueDate: {
          type: DataTypes.DATE,
        },
        paidAt: {
          type: DataTypes.DATE,
        },
        stripeInvoiceId: {
          type: DataTypes.STRING,
        },
        invoicePdf: {
          type: DataTypes.STRING,
        },
        lineItems: {
          type: DataTypes.JSONB,
          defaultValue: [],
        },
      },
      {
        sequelize,
        tableName: 'invoices',
        timestamps: true,
      }
    );
  }

  static async generateInvoiceNumber() {
    const year = new Date().getFullYear();
    const month = String(new Date().getMonth() + 1).padStart(2, '0');

    const lastInvoice = await this.findOne({
      where: {
        invoiceNumber: {
          [Op.like]: `INV-${year}${month}%`,
        },
      },
      order: [['createdAt', 'DESC']],
    });

    let sequence = 1;
    if (lastInvoice) {
      const lastSequence = parseInt(lastInvoice.invoiceNumber.slice(-4));
      sequence = lastSequence + 1;
    }

    return `INV-${year}${month}${String(sequence).padStart(4, '0')}`;
  }
}
```

### PDF Generation

```javascript
// services/InvoiceGenerator.js
const PDFDocument = require('pdfkit');
const fs = require('fs');
const path = require('path');

class InvoiceGenerator {
  async generatePDF(invoice) {
    const tenant = await Tenant.findByPk(invoice.tenantId);
    const doc = new PDFDocument({ margin: 50 });

    const fileName = `invoice-${invoice.invoiceNumber}.pdf`;
    const filePath = path.join(__dirname, '../storage/invoices', fileName);

    doc.pipe(fs.createWriteStream(filePath));

    // Header
    this.addHeader(doc, tenant);

    // Invoice details
    this.addInvoiceDetails(doc, invoice);

    // Line items
    this.addLineItems(doc, invoice);

    // Totals
    this.addTotals(doc, invoice);

    // Footer
    this.addFooter(doc);

    doc.end();

    return filePath;
  }

  addHeader(doc, tenant) {
    doc
      .fontSize(20)
      .text('INVOICE', 50, 50);

    doc
      .fontSize(10)
      .text('From:', 50, 100)
      .text('Real Estate SaaS Platform', 50, 115)
      .text('123 Business St', 50, 130)
      .text('San Francisco, CA 94102', 50, 145)
      .text('support@realestate-saas.com', 50, 160);

    doc
      .text('Bill To:', 300, 100)
      .text(tenant.companyName, 300, 115)
      .text(tenant.billingAddress, 300, 130)
      .text(`${tenant.billingCity}, ${tenant.billingState} ${tenant.billingZip}`, 300, 145)
      .text(tenant.billingEmail, 300, 160);
  }

  addInvoiceDetails(doc, invoice) {
    doc
      .fontSize(10)
      .text(`Invoice Number: ${invoice.invoiceNumber}`, 50, 200)
      .text(`Invoice Date: ${invoice.createdAt.toLocaleDateString()}`, 50, 215)
      .text(`Due Date: ${invoice.dueDate.toLocaleDateString()}`, 50, 230)
      .text(`Status: ${invoice.status.toUpperCase()}`, 50, 245);
  }

  addLineItems(doc, invoice) {
    const tableTop = 280;

    doc
      .fontSize(10)
      .text('Description', 50, tableTop)
      .text('Quantity', 250, tableTop)
      .text('Unit Price', 350, tableTop)
      .text('Amount', 450, tableTop);

    doc
      .moveTo(50, tableTop + 15)
      .lineTo(550, tableTop + 15)
      .stroke();

    let y = tableTop + 25;

    invoice.lineItems.forEach((item) => {
      doc
        .fontSize(9)
        .text(item.description, 50, y)
        .text(item.quantity, 250, y)
        .text(`$${item.unitPrice}`, 350, y)
        .text(`$${item.amount}`, 450, y);

      y += 20;
    });
  }

  addTotals(doc, invoice) {
    const y = 450;

    doc
      .fontSize(10)
      .text('Subtotal:', 350, y)
      .text(`$${invoice.amount}`, 450, y)
      .text('Tax:', 350, y + 20)
      .text(`$${invoice.tax}`, 450, y + 20)
      .text('Total:', 350, y + 40)
      .fontSize(12)
      .text(`$${invoice.total}`, 450, y + 40);
  }

  addFooter(doc) {
    doc
      .fontSize(8)
      .text('Thank you for your business!', 50, 700, { align: 'center' })
      .text('For questions about this invoice, contact support@realestate-saas.com', 50, 715, { align: 'center' });
  }
}

module.exports = new InvoiceGenerator();
```

---

## Dunning Management

### Failed Payment Retry Strategy

```javascript
// services/DunningService.js
class DunningService {
  async handleFailedPayment(subscription) {
    const failedPayment = await FailedPayment.findOne({
      where: { subscriptionId: subscription.id },
      order: [['createdAt', 'DESC']],
    });

    const attemptCount = failedPayment.attemptCount;

    // Retry schedule: Day 1, 3, 5, 7
    const retrySchedule = [1, 3, 5, 7];

    if (attemptCount <= retrySchedule.length) {
      const nextRetry = retrySchedule[attemptCount - 1];
      await this.scheduleRetry(subscription, nextRetry);
      await this.sendPaymentFailedEmail(subscription, attemptCount);
    } else {
      // Max retries reached
      await this.suspendAccount(subscription);
    }
  }

  async scheduleRetry(subscription, daysFromNow) {
    const retryDate = new Date();
    retryDate.setDate(retryDate.getDate() + daysFromNow);

    await FailedPayment.update(
      { nextRetryAt: retryDate },
      { where: { subscriptionId: subscription.id } }
    );

    // Schedule job to retry payment
    await BullQueue.add(
      'retry-payment',
      { subscriptionId: subscription.id },
      { delay: daysFromNow * 24 * 60 * 60 * 1000 }
    );
  }

  async sendPaymentFailedEmail(subscription, attemptCount) {
    const tenant = await subscription.getTenant();
    const daysUntilSuspension = 7 - attemptCount;

    await EmailService.send({
      to: tenant.billingEmail,
      template: 'payment-failed',
      data: {
        companyName: tenant.companyName,
        attemptCount,
        daysUntilSuspension,
        updatePaymentUrl: `${process.env.APP_URL}/billing/payment-methods`,
      },
    });
  }

  async suspendAccount(subscription) {
    await subscription.update({ status: 'unpaid' });
    await Tenant.update(
      { status: 'suspended' },
      { where: { id: subscription.tenantId } }
    );

    await EmailService.send({
      to: subscription.tenant.billingEmail,
      template: 'account-suspended',
      data: {
        companyName: subscription.tenant.companyName,
        reactivateUrl: `${process.env.APP_URL}/billing/reactivate`,
      },
    });
  }
}

module.exports = new DunningService();
```

---

## Proration & Upgrades

### Plan Change Logic

```javascript
// services/SubscriptionService.js
class SubscriptionService {
  async changePlan(subscriptionId, newPlanId) {
    const subscription = await Subscription.findByPk(subscriptionId);
    const oldPlan = await Plan.findByPk(subscription.planId);
    const newPlan = await Plan.findByPk(newPlanId);

    const isUpgrade = newPlan.price[subscription.billingCycle] >
                     oldPlan.price[subscription.billingCycle];

    if (isUpgrade) {
      return await this.upgrade(subscription, newPlan);
    } else {
      return await this.downgrade(subscription, newPlan);
    }
  }

  async upgrade(subscription, newPlan) {
    // Calculate proration
    const proration = this.calculateProration(
      subscription,
      newPlan.price[subscription.billingCycle]
    );

    // Update Stripe subscription
    const updatedStripeSubscription = await StripeService.upgradeSubscription(
      subscription.stripeSubscriptionId,
      newPlan.stripePriceId[subscription.billingCycle]
    );

    // Update local subscription
    await subscription.update({
      planId: newPlan.id,
      amount: newPlan.price[subscription.billingCycle],
    });

    // Create proration invoice if amount > 0
    if (proration.amount > 0) {
      await this.createProrationInvoice(subscription, proration);
    }

    return subscription;
  }

  async downgrade(subscription, newPlan) {
    // Downgrades take effect at period end
    await subscription.update({
      pendingPlanChange: newPlan.id,
      pendingAmount: newPlan.price[subscription.billingCycle],
    });

    // Schedule plan change for period end
    await StripeService.scheduleSubscriptionUpdate(
      subscription.stripeSubscriptionId,
      newPlan.stripePriceId[subscription.billingCycle],
      subscription.currentPeriodEnd
    );

    await EmailService.send({
      to: subscription.tenant.billingEmail,
      template: 'plan-downgrade-scheduled',
      data: {
        newPlanName: newPlan.name,
        effectiveDate: subscription.currentPeriodEnd,
      },
    });

    return subscription;
  }

  calculateProration(subscription, newAmount) {
    const oldAmount = parseFloat(subscription.amount);
    const periodStart = subscription.currentPeriodStart;
    const periodEnd = subscription.currentPeriodEnd;
    const now = new Date();

    const totalPeriodDays = Math.ceil(
      (periodEnd - periodStart) / (1000 * 60 * 60 * 24)
    );
    const remainingDays = Math.ceil(
      (periodEnd - now) / (1000 * 60 * 60 * 24)
    );

    const unusedAmount = (oldAmount / totalPeriodDays) * remainingDays;
    const newPeriodAmount = (newAmount / totalPeriodDays) * remainingDays;
    const proratedAmount = newPeriodAmount - unusedAmount;

    return {
      amount: Math.max(0, proratedAmount),
      remainingDays,
      totalPeriodDays,
      description: `Proration for ${remainingDays} days`,
    };
  }
}

module.exports = new SubscriptionService();
```

---

## Tax Calculation

### Tax Service Integration

```javascript
// services/TaxService.js
const Taxjar = require('taxjar');

class TaxService {
  constructor() {
    this.client = new Taxjar({
      apiKey: process.env.TAXJAR_API_KEY,
    });
  }

  async calculateTax(amount, tenant) {
    try {
      const taxData = await this.client.taxForOrder({
        from_country: 'US',
        from_zip: '94102',
        from_state: 'CA',
        from_city: 'San Francisco',
        from_street: '123 Business St',
        to_country: tenant.billingCountry,
        to_zip: tenant.billingZip,
        to_state: tenant.billingState,
        to_city: tenant.billingCity,
        to_street: tenant.billingAddress,
        amount: amount,
        shipping: 0,
        line_items: [
          {
            quantity: 1,
            unit_price: amount,
            product_tax_code: '10000', // Digital goods/SaaS
          },
        ],
      });

      return {
        rate: taxData.tax.rate,
        amount: taxData.tax.amount_to_collect,
        jurisdiction: taxData.tax.jurisdictions,
      };
    } catch (error) {
      console.error('Tax calculation error:', error);
      return { rate: 0, amount: 0 };
    }
  }

  async shouldChargeTax(tenant) {
    // US-based business rules
    if (tenant.billingCountry !== 'US') {
      return false; // No US tax for international customers
    }

    // Charge tax for customers in same state
    if (tenant.billingState === 'CA') {
      return true;
    }

    // Check if we have nexus in customer's state
    const nexusStates = ['CA', 'NY', 'TX', 'FL']; // Example
    return nexusStates.includes(tenant.billingState);
  }
}

module.exports = new TaxService();
```

---

## Database Schema

### Complete Billing Schema

```sql
-- Subscriptions table
CREATE TABLE subscriptions (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  tenant_id UUID NOT NULL REFERENCES tenants(id) ON DELETE CASCADE,
  plan_id VARCHAR(50) NOT NULL,
  status VARCHAR(20) NOT NULL CHECK (status IN ('trialing', 'active', 'past_due', 'canceled', 'unpaid', 'paused')),
  billing_cycle VARCHAR(10) NOT NULL CHECK (billing_cycle IN ('monthly', 'annual')),
  amount DECIMAL(10, 2) NOT NULL,
  currency VARCHAR(3) DEFAULT 'USD',
  trial_ends_at TIMESTAMP,
  current_period_start TIMESTAMP,
  current_period_end TIMESTAMP,
  cancel_at_period_end BOOLEAN DEFAULT FALSE,
  canceled_at TIMESTAMP,
  stripe_subscription_id VARCHAR(255) UNIQUE,
  stripe_customer_id VARCHAR(255),
  paypal_subscription_id VARCHAR(255),
  pending_plan_change VARCHAR(50),
  pending_amount DECIMAL(10, 2),
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX idx_subscriptions_tenant ON subscriptions(tenant_id);
CREATE INDEX idx_subscriptions_status ON subscriptions(status);
CREATE INDEX idx_subscriptions_period_end ON subscriptions(current_period_end);

-- Invoices table
CREATE TABLE invoices (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  tenant_id UUID NOT NULL REFERENCES tenants(id) ON DELETE CASCADE,
  subscription_id UUID REFERENCES subscriptions(id) ON DELETE SET NULL,
  invoice_number VARCHAR(50) UNIQUE NOT NULL,
  status VARCHAR(20) NOT NULL CHECK (status IN ('draft', 'open', 'paid', 'void', 'uncollectible')),
  amount DECIMAL(10, 2) NOT NULL,
  tax DECIMAL(10, 2) DEFAULT 0,
  total DECIMAL(10, 2) NOT NULL,
  currency VARCHAR(3) DEFAULT 'USD',
  due_date TIMESTAMP,
  paid_at TIMESTAMP,
  stripe_invoice_id VARCHAR(255) UNIQUE,
  invoice_pdf VARCHAR(500),
  line_items JSONB DEFAULT '[]',
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX idx_invoices_tenant ON invoices(tenant_id);
CREATE INDEX idx_invoices_status ON invoices(status);
CREATE INDEX idx_invoices_due_date ON invoices(due_date);

-- Payment methods table
CREATE TABLE payment_methods (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  tenant_id UUID NOT NULL REFERENCES tenants(id) ON DELETE CASCADE,
  type VARCHAR(20) NOT NULL CHECK (type IN ('card', 'bank_account', 'paypal')),
  is_default BOOLEAN DEFAULT FALSE,
  stripe_payment_method_id VARCHAR(255) UNIQUE,
  last_four VARCHAR(4),
  brand VARCHAR(20),
  exp_month INTEGER,
  exp_year INTEGER,
  billing_email VARCHAR(255),
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX idx_payment_methods_tenant ON payment_methods(tenant_id);

-- Failed payments table
CREATE TABLE failed_payments (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  tenant_id UUID NOT NULL REFERENCES tenants(id) ON DELETE CASCADE,
  subscription_id UUID REFERENCES subscriptions(id) ON DELETE CASCADE,
  invoice_id VARCHAR(255),
  amount DECIMAL(10, 2) NOT NULL,
  attempt_count INTEGER DEFAULT 1,
  next_retry_at TIMESTAMP,
  last_error TEXT,
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW()
);

CREATE INDEX idx_failed_payments_subscription ON failed_payments(subscription_id);
CREATE INDEX idx_failed_payments_retry ON failed_payments(next_retry_at);

-- Usage events table (for metering)
CREATE TABLE usage_events (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  tenant_id UUID NOT NULL REFERENCES tenants(id) ON DELETE CASCADE,
  event_type VARCHAR(50) NOT NULL,
  quantity INTEGER DEFAULT 1,
  metadata JSONB,
  timestamp TIMESTAMP DEFAULT NOW()
);

CREATE INDEX idx_usage_events_tenant_type ON usage_events(tenant_id, event_type);
CREATE INDEX idx_usage_events_timestamp ON usage_events(timestamp);

-- Coupons table
CREATE TABLE coupons (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  code VARCHAR(50) UNIQUE NOT NULL,
  type VARCHAR(20) NOT NULL CHECK (type IN ('percentage', 'fixed_amount')),
  value DECIMAL(10, 2) NOT NULL,
  currency VARCHAR(3),
  duration VARCHAR(20) CHECK (duration IN ('once', 'repeating', 'forever')),
  duration_in_months INTEGER,
  max_redemptions INTEGER,
  times_redeemed INTEGER DEFAULT 0,
  valid_from TIMESTAMP,
  valid_until TIMESTAMP,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMP DEFAULT NOW(),
  updated_at TIMESTAMP DEFAULT NOW()
);

-- Applied coupons table
CREATE TABLE applied_coupons (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  subscription_id UUID NOT NULL REFERENCES subscriptions(id) ON DELETE CASCADE,
  coupon_id UUID NOT NULL REFERENCES coupons(id),
  applied_at TIMESTAMP DEFAULT NOW()
);
```

---

**Version**: 1.0.0
**Last Updated**: 2025-11-15
