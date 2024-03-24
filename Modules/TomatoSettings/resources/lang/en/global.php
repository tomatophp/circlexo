<?php

return [
    "group" => "Settings",
    "message" => [
        "success" => "Settings Has Been Saved"
    ],
    "email" => [
        "title" => "Email Settings",
        "sections" => [
            "smtp" => [
                "title" => "SMTP Server",
                "description" => "Connect your SMTP email server",
                "mail_mailer" => "Mailer",
                "mail_host" => "Host",
                "mail_port" => "Port",
                "mail_username" => "Username",
                "mail_password" => "Password",
                "mail_encryption" => "Encryption",
                "mail_from_address" => "From Address",
                "mail_from_name" => "From Name",
            ]
        ]
    ],
    "services" => [
        "title" => "Link Services",
        "sections" => [
            "sms" => [
                "title" => "Link SMS Gate",
                "description" => "Set SMS provider and main one",
                "sms_active" => "SMS Enabled",
                "sms_vendors" => "SMS Vendors",
                "vendor" => "Vendor",
                "api_key" => "API Key",
                "secret_key" => "Secret Key",
                "email" => "Email",
                "sms_gate" => "Main SMS Gate",
            ],
            "shipping" => [
                "title" => "Shipping Settings",
                "description" => "Set Shipping Gate provider and main one",
                "shipping_active" => "Shipping Enabled",
                "shipping_vendors" => "Shipping Vendors",
                "vendor" => "Vendor",
                "api_key" => "API Key",
                "secret_key" => "Secret Key",
                "email" => "Email",
                "shipping_gate" => "Main Shipping Gate",
            ],
            "facebook" => [
                "title" => "Facebook Settings",
                "description" => "Facebook SDK Settings",
                "facebook_pixcel" => "Facebook Pixel",
                "facebook_chat" => "Facebook Chat",
                "facebook_app" => "Facebook App",
            ],
            "addthis" => [
                "title" => "AddThis Settings",
                "description" => "AddThis SDK Settings",
                "addthis_key" => "AddThis Key",
            ]
        ]
    ],
    "site" => [
        "title" => "Site Settings",
        "sections" => [
            "seo" => [
                "title" => "Site SEO",
                "description" => "About your site seo meta tags",
                "site_name" => "Site Name",
                "site_author" => "Site Author",
                "site_description" => "Site Description",
                "site_keywords" => "Site Keywords"
            ],
            "media" => [
                "title" => "Site SEO Images",
                "description" => "Site Image and profile image",
                "site_profile" => "Site Profile",
                "site_logo" => "Site Logo",
            ],
            "contact" => [
                "title" => "Site Contact Info",
                "description" => "Contact From settings",
                "site_address" => "Site Address",
                "site_email" => "Site Email",
                "site_phone" => "Site Phone",
            ],
            "location" => [
                "title" => "Site Location",
                "description" => "Location of site and language",
                "site_phone_code" => "Site Phone Code",
                "site_location" => "Site Location",
                "site_currency" => "Site Currency",
                "site_language" => "Site Language",
            ],
            "interface" => [
                "title" => "Site Interface",
                "description" => "site menus and social media links",
                "site_social" => "Site Social",
                "site_social_network" => "Network",
                "site_social_url" => "URL",
                "site_menu" => "Site Menu",
                "site_menu_label" => "Label",
                "site_menu_icon" => "Icon",
                "site_menu_url" => "URL",
                "site_menu_route" => "Route",
                "site_menu_target" => "Target",
            ]
        ]
    ],
    "payments" => [
        "title" => "Payments Settings",
        "sections" => [
            "gate" => [
                "title" => "Payment Gates",
                "description" => "Settings of payment gates inside your app",
                "payment_online" => "Payment Online",
                "payment_vendors" => "Payment Vendors",
                "vendor" => "Vendor",
                "api_key" => "API Key",
                "secret_key" => "Secret Key",
                "email" => "Email",
                "payment_gate" => "Main Payment Gate",
            ]
        ]
    ],
    "google" => [
        "title" => "Google Settings",
        "sections" => [
            "google_api" => [
                "title" => "Google API",
                "description" => "Main API Key for google",
                "google_api_key" => "Google API Key",
            ],
            "firebase" => [
                "title" => "Firebase",
                "description" => "Firebase settings and APIs",
                "google_firebase_cr" => "Firebase Auth JSON",
                "google_firebase_database_url" => "Firebase Realtime Database URL",
                "google_firebase_vapid" => "Firebase VapID Cloud Messages",
            ],
            "recap" => [
                "title" => "Google ReCap",
                "description" => "Google ReCap settings and APIs",
                "google_recaptcha_key" => "Recaptcha Key",
                "google_recaptcha_secret" => "Recaptcha Secret",
            ]
        ]
    ]
];
