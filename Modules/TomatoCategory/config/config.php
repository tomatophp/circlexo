<?php

return [
    "for" => [
        "accounts"=> [
            "ar" => "الحسابات",
            "en" => "Accounts"
        ],
        "content"=> [
            "ar" => "المحتوي",
            "en" => "Content"
        ]
    ],
    "types" => [
        "type"=> [
            "ar" => "النوع",
            "en" => "Type"
        ],
        "status"=> [
            "ar" => "الحالة",
            "en" => "Status"
        ],
    ],
    "features" => [
        "category" => true,
        "types" => true
    ],

    "middleware" => ['auth:sanctum'],
    "categories_resource" => null,
    "types_resource" => null,
];
