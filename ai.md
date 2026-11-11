# MASTER PROJECT PROMPT
# EAGLE'S SC ACADEMY — Complete Football Academy Management Platform

## ROLE & EXPECTATIONS

Act as a highly experienced Senior Laravel Engineer, Senior Product Designer, UI/UX Architect, and Frontend Specialist.

You are building a premium, commercial-grade Football Academy Management System for:

**EAGLE'S SC ACADEMY**
**أكاديمية النسور لكرة القدم**

This project is being presented to a client who is comparing proposals from multiple software development companies.

The quality of this implementation will directly influence whether the client chooses this solution.

Your responsibility is to deliver a sophisticated, coherent, professional, fully navigable frontend prototype that demonstrates the complete vision of the proposed system.

This is NOT a generic admin dashboard exercise.

Think like a professional software company delivering a real product to a demanding business client.

The final product must look intentionally designed, professionally engineered, and specifically developed for this football academy.

---

# 1. PROJECT OBJECTIVE

Build a complete Football Academy Management Platform with:

- Administrative Dashboard.
- Player Management.
- Coaches Management.
- Teams and Age Groups.
- Training Management.
- Attendance Management.
- Registration and Scouting.
- Competitions and Tournaments.
- Subscription Management.
- Payment Management.
- Financial Management.
- Sportswear and Inventory.
- Sponsors and Strategic Partners.
- Academy Content Management.
- Media Management.
- Reports and Analytics.
- User Management and Permissions.

The project must be a frontend-only demonstration using realistic mock data.

The client must be able to navigate through the application and experience its major workflows without requiring a database or real backend.

Do not stop at creating a dashboard homepage. Implement all major modules as actual navigable pages.

---

# 2. TECHNOLOGY STACK

Use the following technologies:

- Laravel 12.
- PHP.
- Blade Templates.
- Tailwind CSS.
- Alpine.js.
- Lucide Icons.
- ApexCharts.
- Vite.
- Cairo or IBM Plex Sans Arabic.
- Inter for English.

Technical restrictions:

- Do NOT use React.
- Do NOT use Vue.
- Do NOT use Inertia.
- Do NOT build a real API.
- Do NOT connect to MySQL or another database.
- Do NOT require real authentication.
- Do NOT integrate a real payment gateway.
- Use centralized mock data.
- Use reusable Blade components.
- Use Laravel localization files.

If a Laravel project already exists, inspect it before modifying anything.

If the workspace is empty, initialize a new Laravel application.

Do not overwrite existing working files unnecessarily.

---

# 3. CRITICAL REQUIREMENT: HUMAN-CRAFTED DESIGN — NOT AI-GENERATED LOOK

THIS IS ONE OF THE HIGHEST PRIORITY REQUIREMENTS.

The dashboard must NOT look AI-generated.

It must NOT resemble a generic dashboard template, an automatically generated SaaS interface, or a collection of repetitive components.

Approach this as an experienced professional product design team.

## Strictly Avoid

- Generic SaaS dashboard templates.
- Repetitive identical card layouts.
- Excessive rounded corners.
- Random gradients.
- Excessive shadows.
- Neon effects.
- Decorative glowing elements.
- Random background shapes.
- Excessive icons inside colored circles.
- Unnecessary visual decorations.
- Huge typography without purpose.
- Repetitive charts.
- Fake activity feeds.
- Generic AI-style headings and descriptions.
- Lorem Ipsum.
- Empty placeholder pages.
- Identical page structures across different modules.
- Unnecessary animations.
- Overcrowded layouts.

Do not create a Dribbble-style concept that looks attractive in screenshots but is impractical to use.

## Professional Design Principles

Every page must have a clear purpose and its own appropriate structure.

Think about:

- What information matters most on this page?
- What actions will the user perform?
- Which information needs visual emphasis?
- How should information be grouped?
- What should be immediately visible?
- What can be hidden inside tabs or secondary sections?

Not every page needs statistics cards.

Not every page needs charts.

Some pages need professional tables, others need calendars, profiles, forms, financial reports, or visual galleries.

The result must feel like a real product built by a professional software company.

---

# 4. BRAND IDENTITY

Use the attached official EAGLE'S SC ACADEMY logo.

Official branding:

EAGLE'S SC ACADEMY
أكاديمية النسور لكرة القدم

Build the complete design system around the logo.

## Brand Colors

- Primary Red: #E3131B
- Deep Black: #111214
- White: #FFFFFF
- Soft Gray: #F3F4F6
- Dark Red: #8E1118

## Recommended Direction

Use a professional Light Dashboard:

- White main content area.
- Soft gray backgrounds.
- Deep black sidebar.
- Red primary actions.
- Carefully selected red highlights.
- Subtle borders.
- Balanced shadows.
- Strong typography.

The academy must have a recognizable visual identity.

Do not simply apply red and black colors to a generic template.

The eagle identity should be integrated naturally into the interface.

Use the actual provided logo. Never replace it with an AI-generated logo or a random eagle icon.

Store the logo at:

public/images/academy-logo.png

If the attached logo is accessible, use it directly. Otherwise, request the asset instead of creating a replacement.

---

# 5. BILINGUAL SYSTEM

The entire dashboard must support:

1. Arabic.
2. English.

Arabic must be the default language.

## Arabic Requirements

- Full RTL layout.
- Arabic labels.
- Arabic navigation.
- Arabic tables.
- Arabic forms.
- Arabic notifications.
- Arabic dates and currency formatting where appropriate.

## English Requirements

- Full LTR layout.
- Complete English translations.
- Proper English typography.

## Language Switching

Add a language switcher in the top navigation.

When switching:

- Update all interface text.
- Change HTML direction.
- Update sidebar alignment.
- Update table alignment.
- Update form layouts.
- Update navigation.
- Update modal positioning.
- Preserve the selected language across navigation using Laravel sessions.

Use:

lang/ar/
lang/en/

Do not implement partial translation.

The application must feel natively designed in both languages.

---

# 6. GLOBAL APPLICATION LAYOUT

Build a professional reusable dashboard layout.

## Sidebar

Include:

- Academy logo.
- Academy name.
- Navigation groups.
- Expandable submenus.
- Active page highlighting.
- Lucide icons.
- Collapse/expand functionality.
- Smooth but subtle transitions.

Organize navigation into meaningful groups.

## Topbar

Include:

- Sidebar toggle.
- Breadcrumbs.
- Global search.
- Language switcher.
- Notification center.
- User profile dropdown.
- Administrator information.

## Content Area

Every page should include:

- Clear page title.
- Short contextual description.
- Breadcrumbs.
- Primary actions.
- Appropriate filters.
- Professional content layout.

Use consistent design rules throughout the application.

---

# 7. MAIN DASHBOARD

Create a premium academy overview dashboard.

The first screen is extremely important because it will be the first thing the client sees.

Include the following KPIs:

- Total Players.
- Active Players.
- Total Coaches.
- Total Teams.
- Age Groups.
- Today's Attendance.
- Today's Absences.
- Active Subscriptions.
- Monthly Revenue.
- Monthly Expenses.

## Charts

- Monthly Revenue vs Expenses.
- Player Registration Growth.
- Attendance Statistics.
- Player Distribution by Age Group.
- Subscription Statistics.

## Additional Sections

- Upcoming Training Sessions.
- Upcoming Matches.
- Recent Player Registrations.
- Subscription Expiration Alerts.
- Outstanding Payments.
- Recent Academy Activities.
- Important Notifications.
- Upcoming Events.

Use meaningful data and avoid unnecessary visual clutter.

---

# 8. PLAYER MANAGEMENT

Create a comprehensive player management system.

Pages:

- Players List.
- Add Player.
- Edit Player.
- Player Profile.
- Goalkeepers.
- Player Files.
- Age Groups.
- Teams.
- First Team.
- Player Transfers.

## Player Information

- Full Name.
- Profile Photo.
- Date of Birth.
- Age.
- Nationality.
- Gender.
- Phone Number.
- Parent/Guardian Name.
- Parent/Guardian Phone.
- Address.
- Playing Position.
- Preferred Foot.
- Height.
- Weight.
- Current Team.
- Age Group.
- Registration Date.
- Subscription Status.
- Medical Notes (demo only).
- Player Status.

## Players Table

Include:

- Search.
- Filters.
- Sorting.
- Pagination.
- Player photos.
- Player status.
- Team.
- Age Group.
- Subscription status.
- Quick actions.

## Player Profile

Build a professional player dossier.

Include:

- Player profile header.
- Personal information.
- Parent information.
- Sports information.
- Team information.
- Subscription details.
- Attendance history.
- Performance statistics.
- Technical evaluations.
- Training history.
- Documents.
- Payment history.
- Transfer history.

Use organized tabs.

Player information must remain consistent across all modules.

---

# 9. COACHES MANAGEMENT

Pages:

- Coaches List.
- Add Coach.
- Coach Profile.
- Coach Details.
- Coaching Workshops.

Information:

- Name.
- Photo.
- Specialization.
- Phone.
- Email.
- Experience.
- Certifications.
- Assigned Teams.
- Training Schedule.
- Status.

Include professional coach profiles.

---

# 10. TRAINING MANAGEMENT

Pages:

- Training Programs.
- Private Training.
- Training Schedule.
- Attendance.
- Absence Management.
- Training Grounds.
- Performance Analysis.
- Technical Reports.
- Player Evaluations.

Include:

- Calendar View.
- List View.
- Training Session Details.
- Assigned Coach.
- Assigned Team.
- Training Ground.
- Date and Time.
- Attendance.
- Session Notes.

Make attendance management interactive and practical.

---

# 11. REGISTRATION AND SCOUTING

Pages:

- Player Registration.
- Registration Requests.
- Player Trials.
- Scouting.
- Talent Discovery.
- Project 500 Talents.

Include:

- Registration application management.
- Applicant profiles.
- Application statuses.
- Trial scheduling.
- Trial results.
- Technical evaluation.
- Accept/Reject actions.
- Scouting reports.
- Talent discovery records.

Build a professional application review workflow.

---

# 12. COMPETITIONS AND SPORTS ACTIVITIES

Pages:

- Championships.
- Leagues.
- Competitions.
- Sports Events.
- Matches.
- Training Camps.
- Recreational Trips.
- First Team.

Include:

- Competition Name.
- Type.
- Date.
- Location.
- Participating Teams.
- Match Results.
- Competition Status.
- Event Details.

Include calendar and table views where useful.

---

# 13. SUBSCRIPTION MANAGEMENT

This is an important module.

Pages:

- Subscription Plans.
- Packages.
- Player Subscriptions.
- Subscription Details.
- Renewals.
- Expired Subscriptions.
- Outstanding Subscriptions.

Subscription information:

- Player Name.
- Package.
- Subscription Start.
- Subscription End.
- Total Amount.
- Amount Paid.
- Remaining Balance.
- Payment Frequency.
- Subscription Status.

Include:

- New Subscription.
- Renew Subscription.
- View Subscription.
- Change Package.
- Track Expiration.
- Payment History.

Create clear indicators for active, expired, pending, and partially paid subscriptions.

---

# 14. PAYMENT MANAGEMENT SYSTEM — HIGH PRIORITY

Build a complete, professional payment management interface.

This is a core part of the client's requirements.

The system must demonstrate how the academy receives and manages payments from players and parents.

IMPORTANT:

This is a FRONTEND DEMO ONLY.

Do not connect to a real payment gateway or process actual financial transactions.

However, design the complete payment experience as if it were part of a production application.

The architecture and UI must be ready for future integration with a real payment provider.

## A. Payments Overview

Create a dedicated payments dashboard.

Display:

- Total Payments.
- Successful Payments.
- Pending Payments.
- Failed Payments.
- Total Collected Amount.
- Outstanding Amount.
- Refunds.
- Today's Transactions.

Include meaningful charts:

- Payment Trends.
- Successful vs Failed Transactions.
- Payment Methods Distribution.
- Monthly Collections.

## B. Transactions Management

Create a professional transactions table.

Columns:

- Transaction ID.
- Player Name.
- Parent Name.
- Subscription.
- Amount.
- Payment Method.
- Payment Date.
- Transaction Status.
- Actions.

Features:

- Search by player.
- Search by transaction ID.
- Filter by date.
- Filter by status.
- Filter by payment method.
- Sort.
- Pagination.
- Transaction details.

Statuses:

- Successful.
- Pending.
- Failed.
- Refunded.
- Partially Refunded.

## C. Payment Methods

Design a payment methods management page.

Include visual representations of:

- Cash.
- Bank Transfer.
- Credit/Debit Card.
- Online Payment.
- Mobile Wallet.

Show payment method status and configuration interface.

All configurations must be simulated.

Do not claim that any provider is connected.

## D. Online Payment Checkout Simulation

Build a realistic payment checkout experience.

The demo flow:

1. Select a player.
2. Select an outstanding subscription.
3. Display the amount due.
4. Select a payment method.
5. Review payment details.
6. Confirm demo payment.
7. Display a successful, pending, or failed result screen.
8. Generate a simulated transaction record.
9. Display a payment receipt.

Include:

- Payment Summary.
- Player Information.
- Subscription Information.
- Amount.
- Payment Method.
- Transaction Reference.
- Payment Status.

Never request or store real card information.

Use clearly marked demo payment methods and simulated transactions.

## E. Payment Receipts

Create a professional payment receipt page.

Include:

- Academy logo.
- Academy name.
- Receipt Number.
- Transaction ID.
- Player Name.
- Parent Name.
- Subscription.
- Payment Date.
- Payment Method.
- Amount Paid.
- Remaining Balance.
- Transaction Status.

Provide a printable receipt layout using browser print functionality.

## F. Refund Management

Include a refund management interface:

- Refund Requests.
- Refund Details.
- Refund Amount.
- Refund Reason.
- Refund Status.
- Approve/Reject simulation.

## G. Payment Notifications

Display demo notifications for:

- Successful Payment.
- Failed Payment.
- Pending Payment.
- Upcoming Subscription Payment.
- Overdue Payment.

## H. Payment Integration Readiness

Organize the interface and code so that a real payment gateway can be connected later.

Do not implement fake gateway API calls.

Do not invent successful external payment transactions.

Clearly distinguish simulated payments from real payments.

---

# 15. FINANCIAL MANAGEMENT

Pages:

- Financial Dashboard.
- Monthly Revenue.
- Annual Revenue.
- Monthly Expenses.
- Annual Expenses.
- Financial Transactions.
- Financial Reports.

Include:

- Total Revenue.
- Total Expenses.
- Net Balance.
- Outstanding Payments.
- Monthly Comparison.
- Annual Comparison.
- Revenue Categories.
- Expense Categories.

Provide filters for:

- Month.
- Year.
- Date Range.
- Transaction Type.

Use Egyptian Pound (EGP).

Create professional charts and financial tables.

All figures must be consistent with the mock transaction records.

---

# 16. SPORTSWEAR AND INVENTORY

Pages:

- Sportswear Catalog.
- Products.
- Sizes.
- Inventory.
- Stock Management.
- Player Distribution.
- Delivery Records.

Include:

- Product Images.
- Product Names.
- Sizes.
- Available Quantities.
- Stock Status.
- Distribution Records.

Use realistic inventory examples.

---

# 17. SPONSORS AND STRATEGIC PARTNERS

Pages:

- Sponsors.
- Strategic Partners.
- Add Sponsor.
- Sponsor Details.

Include:

- Company Name.
- Logo.
- Contact Information.
- Partnership Type.
- Contract Dates.
- Partnership Status.

Use professional sponsor cards.

---

# 18. ACADEMY CONTENT MANAGEMENT

Create a CMS-style management section.

Pages:

- About Us.
- Academy Vision.
- Academy Mission.
- Academy Goals.
- Project 500 Talents.
- First Team.
- Contact Information.
- Phone Numbers.
- Social Media Platforms.
- Academy Pages.
- Training Programs.
- Private Training.
- Academy Grounds.
- Rules and Regulations.
- Packages.
- Terms and Conditions.

Include structured editing interfaces.

Use rich text-style editing areas where appropriate.

---

# 19. MEDIA AND ACHIEVEMENTS

Pages:

- Photo Gallery.
- Video Gallery.
- Sports Achievements.
- Academy Events.
- Media Management.

Include:

- Image Previews.
- Video Thumbnails.
- Categories.
- Featured Media.
- Upload Interface.
- Delete Confirmation.

Use a professional gallery layout.

Upload functionality can be simulated.

---

# 20. REPORTS AND ANALYTICS

Pages:

- Players Reports.
- Attendance Reports.
- Coaches Reports.
- Financial Reports.
- Payment Reports.
- Performance Reports.
- Subscription Reports.
- Scouting Reports.
- Activity Logs.

Include:

- Date Filters.
- Search.
- Interactive Charts.
- Summary Statistics.
- Detailed Tables.
- Print-Friendly Reports.

---

# 21. USER MANAGEMENT AND PERMISSIONS

Create a demo user management system.

Roles:

- Super Admin.
- Academy Manager.
- Financial Manager.
- Coach.
- Registration Officer.

Pages:

- Users.
- Roles.
- Permissions.
- User Activity.

Include simulated role and permission editing.

---

# 22. COMPLAINTS AND SUGGESTIONS

Create a dedicated management module.

Include:

- Complaint List.
- Suggestion List.
- Submission Date.
- Player/Parent Name.
- Category.
- Description.
- Status.
- Assigned Administrator.
- Response.

Statuses:

- New.
- Under Review.
- In Progress.
- Resolved.
- Rejected.

Create detail views and response interfaces.

---

# 23. LOGIN PAGE

Create a premium login page.

Include:

- Academy Logo.
- Academy Name.
- Arabic and English Support.
- Email.
- Password.
- Show/Hide Password.
- Remember Me.
- Forgot Password.
- Login Button.

Design direction:

Use a professional sports-inspired composition.

Keep it elegant and minimal.

Simulate login without real authentication.

---

# 24. DEMO DATA REQUIREMENTS

Create centralized, realistic mock data.

Use Egyptian-style names.

Examples:

- محمد أحمد.
- عمر محمود.
- يوسف إبراهيم.
- أحمد مصطفى.
- محمود خالد.

Use realistic:

- Players.
- Coaches.
- Teams.
- Age Groups.
- Training Sessions.
- Payments.
- Subscriptions.
- Expenses.
- Revenue Records.
- Competitions.

Use EGP currency.

CRITICAL DATA CONSISTENCY:

The same player must have consistent information across:

- Players List.
- Player Profile.
- Attendance.
- Subscription.
- Payment History.
- Financial Reports.

Payment totals must match financial reports.

Subscription balances must match payment records.

Attendance statistics must match attendance records.

Avoid repetitive or random dummy information.

---

# 25. FRONTEND INTERACTIVITY

The prototype must be genuinely interactive.

Implement:

- Sidebar Navigation.
- Expandable Menus.
- Language Switching.
- RTL/LTR Switching.
- Search.
- Filters.
- Sorting.
- Pagination.
- Tabs.
- Dropdowns.
- Modals.
- Add/Edit Forms.
- Form Validation.
- Delete Confirmation.
- Toast Notifications.
- Date Filters.
- Interactive Charts.
- Player Profile Navigation.
- Attendance Actions.
- Subscription Actions.
- Payment Simulation.
- Refund Simulation.
- Printable Receipts.
- Responsive Mobile Navigation.

Use Alpine.js and browser-side state for simulated CRUD.

Data may reset after refresh.

Do not create buttons that do nothing.

If a feature requires a real backend, simulate its workflow clearly and honestly.

---

# 26. RESPONSIVE DESIGN

Support:

- Desktop.
- Laptop.
- Tablet.
- Mobile.

Desktop:

- Full sidebar.
- Spacious content.
- Professional multi-column layouts.

Tablet:

- Collapsible sidebar.
- Adaptive cards and tables.

Mobile:

- Off-canvas navigation.
- Stacked statistics.
- Scrollable tables.
- Touch-friendly controls.
- Responsive forms.
- Properly sized modals.

Do not simply shrink the desktop layout.

Design each breakpoint intentionally.

---

# 27. CODE ARCHITECTURE

Use organized Laravel Blade architecture.

Suggested structure:

resources/views/

layouts/
- admin.blade.php
- guest.blade.php
- partials/
  - sidebar.blade.php
  - topbar.blade.php
  - footer.blade.php

components/
- stat-card.blade.php
- data-table.blade.php
- status-badge.blade.php
- page-header.blade.php
- modal.blade.php
- dropdown.blade.php
- form-field.blade.php
- empty-state.blade.php

dashboard/
- index.blade.php

players/
- index.blade.php
- create.blade.php
- edit.blade.php
- show.blade.php

coaches/
goalkeepers/
age-groups/
teams/
training/
attendance/
registration/
scouting/
competitions/
subscriptions/
payments/
finance/
sportswear/
inventory/
sponsors/
partners/
media/
reports/
academy/
complaints/
users/
settings/
auth/

Organize routes with meaningful named routes.

Use controllers or dedicated demo-data providers to supply mock records.

Keep translation files organized.

Keep CSS and JavaScript modular.

Do not put the entire application into one Blade file.

Do not write duplicated code unnecessarily.

---

# 28. PERFORMANCE AND QUALITY

Ensure:

- Clean Laravel structure.
- Reusable components.
- Organized routes.
- No missing assets.
- No broken links.
- No JavaScript console errors.
- No Blade rendering errors.
- Proper Vite configuration.
- Proper chart rendering.
- Fast page navigation.
- Responsive tables.
- Consistent design tokens.

Avoid unnecessarily large dependencies.

---

# 29. IMPLEMENTATION WORKFLOW

Do not generate the entire project carelessly in one pass.

Work in controlled phases.

## Phase 1 — Foundation

- Inspect the project.
- Set up Laravel.
- Configure Tailwind and Vite.
- Add fonts and icons.
- Add the academy logo.
- Build the design system.
- Build the global layout.
- Implement localization.
- Implement sidebar and topbar.

## Phase 2 — Core Experience

Build and polish:

1. Login.
2. Main Dashboard.
3. Players List.
4. Player Profile.
5. Coaches.
6. Training.
7. Attendance.

Do not move forward until these screens have a consistent, polished visual quality.

## Phase 3 — Financial Experience

Build:

1. Subscriptions.
2. Payment Dashboard.
3. Transactions.
4. Payment Checkout Simulation.
5. Payment Receipts.
6. Refunds.
7. Financial Analytics.

Ensure all payment and financial demo data is consistent.

## Phase 4 — Remaining Modules

Build:

- Registration.
- Scouting.
- Competitions.
- Sportswear.
- Inventory.
- Sponsors.
- Strategic Partners.
- Academy CMS.
- Media.
- Reports.
- Complaints.
- User Management.

## Phase 5 — Design Review

Review every page.

Identify and redesign:

- Generic layouts.
- Repetitive components.
- Poor visual hierarchy.
- Unnecessary decorations.
- Inconsistent spacing.
- Weak typography.
- Broken Arabic RTL.
- Poor mobile layouts.

Do not accept mediocre pages just because the routes work.

## Phase 6 — Final QA

Test:

1. Laravel startup.
2. All routes.
3. All Blade templates.
4. Vite build.
5. Arabic RTL.
6. English LTR.
7. Navigation.
8. Forms.
9. Tables.
10. Modals.
11. Charts.
12. Payment simulations.
13. Printable receipts.
14. Mobile responsiveness.

---

# 30. FINAL ACCEPTANCE CRITERIA

The project is not complete unless:

- All major requested modules have actual interfaces.
- The main dashboard is polished.
- Player management is fully navigable.
- Player profiles are detailed.
- Payment management is implemented.
- Checkout simulation works.
- Receipts can be printed.
- Financial reports are consistent.
- Arabic and English both work.
- RTL and LTR both work.
- Sidebar navigation works.
- Main interactions work.
- The application is responsive.
- The academy identity is clear.
- The design does not look generic or AI-generated.

---

# FINAL DESIGN DIRECTIVE

Think of this project as a premium software product that a professional development company is presenting to an important client.

Do not prioritize the number of components or the speed of generating pages.

Prioritize:

- Design quality.
- Real-world usability.
- Visual consistency.
- Distinctive brand identity.
- Functional interactions.
- Thoughtful information architecture.
- Accurate and coherent demo data.
- Professional details.

The client should be able to explore the application and imagine using it in the daily operations of EAGLE'S SC ACADEMY.

The finished product must feel custom-designed, professionally engineered, and ready for a future production implementation.

**Do not stop at a visual mockup. Build the complete navigable multi-page Laravel Blade frontend prototype.**