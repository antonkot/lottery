<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,

    /*===================
    Lottery common params
    ===================*/

    // Probabilities, in percent
    'probability' => [
        'win' => 20, // 1 of 5 wins
        'money' => 10, // 1 of 10 winners gets money
        'thing' => 10, // 1 of 10 winners gets random thing
        // other 8 of 10 winners get loyalty points
    ],

    // Winning ranges
    'range' => [
        'money' => [
            'from' => 10,
            'to' => 100
        ],
        'loyalty_points' => [
            'from' => 1,
            'to' => 10
        ]
    ],

    // Conversion coefficient
    'coef_money_2_LP' => 0.1 // 10 money equals 1 LP
];
