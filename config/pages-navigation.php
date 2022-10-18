<?php
return [
    [
        'name' => 'HOME',
        'description' => 'Promote your affiliate program and get quick support',
        'items' => [
            [
                'name' => 'Get registration link',
                'text' => 'Promote your registration form to potential affiliates ',
                'button_text' => 'Get link',
                'button_link' => '/admin/dashboard?focusing-element=copy-register-link&utm_source=button&utm_medium=get-registration-link&utm_campaign=quick-embed#promote-registation-section'
            ],
            [
                'name' => 'Get support',
                'text' => 'Reach out to support team if you need assistance',
                'button_text' => 'Get support',
                'button_link' => '/admin/dashboard?focusing-element=chat-with-support&utm_source=button&utm_medium=get-suppport&utm_campaign=quick-embed#get-support-section'
            ]
        ]
    ],
    [
        'name' => 'MANAGEMENT',
        'description' => 'Manage your affiliate campaign with basic functions',
        'items' => [
            [
                'name' => 'Manage programs',
                'text' => 'Set up commission rule and tax exclusion',
                'button_text' => 'Manage now',
                'button_link' => '/admin/programs?utm_source=button&utm_medium=programs&utm_campaign=quick-embed'
            ],
            [
                'name' => 'Review affiliates',
                'text' => 'Review affiliate profiles and activate their accounts',
                'button_text' => 'Review now',
                'button_link' => '/admin/affiliates?utm_source=button&utm_medium=affiliates&utm_campaign=quick-embed'
            ],
            [
                'name' => 'Manage referrals',
                'text' => 'View referrals details and approve/deny them',
                'button_text' => 'Manage now',
                'button_link' => '/admin/conversions?utm_source=button&utm_medium=referrals&utm_campaign=quick-embed'
            ],
            [
                'name' => 'Process payments',
                'text' => 'Pay commissions to your affiliates',
                'button_text' => 'Manage now',
                'button_link' => '/admin/payments?utm_source=button&utm_medium=payments&utm_campaign=quick-embed'
            ],
            [
                'name' => 'View analytics',
                'text' => 'Assess the performance of your affiliates',
                'button_text' => 'View now',
                'button_link' => '/admin/analytics?utm_source=button&utm_medium=analytics&utm_campaign=quick-embed'
            ]
        ]
    ],
    [
        'name' => 'GROWTH',
        'description' => 'Expand your affiliate network and communicate with affiliates',
        'items' => [
            [
                'name' => 'Assign coupons',
                'text' => 'Create coupons for affiliates to promote',
                'button_text' => 'Create now',
                'button_link' => '/admin/coupons?utm_source=button&utm_medium=coupons&utm_campaign=quick-embed'
            ],
            [
                'name' => 'Recruit affiliates',
                'text' => 'List offer publicly and convert customers to affiliates',
                'button_text' => 'Check now',
                'button_link' => '/admin/marketplace?utm_source=button&utm_medium=marketplace-listings&utm_campaign=quick-embed'
            ],
            [
                'name' => 'Communicate with affiliates',
                'text' => 'Get in touch with affiliates via emails and chat',
                'button_text' => 'Check now',
                'button_link' => '/admin/chat?utm_source=button&utm_medium=chat&utm_campaign=quick-embed'
            ],
        ]
    ],
    [
        'name' => 'SETTINGS',
        'description' => 'Set up advanced settings for campaign and affiliate accounts',
        'items' => [
            [
                'name' => 'Check settings',
                'text' => 'Customize your program with essential settings',
                'button_text' => 'Check now',
                'button_link' => '/admin/settings/brand?utm_source=button&utm_medium=settings&utm_campaign=quick-embed'
            ],
            [
                'name' => 'Pricing',
                'text' => 'Upgrade plan to set up advanced features',
                'button_text' => 'Upgrade now',
                'button_link' => '/admin/pricing?up=/admin/settings/brand&utm_source=button&utm_medium=pricing&utm_campaign=quick-embed'
            ]
        ]
    ]
];