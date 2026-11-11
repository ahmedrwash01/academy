<?php

return [
    // Academy Identity
    'academy_name' => 'EAGLE\'S SC ACADEMY',
    'academy_slogan' => 'Developing Future Champions with Professional Standards',
    'short_name' => 'Eagles SC',
    'established' => 'Est. 2018',

    // Navigation & Groups
    'nav' => [
        'main_menu' => 'MAIN MENU',
        'sports_affairs' => 'SPORTS AFFAIRS',
        'financial_management' => 'SUBSCRIPTION & COLLECTION MONITORING',
        'operations' => 'OPERATIONS & LOGISTICS',
        'media_center' => 'MEDIA CENTER',
        'administration' => 'ADMINISTRATION',

        'dashboard' => 'Dashboard',
        'players' => 'Player Management',
        'all_players' => 'Players List',
        'add_player' => 'Add New Player',
        'goalkeepers' => 'Goalkeepers Academy',
        'player_files' => 'Player Files & Dossiers',
        'age_groups' => 'Age Groups',
        'teams' => 'Sports Teams',
        'transfers' => 'Player Transfers',

        'coaches' => 'Coach Management',
        'coaches_list' => 'Coaches List',
        'add_coach' => 'Add Coach',
        'coach_workshops' => 'Workshops & Courses',

        'training' => 'Training & Sessions',
        'training_programs' => 'Training Programs',
        'training_schedule' => 'Training Schedule',
        'attendance' => 'Attendance & Absence',
        'training_grounds' => 'Grounds & Facilities',
        'evaluations' => 'Technical Evaluations',

        'registration' => 'Registration & Scouting',
        'scouting' => 'Talent Discovery',
        'trials' => 'Player Trials',
        'project_500' => 'Project 500 Talents',

        'competitions' => 'Competitions & Matches',
        'tournaments' => 'Tournaments & Leagues',
        'matches' => 'Match Fixtures',
        'camps' => 'Training Camps',
        'first_team' => 'First Team',

        'subscriptions' => 'Subscription Tracking',
        'subscription_plans' => 'Subscription Packages',
        'active_subscriptions' => 'Active Subscriptions',
        'renewals' => 'Renewals & Tracking',
        'expired_subscriptions' => 'Expired Subscriptions',

        'payments' => 'Collection & Receipts',
        'payments_overview' => 'Collection Overview',
        'transactions' => 'Collection Log',
        'payment_checkout' => 'Dues Tracking',
        'payment_methods' => 'Accepted Channels',
        'receipts' => 'Payment Receipts',
        'refunds' => 'Refund Log',

        'finance' => 'Financial Management',
        'financial_dashboard' => 'Finance Dashboard',
        'revenues' => 'Revenues',
        'expenses' => 'Expenses',
        'financial_reports' => 'Financial Statements',

        'sportswear' => 'Sportswear & Kits',
        'inventory' => 'Inventory & Storage',
        'kit_distribution' => 'Kit Deliveries',

        'sponsors' => 'Sponsors & Partners',
        'partners' => 'Strategic Partnerships',

        'academy_content' => 'Academy Content (CMS)',
        'media' => 'Media & Gallery',
        'gallery' => 'Photo & Video Gallery',
        'achievements' => 'Honors & Trophies',

        'reports' => 'Reports & Analytics',
        'complaints' => 'Complaints & Suggestions',
        'users' => 'Users & Permissions',
        'settings' => 'System Settings',
    ],

    // Common Actions & Labels
    'actions' => [
        'view' => 'View',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'add' => 'Add',
        'save' => 'Save Changes',
        'cancel' => 'Cancel',
        'search' => 'Search...',
        'filter' => 'Filter',
        'export' => 'Export',
        'print' => 'Print',
        'print_receipt' => 'Print Receipt',
        'renew' => 'Renew',
        'pay_now' => 'View Dues',
        'confirm' => 'Confirm',
        'close' => 'Close',
        'back' => 'Back',
        'simulate_payment' => 'Collection Tracking',
        'download_pdf' => 'Download PDF',
        'mark_present' => 'Mark Present',
        'mark_absent' => 'Mark Absent',
        'approve' => 'Approve',
        'reject' => 'Reject',
        'refresh' => 'Refresh',
        'details' => 'Details',
    ],

    // Statuses
    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'pending' => 'Pending',
        'expired' => 'Expired',
        'paid' => 'Fully Paid',
        'partial' => 'Partially Paid',
        'unpaid' => 'Unpaid',
        'completed' => 'Completed',
        'successful' => 'Successful',
        'failed' => 'Failed',
        'refunded' => 'Refunded',
        'present' => 'Present',
        'absent' => 'Absent',
        'excused' => 'Excused',
        'late' => 'Late',
        'under_review' => 'Under Review',
        'accepted' => 'Accepted',
        'rejected' => 'Rejected',
    ],

    // Currency & Units
    'currency' => 'EGP',
    'egp' => 'Egyptian Pound',

    // Dashboard metrics
    'kpi' => [
        'total_players' => 'Total Players',
        'active_players' => 'Active Players',
        'coaches' => 'Technical Staff & Coaches',
        'teams' => 'Teams & Squads',
        'today_attendance' => 'Today Attendance',
        'today_absence' => 'Today Absence',
        'active_subscriptions' => 'Active Subscriptions',
        'monthly_revenue' => 'Monthly Revenue',
        'monthly_expenses' => 'Monthly Expenses',
        'net_income' => 'Net Income',
        'collection_rate' => 'Collection Rate',
        'upcoming_matches' => 'Upcoming Matches',
        'upcoming_sessions' => 'Today\'s Training Sessions',
    ],

    // Payment & Checkout
    'payment' => [
        'checkout_title' => 'Academy Payment Checkout (Demo)',
        'checkout_desc' => 'High-security payment processing simulation for monthly dues and subscriptions',
        'select_player' => 'Select Player',
        'select_subscription' => 'Package / Fee Item',
        'amount_to_pay' => 'Amount Due',
        'payment_method' => 'Payment Method',
        'methods' => [
            'card' => 'Debit / Credit Card (Visa / Meeza)',
            'vodafone_cash' => 'Mobile Wallet (Vodafone Cash / InstaPay)',
            'bank_transfer' => 'Direct Bank Transfer',
            'cash' => 'Cash at Academy Desk',
            'pos' => 'POS Terminal Machine',
        ],
        'card_holder' => 'Cardholder Name',
        'card_number' => 'Card Number (Demo)',
        'expiry_date' => 'Expiry Date',
        'cvv' => 'Security Code (CVV)',
        'demo_notice' => 'This is a simulation sandbox — no actual monetary transactions occur.',
        'transaction_id' => 'Reference Transaction ID',
        'receipt_number' => 'Receipt Number',
        'payment_success' => 'Payment Processed Successfully!',
        'payment_success_desc' => 'Transaction has been logged, the player subscription updated immediately, and an official receipt generated.',
    ],

    // Dashboard
    'dashboard' => [
        'welcome_title' => 'Operations Dashboard',
        'welcome_desc' => 'Centralized oversight of sports operations, field discipline, and financial indicators',
        'season' => 'Sports Season 2025 / 2026',
    ],

    // Topbar & User
    'topbar' => [
        'search_placeholder' => 'Search players, coaches, transactions, or teams...',
        'admin_role' => 'Academy General Director',
        'admin_name' => 'Capt. Mahmoud El-Hawary',
        'notifications' => 'Notifications',
        'no_notifications' => 'No new notifications',
        'view_all_notifications' => 'View All Notifications',
        'profile' => 'Profile',
        'settings' => 'Settings',
        'logout' => 'Log Out',
        'switch_language' => 'العربية',
    ],

    // Footer
    'footer' => [
        'rights' => 'All Rights Reserved © ' . date('Y') . ' EAGLE\'S SC ACADEMY',
        'version' => 'Official Enterprise Prototype v2.4',
    ],
];

