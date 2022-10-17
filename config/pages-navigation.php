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
                'button_link' => '/admin?utm_source=embedded_app'
            ],
            [
                'name' => 'Get support',
                'text' => 'Reach out to support team if you need assistance',
                'button_text' => 'Get support',
                'button_link' => '/admin?utm_source=embedded_app'
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
                'button_link' => '/admin/program'
            ],
            [
                'name' => 'Review affiliates',
                'text' => 'Review affiliate profiles and activate their accounts',
                'button_text' => 'Review now',
                'button_link' => '/admin/affiliates'
            ],
            [
                'name' => 'Manage referrals',
                'text' => 'View referrals details and approve/deny them',
                'button_text' => 'Manage now',
                'button_link' => '/admin/conversions'
            ]
        ]
    ],

];