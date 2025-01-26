<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

return [
    'default' => env('MAIL_MAILER', 'mail'),
    'is_show_external_exceptions' => env('MAIL_SHOW_EXTERNAL_EXCEPTIONS', false),
    // CHARSET_ASCII, CHARSET_ISO88591, CHARSET_UTF8 are supported
    'charset' => env('MAIL_CHARSET', PHPMailer::CHARSET_UTF8),
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', '127.0.0.1'),
            // Set the SMTP port number - likely to be 25, 465 or 587
            'port' => env('MAIL_PORT', 25),
            // ENCRYPTION_STARTTLS, ENCRYPTION_SMTPS are supported
            'encryption' => env('MAIL_ENCRYPTION', PHPMailer::ENCRYPTION_STARTTLS),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            // DEBUG_OFF, DEBUG_CLIENT, DEBUG_SERVER, DEBUG_CONNECTION, DEBUG_LOWLEVEL are supported
            'debug' => env('MAIL_SMTP_DEBUG', SMTP::DEBUG_OFF)
        ],
        'sendmail' => [
            'transport' => 'sendmail',
        ],
        'mail' => [
            'transport' => 'mail',
        ],
        'qmail' => [
            'transport' => 'qmail',
        ]
    ],
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ]
];