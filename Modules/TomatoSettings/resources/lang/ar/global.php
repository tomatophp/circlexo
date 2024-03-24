<?php

return [
    "group" => "الإعدادات",
    "message" => [
        "success" => "تم حفظ الإعدادات بنجاح"
    ],
    "email" => [
        "title" => "إعدادات البريد الإلكتروني",
        "sections" => [
            "smtp" => [
                "title" => "سيرفر SMTP",
                "description" => "قم بربط سيرفر SMTP الخاص بك",
                "mail_mailer" => "المرسل",
                "mail_host" => "الخادم",
                "mail_port" => "المنفذ",
                "mail_username" => "اسم المستخدم",
                "mail_password" => "كلمة المرور",
                "mail_encryption" => "التشفير",
                "mail_from_address" => "إرسال من البريد",
                "mail_from_name" => "إرسال من الاسم",
            ]
        ]
    ],
    "services" => [
        "title" => "ربط الخدمات",
        "sections" => [
            "sms" => [
                "title" => "ربط بوابة الرسائل الهاتفية",
                "description" => "قم بربط واحد او اكثر من بوابات الرسائل الهاتفية",
                "sms_active" => "تفعيل بوابة الرسائل الهاتفية",
                "sms_vendors" => "مزود الرسائل الهاتفية",
                "vendor" => "المزود",
                "api_key" => "مفتاح API",
                "secret_key" => "المفتاح السري",
                "email" => "البريد الإلكتروني",
                "sms_gate" => "بوابة الرسائل الهاتفية الرئيسية",
            ],
            "shipping" => [
                "title" => "ربط بوابة الشحن",
                "description" => "قم بربط بوابة شحن او اكثر",
                "shipping_active" => "تفعيل بوابة الشحن",
                "shipping_vendors" => "مزود خدمة الشحن",
                "vendor" => "المزود",
                "api_key" => "مفتاح API",
                "secret_key" => "المفتاح السري",
                "email" => "البريد الإلكتروني",
                "shipping_gate" => "بوابة الشحن الرئيسية",
            ],
            "facebook" => [
                "title" => "ربط فيس بوك",
                "description" => "الإعدادات اللازمة لربط خدمات الفيس بوك بموقعك",
                "facebook_pixcel" => "فيس بوك بكسيل",
                "facebook_chat" => "فيس بوك شات",
                "facebook_app" => "تطبيق فيس بوك",
            ],
            "addthis" => [
                "title" => "ربط خدمة AddThis",
                "description" => "الإعدادات الخاصة بربط خدمة AddThis",
                "addthis_key" => "المفتاح الخاص ب AddThis",
            ]
        ]
    ],
    "site" => [
        "title" => "إعدادات الموقع",
        "sections" => [
            "seo" => [
                "title" => "إعدادات السيو",
                "description" => "كل ما يخص السيو واسم الموقع ووصفه",
                "site_name" => "اسم الموقع",
                "site_author" => "اسم المالك",
                "site_description" => "وصف الموقع",
                "site_keywords" => "الكلمات الدلالية"
            ],
            "media" => [
                "title" => "صور الموقع",
                "description" => "الصور الخاصة بالموقع مثل الشعار والصورة الرئيسية",
                "site_profile" => "الصورة الرئيسية",
                "site_logo" => "شعار الموقع",
            ],
            "contact" => [
                "title" => "معلومات الاتصال بالموقع",
                "description" => "بيانات اتصل بنا الخاصة بموقعك",
                "site_address" => "عنوان الموقع",
                "site_email" => "البريد الإلكتروني الخاص بالموقع",
                "site_phone" => "الهاتف الخاص بالموقع",
            ],
            "location" => [
                "title" => "إعدادات الموقع الجغرافي",
                "description" => "تحديد المميزات الجغرافية للموقع الحالي الخاص بك",
                "site_phone_code" => "كود الهاتف الخاص بالدولة",
                "site_currency" => "العملة",
                "site_location" => "الموقع الجغرافي الرئيسي لك",
                "site_language" => "اللغة الرئيسية للموقع",
            ],
            "interface" => [
                "title" => "إعدادات الوجهة",
                "description" => "الإعدادات الخاصة بمواقع التواصل الاجتماعي والقوائم",
                "site_social" => "موقع التواصل الاجتماعي",
                "site_social_network" => "اسم الشبكة بالانجليزية",
                "site_social_url" => "الرابط",
                "site_menu" => "القوائم",
                "site_menu_label" => "العنوان",
                "site_menu_icon" => "الايقونة",
                "site_menu_url" => "الرابط",
                "site_menu_route" => "الروت",
                "site_menu_target" => "تفتح في",
            ]
        ]
    ],
    "payments" => [
        "title" => "إعدادات بوابة الدفع",
        "sections" => [
            "gate" => [
                "title" => "ربط بوابات الدفع",
                "description" => "الإعدادات الخاصة بربط بوابات الدفع المختلفة بموقعك",
                "payment_online" => "تفعيل الدفع الإلكتروني؟",
                "payment_vendors" => "مزود بوابة الدفع",
                "vendor" => "المزود",
                "api_key" => "مفتاح API",
                "secret_key" => "المفتاح السري",
                "email" => "البريد الإلكتروني",
                "payment_gate" => "بوابة الدفع الرئيسية",
            ]
        ]
    ],
    "google" => [
        "title" => "إعدادات جوجل",
        "sections" => [
            "google_api" => [
                "title" => "ربط خدمات جوجل",
                "description" => "مفتاح تطبيق جوجل الاساسي API",
                "google_api_key" => "مفتاح API",
            ],
            "firebase" => [
                "title" => "فاير بيز",
                "description" => "ربط خدمات فاير بيز المختلفة",
                "google_firebase_cr" => "ملف الدخول JSON",
                "google_firebase_database_url" => "رابط قاعدة بيانات الوقت الحقيقي",
                "google_firebase_vapid" => "مفتاح رسائل فاير بيز للوقت الحقيقي VapID",
            ],
            "recap" => [
                "title" => "إعدادات تحقق جوجل",
                "description" => "رابط ادوات تحقق جوجل بانك لست روبوت",
                "google_recaptcha_key" => "المفتاح",
                "google_recaptcha_secret" => "الرمز السري",
            ]
        ]
    ]
];
