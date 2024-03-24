<?php

return [
    /*
    * Features of Tomato CRM
    *
    * accounts: Enable/Disable Accounts Feature
    */
    "features" => [
        "accounts" => true,
        "groups" => true,
        "locations" => true,
        "contacts" => true,
        "requests" => true,
        "notifications" => true,
        "apis" => true,
        "send_otp" => true
    ],

    /*
     * Accounts Configurations
     *
     * resource: User Resource Class
     */
    "resource" => null,

    /*
     * Accounts Configurations
     *
     * login_by: Login By Phone or Email
     */
    "login_by" => "email",

    /*
     * Accounts Configurations
     *
     * required_otp: Enable/Disable OTP Verification
     */
    "required_otp" => true,

    /*
     * Accounts Configurations
     *
     * model: User Model Class
     */
    "model" => \Modules\TomatoCrm\App\Models\Account::class,

    /*
     * Accounts Configurations
     *
     * guard: Auth Guard
     */
    "guard" => "accounts",

    /*
     * Attachments Configurations
     *
     * You Can Add More Actions And Buttons To Accounts View
     */
    "views" => [
        "accounts" => [
            "buttons" => null,
            "actions" => null
        ]
    ],

    /*
     * Attachment Relations
     *
     * You can use this config to attach relation manager to the view accounts
     *
     * Example:
     *
     [
         "name" => "groups",
         "label" => [
           "ar" => "Group",
           "en" => "Group"
         ],
         "table" => \Modules\TomatoCrm\App\Tables\GroupTable::class,
         "view" => "tomato-crm::components.relations",
         "show" => true,
         "edit" => true,
         "delete" => true,
         "path" => "groups"
     ]
     */
    "relations" => []
];
