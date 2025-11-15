# UI/UX Flow Diagrams & User Journeys

## Table of Contents
1. [User Personas](#user-personas)
2. [User Journey Maps](#user-journey-maps)
3. [Core User Flows](#core-user-flows)
4. [Screen Wireframes](#screen-wireframes)
5. [Navigation Structure](#navigation-structure)
6. [Responsive Design Considerations](#responsive-design-considerations)

---

## User Personas

### 1. Agency Owner - Sarah
**Demographics**: 45 years old, owns a mid-sized real estate agency with 15 agents

**Goals**:
- Manage team performance and productivity
- Track overall business metrics
- Control branding and white-label settings
- Manage subscription and billing
- Oversee all transactions and revenue

**Pain Points**:
- Needs centralized dashboard to monitor all activities
- Wants detailed financial reporting
- Requires easy team management tools

**Tech Savviness**: Medium (uses email, CRM, familiar with SaaS)

---

### 2. Real Estate Agent - Mike
**Demographics**: 32 years old, active real estate agent, handles 20-30 transactions/year

**Goals**:
- Quickly add and manage property listings
- Capture and follow up with leads
- Track deals through closing
- Communicate efficiently with clients
- Access everything on mobile

**Pain Points**:
- Constantly on the go, needs mobile access
- Overwhelmed by manual follow-ups
- Loses track of important deadlines
- Difficult to showcase properties effectively

**Tech Savviness**: High (uses smartphone, apps, social media extensively)

---

### 3. Property Buyer/Client - Jennifer
**Demographics**: 38 years old, looking to purchase a family home

**Goals**:
- Browse available properties easily
- Save favorite listings
- Schedule property viewings
- Track transaction progress
- Communicate with agent

**Pain Points**:
- Too many properties to keep track of
- Unsure of transaction status
- Difficulty comparing properties
- Wants updates on new listings matching criteria

**Tech Savviness**: Medium-High (comfortable with online shopping, apps)

---

### 4. Property Seller/Client - Robert
**Demographics**: 55 years old, selling current home

**Goals**:
- See how property is being marketed
- Track showing activity
- Review offers
- Stay informed on transaction progress

**Pain Points**:
- Feels left in the dark about marketing efforts
- Anxious about sale timeline
- Wants regular updates

**Tech Savviness**: Medium (uses email, occasional app user)

---

## User Journey Maps

### Journey 1: Agency Owner Onboarding

```
PHASE 1: DISCOVERY & SIGNUP
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Landing Page                                     │
│ Action: Learns about platform features                       │
│ Emotion: 😊 Interested, Hopeful                              │
│ Pain Point: Unsure if it fits their needs                    │
│ Opportunity: Clear feature comparison, testimonials          │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Free Trial Signup                                │
│ Action: Enters business email, creates account               │
│ Emotion: 😐 Cautiously optimistic                            │
│ Pain Point: Concerned about commitment                       │
│ Opportunity: "No credit card required" messaging             │
└─────────────────────────────────────────────────────────────┘
                            ↓
PHASE 2: SETUP & CONFIGURATION
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Onboarding Wizard                                │
│ Action: Sets up company profile, branding, domain            │
│ Emotion: 😊 Excited to customize                             │
│ Pain Point: May feel overwhelmed by options                  │
│ Opportunity: Step-by-step guided setup, skip options         │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Team Invitation                                  │
│ Action: Invites agents and staff                             │
│ Emotion: 😊 Productive                                       │
│ Pain Point: Needs to import existing team                    │
│ Opportunity: CSV import, email invitation templates          │
└─────────────────────────────────────────────────────────────┘
                            ↓
PHASE 3: ACTIVE USE
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Dashboard                                        │
│ Action: Monitors team performance, reviews metrics           │
│ Emotion: 😊 Satisfied, in control                            │
│ Pain Point: Information overload initially                   │
│ Opportunity: Customizable dashboard, key metrics prominent   │
└─────────────────────────────────────────────────────────────┘
                            ↓
PHASE 4: CONVERSION
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Trial Ending Notification                        │
│ Action: Reviews plans, selects subscription tier             │
│ Emotion: 😊 Confident in value                               │
│ Pain Point: Price sensitivity                                │
│ Opportunity: ROI calculator, annual discount offer           │
└─────────────────────────────────────────────────────────────┘
```

---

### Journey 2: Agent Managing a Lead to Sale

```
STAGE 1: LEAD CAPTURE
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Lead Notification (Email/App)                    │
│ Action: Receives new lead from website form                  │
│ Emotion: 😊 Excited for new opportunity                      │
│ Time: Within 1 minute of lead submission                     │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Mobile App - Lead Detail                         │
│ Action: Reviews lead info, clicks "Call Now"                 │
│ Emotion: 😊 Eager to connect                                 │
│ Time: Within 5 minutes (critical response window)            │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 2: QUALIFICATION
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: CRM - Lead Profile                               │
│ Action: Updates lead status, adds notes from call            │
│ Emotion: 😊 Organized                                        │
│ Pain Point: Needs quick data entry while talking             │
│ Opportunity: Voice notes, quick-add tags                     │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Property Search & Match                          │
│ Action: Searches properties matching lead criteria           │
│ Emotion: 😊 Helpful                                          │
│ Action: Creates property collection, emails to client        │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 3: NURTURING
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Calendar & Tasks                                 │
│ Action: Schedules property showings                          │
│ Emotion: 😐 Busy, needs efficiency                           │
│ Opportunity: Automated reminders, batch scheduling           │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Communication Hub                                │
│ Action: Follows up via email/SMS after showings              │
│ Emotion: 😐 Tedious if manual                                │
│ Opportunity: Message templates, automated sequences          │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 4: CONVERSION
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Transaction Module                               │
│ Action: Creates new transaction, submits offer               │
│ Emotion: 😊 Accomplished                                     │
│ Action: Uploads offer documents, notifies all parties        │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 5: CLOSING
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Transaction Pipeline                             │
│ Action: Moves deal through stages (inspection, financing)    │
│ Emotion: 😐 Anxious about deadlines                          │
│ Opportunity: Automated deadline tracking, checklist          │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Closing Confirmation                             │
│ Action: Marks transaction as closed, records commission      │
│ Emotion: 😊😊 Thrilled, successful                           │
│ Action: Sends congratulations to client                      │
└─────────────────────────────────────────────────────────────┘
```

---

### Journey 3: Property Buyer Finding Their Home

```
STAGE 1: DISCOVERY
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Public Property Search Page                      │
│ Action: Searches for homes in desired area                   │
│ Emotion: 😊 Hopeful, excited                                 │
│ Experience: Fast search, beautiful images                    │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Property Detail Page                             │
│ Action: Views photos, virtual tour, neighborhood info        │
│ Emotion: 😊 Engaged, interested                              │
│ Action: Saves to favorites, shares with spouse               │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 2: INQUIRY
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Contact Form / "Schedule Showing" Button         │
│ Action: Submits inquiry with contact info                    │
│ Emotion: 😊 Anticipating response                            │
│ Expectation: Quick response from agent                       │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Agent Response (Email/Call)                      │
│ Action: Receives call/email within 5 minutes                 │
│ Emotion: 😊😊 Impressed with quick response                  │
│ Experience: Agent is knowledgeable, helpful                  │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 3: CLIENT PORTAL ACCESS
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Client Portal Invitation Email                   │
│ Action: Creates account, logs into portal                    │
│ Emotion: 😊 Feels valued, official                           │
│ Experience: Easy registration, clean interface               │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Personalized Property Recommendations            │
│ Action: Views curated properties from agent                  │
│ Emotion: 😊 Appreciated personalized service                 │
│ Action: Saves favorites, compares properties                 │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 4: VIEWING & DECISION
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Scheduled Showings Calendar                      │
│ Action: Views upcoming appointments, receives reminders      │
│ Emotion: 😊 Organized, prepared                              │
│ Experience: Calendar sync, SMS reminders                     │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Property Comparison Tool                         │
│ Action: Compares 3-4 favorite properties side-by-side        │
│ Emotion: 🤔 Analytical, decision-making                      │
│ Action: Decides on favorite property                         │
└─────────────────────────────────────────────────────────────┘
                            ↓
STAGE 5: OFFER & TRANSACTION
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Transaction Dashboard (Client View)              │
│ Action: Reviews offer details, signs documents digitally     │
│ Emotion: 😊 Confident with transparency                      │
│ Experience: Clear process, e-signature integration           │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Transaction Progress Tracker                     │
│ Action: Monitors deal progress, sees completed milestones    │
│ Emotion: 😊 Reassured, informed                              │
│ Experience: Visual timeline, regular updates                 │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│ Touchpoint: Closing Celebration                              │
│ Action: Receives congratulations message, keys handoff info  │
│ Emotion: 😊😊😊 Elated, grateful                             │
│ Experience: Memorable moment, post-closing support           │
└─────────────────────────────────────────────────────────────┘
```

---

## Core User Flows

### Flow 1: User Registration & Login

```
START: Landing Page
    ↓
┌─────────────────────┐
│ Click "Sign Up"     │
└─────────────────────┘
    ↓
┌─────────────────────────────────────┐
│ Registration Form                   │
│ ┌─────────────────────────────────┐ │
│ │ Email: ___________________      │ │
│ │ Password: _________________     │ │
│ │ Company Name: _____________     │ │
│ │ Phone: ____________________     │ │
│ │                                 │ │
│ │ □ I agree to Terms & Privacy    │ │
│ │                                 │ │
│ │ [Start Free Trial] ─────────────┼─┼──> Validation Failed
│ └─────────────────────────────────┘ │        ↓
└─────────────────────────────────────┘   Show Errors
    ↓ Success                              (inline)
┌─────────────────────────────────────┐        │
│ Email Verification Sent             │        │
│ "Check your inbox to verify"        │        │
└─────────────────────────────────────┘        │
    ↓                                          │
User clicks link in email ←───────────────────┘
    ↓
┌─────────────────────────────────────┐
│ Email Verified ✓                    │
│ "Your account is now active"        │
│ [Continue to Dashboard]             │
└─────────────────────────────────────┘
    ↓
┌─────────────────────────────────────┐
│ Onboarding Wizard                   │
│ Step 1 of 4: Company Profile        │
└─────────────────────────────────────┘
    ↓
END: Dashboard
```

**Alternative Flow: Login**
```
START: Landing Page
    ↓
Click "Login"
    ↓
┌─────────────────────────────────────┐
│ Login Form                          │
│ Email: _______________________      │
│ Password: ____________________      │
│ □ Remember me                       │
│ [Login] [Forgot Password?]          │
└─────────────────────────────────────┘
    ↓
Credentials Correct? ──No──> Show Error
    │                        "Invalid credentials"
    Yes                            ↓
    ↓                         Retry (max 5 attempts)
2FA Enabled? ──No──> Set Session + Token
    │                        ↓
    Yes              Redirect to Dashboard
    ↓
┌─────────────────────────────────────┐
│ 2FA Verification                    │
│ Enter 6-digit code from app:        │
│ [_] [_] [_] [_] [_] [_]            │
│ [Verify] [Use Backup Code]          │
└─────────────────────────────────────┘
    ↓
Code Valid? ──No──> Show Error
    │
    Yes
    ↓
Set Session + Token
    ↓
Redirect to Dashboard
```

---

### Flow 2: Creating a Property Listing

```
START: Agent Dashboard
    ↓
Click "Add Property" (+ button or nav)
    ↓
┌──────────────────────────────────────────────┐
│ Property Creation - Step 1/5: Basic Info     │
│ ┌──────────────────────────────────────────┐ │
│ │ Listing Type: ● Sale  ○ Rent  ○ Lease   │ │
│ │ Property Type: [Dropdown: House ▼]       │ │
│ │ Title: _____________________________     │ │
│ │ Price: $_____________                    │ │
│ │ MLS #: _____________ (optional)          │ │
│ │                                          │ │
│ │ [Cancel] [Save Draft] [Next →]          │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓ Click Next
┌──────────────────────────────────────────────┐
│ Property Creation - Step 2/5: Location       │
│ ┌──────────────────────────────────────────┐ │
│ │ Street Address: ___________________      │ │
│ │ City: _____________ State: [CA ▼]        │ │
│ │ ZIP: _______ Country: [USA ▼]            │ │
│ │                                          │ │
│ │ [📍 Use Current Location]                │ │
│ │                                          │ │
│ │ Map Preview:                             │ │
│ │ ┌──────────────────────────────────────┐ │ │
│ │ │      [Interactive Map]               │ │ │
│ │ │         📍 Marker                     │ │ │
│ │ └──────────────────────────────────────┘ │ │
│ │                                          │ │
│ │ [← Back] [Save Draft] [Next →]          │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓
┌──────────────────────────────────────────────┐
│ Property Creation - Step 3/5: Details        │
│ ┌──────────────────────────────────────────┐ │
│ │ Bedrooms: [4 ▼]  Bathrooms: [2.5 ▼]     │ │
│ │ Square Feet: ________                    │ │
│ │ Lot Size: _________ (acres/sqft)         │ │
│ │ Year Built: ________                     │ │
│ │ Stories: [2 ▼]                           │ │
│ │ Parking Spaces: [2 ▼]                    │ │
│ │                                          │ │
│ │ [← Back] [Save Draft] [Next →]          │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓
┌──────────────────────────────────────────────┐
│ Property Creation - Step 4/5: Features       │
│ ┌──────────────────────────────────────────┐ │
│ │ Interior Features:                       │ │
│ │ ☑ Hardwood Floors  ☑ Fireplace          │ │
│ │ ☐ Granite Counters ☐ Walk-in Closet     │ │
│ │                                          │ │
│ │ Exterior Features:                       │ │
│ │ ☑ Pool  ☐ Deck  ☐ Patio  ☑ Garden      │ │
│ │                                          │ │
│ │ Appliances:                              │ │
│ │ ☑ Refrigerator ☑ Dishwasher ☑ Washer   │ │
│ │                                          │ │
│ │ Description:                             │ │
│ │ ┌──────────────────────────────────────┐ │ │
│ │ │ [Rich Text Editor]                   │ │ │
│ │ │                                      │ │ │
│ │ └──────────────────────────────────────┘ │ │
│ │                                          │ │
│ │ [← Back] [Save Draft] [Next →]          │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓
┌──────────────────────────────────────────────┐
│ Property Creation - Step 5/5: Media          │
│ ┌──────────────────────────────────────────┐ │
│ │ Photos: (Max 50)                         │ │
│ │ ┌────────────────────────────────────┐   │ │
│ │ │  Drag & drop files here            │   │ │
│ │ │  or [Browse Files]                 │   │ │
│ │ └────────────────────────────────────┘   │ │
│ │                                          │ │
│ │ Uploaded Photos: [Grid of thumbnails]    │ │
│ │ 🖼️ 🖼️ 🖼️ 🖼️                           │ │
│ │ ⭐ Featured   [Reorder] [Delete]         │ │
│ │                                          │ │
│ │ Virtual Tour URL (optional):             │ │
│ │ ______________________________           │ │
│ │                                          │ │
│ │ Video URL (YouTube/Vimeo):               │ │
│ │ ______________________________           │ │
│ │                                          │ │
│ │ [← Back] [Save Draft] [Publish ✓]       │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓ Click Publish
┌──────────────────────────────────────────────┐
│ ✓ Property Published Successfully!           │
│                                              │
│ What's next?                                 │
│ • [Share on Social Media]                    │
│ • [Send to Email List]                       │
│ • [View Property Page]                       │
│ • [Create Another Listing]                   │
│                                              │
│ [Go to Dashboard]                            │
└──────────────────────────────────────────────┘
    ↓
END: Dashboard with new property visible
```

---

### Flow 3: Lead Capture to Assignment

```
START: Website Visitor on Property Page
    ↓
Visitor clicks "Schedule a Showing" or "Contact Agent"
    ↓
┌──────────────────────────────────────────────┐
│ Contact Form Modal                           │
│ ┌──────────────────────────────────────────┐ │
│ │ Name: ______________________________     │ │
│ │ Email: _____________________________     │ │
│ │ Phone: _____________________________     │ │
│ │ Message:                                 │ │
│ │ ┌────────────────────────────────────┐   │ │
│ │ │ I'm interested in this property... │   │ │
│ │ └────────────────────────────────────┘   │ │
│ │                                          │ │
│ │ Preferred Contact: ● Phone ○ Email       │ │
│ │                                          │ │
│ │ [Cancel] [Send Message]                  │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓ Submit
┌──────────────────────────────────────────────┐
│ ✓ Thank You!                                 │
│ "An agent will contact you shortly"          │
│ "Expected response: < 5 minutes"             │
└──────────────────────────────────────────────┘
    ↓ (Backend Process)
Lead Created in Database
    ↓
Lead Assignment Logic:
    ├─> Check property owner/listing agent
    ├─> If available → Assign to them
    └─> If not → Round-robin to available agents
    ↓
┌──────────────────────────────────────────────┐
│ AGENT SIDE: Push Notification                │
│ "🔔 New Lead: Jennifer Smith"                │
│ "Interested in 123 Main St"                  │
│ [Call Now] [View Details]                    │
└──────────────────────────────────────────────┘
    ↓ Agent clicks notification
┌──────────────────────────────────────────────┐
│ Lead Detail Screen (Mobile)                  │
│ ┌──────────────────────────────────────────┐ │
│ │ Jennifer Smith                           │ │
│ │ 📧 jen@email.com                         │ │
│ │ 📱 (555) 123-4567                        │ │
│ │                                          │ │
│ │ Property: 123 Main St                    │ │
│ │ [🏠 View Property]                       │ │
│ │                                          │ │
│ │ Message:                                 │ │
│ │ "I'm interested in scheduling a          │ │
│ │ viewing this weekend..."                 │ │
│ │                                          │ │
│ │ Lead Score: ⭐⭐⭐⭐ (Hot)                │ │
│ │ Source: Website Inquiry                  │ │
│ │ Received: 2 minutes ago                  │ │
│ │                                          │ │
│ │ Quick Actions:                           │ │
│ │ [📞 Call Now] [💬 Text] [📧 Email]      │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓ Agent clicks "Call Now"
Initiates call via app (VoIP or phone dialer)
    ↓ After call
┌──────────────────────────────────────────────┐
│ Add Call Notes                               │
│ ┌──────────────────────────────────────────┐ │
│ │ Call Result: [Connected ▼]               │ │
│ │                                          │ │
│ │ Notes:                                   │ │
│ │ ┌────────────────────────────────────┐   │ │
│ │ │ Discussed property details.        │   │ │
│ │ │ Scheduled showing for Saturday.    │   │ │
│ │ └────────────────────────────────────┘   │ │
│ │                                          │ │
│ │ Next Action:                             │ │
│ │ ● Schedule showing  ○ Send info          │ │
│ │ ○ Follow up later   ○ Not interested     │ │
│ │                                          │ │
│ │ [Save & Schedule Showing]                │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓
Lead status updated to "Contacted"
Activity logged in timeline
Showing scheduled in calendar
    ↓
END: Lead in CRM pipeline
```

---

### Flow 4: Transaction Pipeline Management

```
START: Agent has accepted offer
    ↓
Navigate to Transactions → Click "Create Transaction"
    ↓
┌──────────────────────────────────────────────┐
│ New Transaction                              │
│ ┌──────────────────────────────────────────┐ │
│ │ Property: [Search & Select Property]     │ │
│ │ → 123 Main St, San Francisco             │ │
│ │                                          │ │
│ │ Transaction Type: ● Purchase ○ Lease     │ │
│ │                                          │ │
│ │ Buyer: [Jennifer Smith]                  │ │
│ │ Seller: [Robert Johnson]                 │ │
│ │                                          │ │
│ │ Purchase Price: $450,000                 │ │
│ │ Earnest Money: $10,000                   │ │
│ │ Closing Date: [MM/DD/YYYY]               │ │
│ │                                          │ │
│ │ Commission %: 3%                         │ │
│ │ Split: Agent 70% | Brokerage 30%         │ │
│ │                                          │ │
│ │ [Cancel] [Create Transaction]            │ │
│ └──────────────────────────────────────────┘ │
└──────────────────────────────────────────────┘
    ↓
Transaction created, checklist initialized
    ↓
┌──────────────────────────────────────────────────────────┐
│ Transaction Pipeline View                                │
│                                                          │
│ ┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐ │
│ │Offer   │ │Under   │ │Inspect.│ │Finance │ │Closing │ │
│ │Accept. │ │Contract│ │Period  │ │Approved│ │        │ │
│ ├────────┤ ├────────┤ ├────────┤ ├────────┤ ├────────┤ │
│ │        │ │ [Card] │ │        │ │        │ │        │ │
│ │        │ │123 Main│ │        │ │        │ │        │ │
│ │        │ │$450K   │ │        │ │        │ │        │ │
│ │        │ │Due:5d  │ │        │ │        │ │        │ │
│ └────────┘ └────────┘ └────────┘ └────────┘ └────────┘ │
│                                                          │
│ [+ Add Transaction]                    Pipeline Value: $450K │
└──────────────────────────────────────────────────────────┘
    ↓ Click on transaction card
┌──────────────────────────────────────────────────────────┐
│ Transaction Details: 123 Main St                         │
│ ─────────────────────────────────────────────────────    │
│ Status: Under Contract        Closes in: 28 days         │
│                                                          │
│ [Timeline] [Checklist] [Documents] [Parties] [Notes]     │
│ ────────────────────────────────────────────────────     │
│                                                          │
│ Checklist (8/15 complete)                     🔄 48%     │
│ ✓ Offer accepted                                         │
│ ✓ Earnest money deposited                                │
│ ✓ Title company selected                                 │
│ ⏳ Schedule home inspection (Due in 3 days) 🔴           │
│ ⏳ Secure financing approval                             │
│ ⬜ Complete appraisal                                     │
│ ⬜ Final walk-through                                     │
│ ⬜ Sign closing documents                                 │
│ ... [View All]                                           │
│                                                          │
│ Recent Activity                                          │
│ • Mike added note "Buyer approved for loan" - 2h ago     │
│ • Jennifer Smith uploaded "Pre-approval letter" - 1d ago │
│ • Stage changed to "Under Contract" - 3d ago             │
│                                                          │
│ [Move Stage →] [Add Note] [Upload Document]              │
└──────────────────────────────────────────────────────────┘
    ↓ Agent completes inspection, checks item
Checklist item marked complete
System sends automatic update to client
    ↓ All items in current stage complete
┌──────────────────────────────────────────────┐
│ Ready to advance stage?                      │
│ All inspection items are complete.           │
│                                              │
│ Move to "Financing Approved"?                │
│ [No, Not Yet] [Yes, Move →]                  │
└──────────────────────────────────────────────┘
    ↓ Click "Yes, Move"
Transaction card moves to next column in pipeline
Notifications sent to all parties
New checklist items become active
    ↓
... Repeat process through stages ...
    ↓
Final Stage: Closing
┌──────────────────────────────────────────────┐
│ Mark Transaction as Closed?                  │
│                                              │
│ Closing Date: 05/15/2025 ✓                   │
│ Final Sale Price: $450,000                   │
│ Commission Earned: $13,500                   │
│   - Your Share: $9,450                       │
│   - Brokerage: $4,050                        │
│                                              │
│ ✓ All documents signed                       │
│ ✓ Funds transferred                          │
│ ✓ Keys delivered                             │
│                                              │
│ [Cancel] [Close Transaction ✓]               │
└──────────────────────────────────────────────┘
    ↓
Transaction marked as closed
Property status updated to "Sold"
Commission recorded
Success emails sent to all parties
    ↓
END: Transaction complete, archived
```

---

## Screen Wireframes

### 1. Dashboard (Agent View)

```
┌─────────────────────────────────────────────────────────────┐
│ [Logo]  Dashboard  Properties  Leads  Transactions  More▼   │
│                                          🔔  👤 Mike Johnson │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  Good morning, Mike! 👋                                     │
│  You have 3 new leads and 2 showings today                  │
│                                                             │
│  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐       │
│  │ Active       │ │ New Leads    │ │ Closing This │       │
│  │ Listings     │ │ This Week    │ │ Month        │       │
│  │              │ │              │ │              │       │
│  │    24        │ │     12       │ │      3       │       │
│  │  +2 this wk  │ │   🔥 Hot     │ │   $1.2M      │       │
│  └──────────────┘ └──────────────┘ └──────────────┘       │
│                                                             │
│  Quick Actions                                              │
│  [+ Add Property] [+ Add Lead] [Schedule Showing]           │
│                                                             │
│  ┌─ Recent Leads ──────────────────────────────────┐       │
│  │ Jennifer Smith          Hot Lead     2 mins ago │       │
│  │ Interested in 123 Main St         [View] [Call] │       │
│  │                                                  │       │
│  │ Tom Brown              Medium       1 hour ago  │       │
│  │ Looking for 3BR downtown          [View] [Call] │       │
│  │                                                  │       │
│  │ Sarah Davis            Cold         3 hours ago │       │
│  │ General inquiry                   [View] [Email] │       │
│  │                                                  │       │
│  │                                    [View All →] │       │
│  └──────────────────────────────────────────────────┘       │
│                                                             │
│  ┌─ Today's Schedule ──────────────────────────────┐       │
│  │ 10:00 AM - Property Showing                     │       │
│  │            456 Oak Ave with Jennifer Smith       │       │
│  │            [Get Directions] [Call Client]        │       │
│  │                                                  │       │
│  │ 2:30 PM  - Client Meeting                       │       │
│  │            Office - Tom Brown                    │       │
│  │            [Join Video Call] [Reschedule]        │       │
│  │                                    [View All →] │       │
│  └──────────────────────────────────────────────────┘       │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

### 2. Property Listing Page (Public)

```
┌─────────────────────────────────────────────────────────────┐
│ [Agency Logo]         Search    For Buyers   For Sellers    │
│                                              [Login] [Sign Up]│
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌───────────────────────────────────────────────────────┐ │
│  │                                                        │ │
│  │         [Large Property Photo - Main Image]           │ │
│  │                                                        │ │
│  │  ◄  1 / 24  ►                           [⛶ Gallery]  │ │
│  └───────────────────────────────────────────────────────┘ │
│                                                             │
│  $450,000                    [♥ Save] [⤴ Share] [🖨 Print] │
│  123 Main Street, San Francisco, CA 94102                   │
│                                                             │
│  4 beds  |  3 baths  |  2,500 sqft  |  Built 2015          │
│                                                             │
│  ┌──────────────────────────────────────────────────────┐  │
│  │ [Schedule a Showing] [Contact Agent] [Get Pre-Approved]│ │
│  └──────────────────────────────────────────────────────┘  │
│                                                             │
│  [Overview] [Details] [Map] [Schools] [Virtual Tour]        │
│  ─────────────────────────────────────────────────────      │
│                                                             │
│  About This Home                                            │
│  Beautiful family home in prime location. This stunning     │
│  4-bedroom, 3-bathroom residence features an open floor     │
│  plan, gourmet kitchen with granite countertops...          │
│                                                             │
│  Key Features                                               │
│  ✓ Hardwood Floors      ✓ Updated Kitchen                  │
│  ✓ Fireplace            ✓ Large Backyard                   │
│  ✓ 2-Car Garage         ✓ Walk-in Closets                  │
│                                                             │
│  Property Details                                           │
│  Type: Single Family    Lot Size: 0.25 acres                │
│  Year Built: 2015       HOA: $150/month                     │
│  Stories: 2             Parking: 2 spaces                   │
│                                                             │
│  ┌─ Location & Map ─────────────────────────────────────┐  │
│  │ 123 Main Street, San Francisco, CA 94102             │  │
│  │                                                       │  │
│  │ ┌───────────────────────────────────────────────────┐│  │
│  │ │              [Interactive Map]                    ││  │
│  │ │                    📍                             ││  │
│  │ └───────────────────────────────────────────────────┘│  │
│  │                                                       │  │
│  │ Walk Score: 85  Transit Score: 72  Bike Score: 78    │  │
│  └───────────────────────────────────────────────────────┘  │
│                                                             │
│  ┌─ Contact Agent ──────────────────────────────────────┐  │
│  │  [Agent Photo]  Mike Johnson                         │  │
│  │                 Real Estate Agent                    │  │
│  │                 ⭐ 4.9 (127 reviews)                  │  │
│  │                                                       │  │
│  │                 📧 mike@agency.com                    │  │
│  │                 📱 (555) 123-4567                     │  │
│  │                                                       │  │
│  │                 [Send Message]  [Call Now]            │  │
│  └───────────────────────────────────────────────────────┘  │
│                                                             │
│  Similar Properties You May Like                            │
│  [Property Card] [Property Card] [Property Card]            │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

### 3. CRM Lead Management

```
┌─────────────────────────────────────────────────────────────┐
│ Leads          [🔍 Search leads...]        [+ New Lead]      │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ Filters:  All ▼   Source: All ▼   Date: This Month ▼       │
│                                                             │
│ Status:  [New] [Contacted] [Qualified] [Converted] [Lost]   │
│           45      32         18          12         8       │
│                                                             │
│ ┌───────────────────────────────────────────────────────┐  │
│ │ Lead                  Score  Source     Assigned  Age │  │
│ ├───────────────────────────────────────────────────────┤  │
│ │ 🔥 Jennifer Smith     ⭐⭐⭐⭐  Website    Mike J.   2m │  │
│ │    jen@email.com                                      │  │
│ │    "Interested in 123 Main St"                        │  │
│ │    [Call] [Email] [Assign] [Convert]         [View →]│  │
│ ├───────────────────────────────────────────────────────┤  │
│ │ 🔵 Tom Brown          ⭐⭐⭐    Referral   Mike J.   1h │  │
│ │    tom@email.com                                      │  │
│ │    "Looking for 3BR downtown"                         │  │
│ │    [Call] [Email] [Assign] [Convert]         [View →]│  │
│ ├───────────────────────────────────────────────────────┤  │
│ │ ⚪ Sarah Davis        ⭐⭐      Open House  Sarah T. 3h │  │
│ │    sarah@email.com                                    │  │
│ │    "General inquiry about buying"                     │  │
│ │    [Call] [Email] [Assign] [Convert]         [View →]│  │
│ ├───────────────────────────────────────────────────────┤  │
│ │ ... more leads ...                                    │  │
│ └───────────────────────────────────────────────────────┘  │
│                                                             │
│ Showing 1-20 of 115 leads                    < 1 2 3 ... > │
│                                                             │
└─────────────────────────────────────────────────────────────┘

[Click on a lead to view details]

┌─────────────────────────────────────────────────────────────┐
│ ← Back to Leads                           Jennifer Smith    │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│ [Contact Info] [Timeline] [Notes] [Properties] [Documents]  │
│ ──────────────────────────────────────────────────────      │
│                                                             │
│ Status: New 🔥            Lead Score: ⭐⭐⭐⭐ (Hot)         │
│                                                             │
│ Quick Actions:                                              │
│ [📞 Call] [💬 SMS] [📧 Email] [📅 Schedule] [✓ Convert]   │
│                                                             │
│ Contact Information                                         │
│ 📧 jen@email.com                                            │
│ 📱 (555) 987-6543                                           │
│ 📍 San Francisco, CA                                        │
│                                                             │
│ Lead Details                                                │
│ Source: Website Inquiry                                     │
│ Captured: Nov 15, 2025 10:28 AM (2 minutes ago)             │
│ Assigned to: Mike Johnson                                   │
│ Budget: $400K - $500K                                       │
│ Looking for: 3-4 BR House in San Francisco                  │
│ Timeline: 3-6 months                                        │
│ Pre-qualified: Not yet                                      │
│                                                             │
│ Initial Message:                                            │
│ "I'm interested in scheduling a viewing for the property    │
│ at 123 Main St. I'm looking to buy within the next few      │
│ months and this property seems perfect for my family."      │
│                                                             │
│ Property of Interest:                                       │
│ ┌─────────────────────────────────────────────────────────┐│
│ │ 🏠 123 Main St, San Francisco                           ││
│ │    $450,000  |  4 bed  |  3 bath                        ││
│ │    [View Property →]                                    ││
│ └─────────────────────────────────────────────────────────┘│
│                                                             │
│ Activity Timeline                                           │
│ ┌─────────────────────────────────────────────────────────┐│
│ │ ⚫ 2 min ago - Lead created via website inquiry         ││
│ │ ⚫ 1 min ago - Auto-assigned to Mike Johnson            ││
│ │ ⚫ Just now  - Email notification sent to Mike          ││
│ └─────────────────────────────────────────────────────────┘│
│                                                             │
│ Add Note:                                                   │
│ ┌─────────────────────────────────────────────────────────┐│
│ │ [Text area for notes...]                                ││
│ │                                                         ││
│ │ [Save Note]                                             ││
│ └─────────────────────────────────────────────────────────┘│
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

### 4. Mobile App - Home Screen

```
┌──────────────────────┐
│ ☰  Real Estate Pro   │ 🔔 👤
├──────────────────────┤
│                      │
│ Hi Mike! 👋          │
│ Tuesday, Nov 15      │
│                      │
│ ┌──────────────────┐ │
│ │ 3 New Leads      │ │
│ │ 2 Showings Today │ │
│ │ 1 Closing Soon   │ │
│ └──────────────────┘ │
│                      │
│ Quick Actions        │
│ ┌────┐ ┌────┐ ┌────┐│
│ │ 🏠 │ │ 👤 │ │ 📅 ││
│ │Add │ │Add │ │Cal.││
│ │Prop│ │Lead│ │    ││
│ └────┘ └────┘ └────┘│
│                      │
│ Today's Schedule     │
│ ┌──────────────────┐ │
│ │ 10:00 AM  🏠     │ │
│ │ Showing          │ │
│ │ 456 Oak Ave      │ │
│ │ w/ Jennifer Smith│ │
│ │ [Navigate] [Call]│ │
│ └──────────────────┘ │
│                      │
│ ┌──────────────────┐ │
│ │ 2:30 PM   👤     │ │
│ │ Client Meeting   │ │
│ │ Tom Brown        │ │
│ │ [Join] [Details] │ │
│ └──────────────────┘ │
│                      │
│ Recent Leads         │
│ ┌──────────────────┐ │
│ │🔥 Jennifer Smith │ │
│ │   2 mins ago     │ │
│ │   "123 Main St"  │ │
│ │ [Call] [View]    │ │
│ └──────────────────┘ │
│                      │
│ ┌──────────────────┐ │
│ │🔵 Tom Brown      │ │
│ │   1 hour ago     │ │
│ │   "3BR downtown" │ │
│ │ [Call] [View]    │ │
│ └──────────────────┘ │
│                      │
│ [View All →]         │
│                      │
├──────────────────────┤
│ [🏠] [👤] [💬] [📊] │
│ Home Leads Chat Stats│
└──────────────────────┘
```

---

## Navigation Structure

### Primary Navigation (Logged-In User)

```
Main Navigation Bar (Top):
├── Dashboard (🏠)
├── Properties (🏢)
│   ├── All Properties
│   ├── Active Listings
│   ├── Pending
│   ├── Sold/Leased
│   └── Add New Property
├── Leads (👤)
│   ├── All Leads
│   ├── My Leads
│   ├── Unassigned
│   ├── Converted
│   └── Add New Lead
├── Contacts (📇)
│   ├── All Contacts
│   ├── Buyers
│   ├── Sellers
│   ├── Landlords
│   └── Tenants
├── Transactions (💼)
│   ├── Pipeline View
│   ├── Active Transactions
│   ├── Closed
│   └── Create Transaction
├── Marketing (📢)
│   ├── Email Campaigns
│   ├── Social Media
│   ├── Landing Pages
│   └── Templates
├── Reports (📊)
│   ├── Dashboard
│   ├── Sales Reports
│   ├── Lead Reports
│   ├── Agent Performance
│   └── Custom Reports
├── Calendar (📅)
│   ├── My Calendar
│   ├── Team Calendar
│   └── Showings
├── Documents (📄)
│   ├── My Documents
│   ├── Templates
│   ├── Recent
│   └── Shared with Me
└── More (⋯)
    ├── Tasks
    ├── Team
    ├── Settings
    ├── Help Center
    └── Logout

User Menu (Top Right):
├── Profile
├── Settings
│   ├── Personal Settings
│   ├── Notification Preferences
│   └── Security
├── Billing (if admin)
├── Help & Support
└── Logout

Admin-Only Menu (if Agency Owner/Admin):
├── Agency Settings
│   ├── Branding
│   ├── Domain
│   ├── Integrations
│   └── Features
├── Team Management
│   ├── Users
│   ├── Roles & Permissions
│   └── Invitations
├── Billing & Subscription
│   ├── Current Plan
│   ├── Invoices
│   └── Payment Methods
└── Platform Settings
```

---

### Public Website Navigation

```
Public Site Header:
├── [Agency Logo]
├── Buy
│   ├── Search Homes
│   ├── Featured Listings
│   ├── Open Houses
│   └── Buyer Resources
├── Sell
│   ├── List Your Property
│   ├── Home Valuation
│   ├── Seller Resources
│   └── Market Reports
├── Rent
│   ├── Search Rentals
│   ├── Landlord Services
│   └── Tenant Resources
├── About
│   ├── Our Team
│   ├── Our Story
│   └── Testimonials
├── Contact
└── [Login] [Sign Up]

Footer:
├── Properties
├── Neighborhoods
├── Our Agents
├── Blog
├── Resources
├── Privacy Policy
├── Terms of Service
└── Contact Us
```

---

## Responsive Design Considerations

### Breakpoints

- **Desktop**: ≥ 1200px (Full layout, sidebar navigation)
- **Tablet**: 768px - 1199px (Collapsed sidebar, touch-optimized)
- **Mobile**: < 768px (Bottom navigation, stacked layout)

### Mobile-First Adaptations

**Dashboard**:
- Desktop: 3-column card layout
- Tablet: 2-column layout
- Mobile: Single column, vertically stacked

**Property Listings**:
- Desktop: Grid view (3-4 columns)
- Tablet: Grid view (2 columns)
- Mobile: List view (1 column, card format)

**Navigation**:
- Desktop: Top horizontal nav + left sidebar
- Tablet: Top nav + hamburger menu for sidebar
- Mobile: Bottom tab navigation (5 main items)

**Forms**:
- Desktop: Multi-column layouts where applicable
- Tablet: 2 columns for related fields
- Mobile: Single column, full-width inputs

**Tables**:
- Desktop: Full table with all columns
- Tablet: Hide less important columns
- Mobile: Card-based layout, scrollable or paginated

**Maps**:
- Desktop: Full-size embedded map
- Tablet: Reduced size, touch controls
- Mobile: Collapsible/expandable map, "View in Maps App" option

### Touch Targets

All interactive elements on mobile:
- Minimum height: 44px (Apple) / 48dp (Android)
- Adequate spacing between clickable elements
- Larger form inputs (minimum 16px font to prevent zoom on iOS)

### Performance Optimizations

- Lazy loading images below the fold
- Infinite scroll or pagination for long lists
- Image optimization and responsive images (srcset)
- Progressive Web App (PWA) capabilities for mobile
- Offline mode for critical features (mobile app)

---

## Accessibility Considerations

- **WCAG 2.1 Level AA Compliance**
- Keyboard navigation support
- ARIA labels and roles
- Color contrast ratios ≥ 4.5:1 for text
- Focus indicators visible
- Screen reader compatible
- Alt text for all images
- Captions for videos
- Form labels and error messages
- Skip navigation links

---

## Design System Components

**Colors**:
- Primary: #2563EB (Blue)
- Secondary: #10B981 (Green)
- Accent: #F59E0B (Amber)
- Error: #EF4444 (Red)
- Warning: #F59E0B (Orange)
- Success: #10B981 (Green)
- Neutral: Grays 100-900

**Typography**:
- Headings: Inter (sans-serif), Bold
- Body: Inter (sans-serif), Regular
- Code/Numbers: Roboto Mono

**Buttons**:
- Primary: Solid blue, white text
- Secondary: Outlined blue, blue text
- Tertiary: Text only, blue text
- Danger: Solid red
- Success: Solid green

**Icons**:
- Icon library: Heroicons or Font Awesome
- Size: 16px (small), 20px (medium), 24px (large)

**Spacing**:
- Base unit: 4px
- Scale: 4, 8, 12, 16, 24, 32, 48, 64px

**Shadows**:
- Small: 0 1px 2px rgba(0,0,0,0.05)
- Medium: 0 4px 6px rgba(0,0,0,0.1)
- Large: 0 10px 15px rgba(0,0,0,0.1)

**Border Radius**:
- Small: 4px (buttons, inputs)
- Medium: 8px (cards)
- Large: 12px (modals, large containers)
- Full: 9999px (pills, avatars)

---

**Document Version**: 1.0
**Last Updated**: 2025-11-15
