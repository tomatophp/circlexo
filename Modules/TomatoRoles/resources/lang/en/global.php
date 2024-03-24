<?php

return [
    "menu" => [
        "group" => "ALC",
        "users" => "Users",
        "roles" => "Roles"
    ],
    "roles" => [
        "index" => "Roles",
        "single" => "Role",
        "id" => "ID",
        "name" => "Name",
        "guard_name" => "Guard Name",
        "permissions" => "Permissions",
        "actions" => "Actions",
        "messages" => [
            "created" => "Role Has Been Created",
            "updated" => "Role Has Been Updated",
            "deleted" => "Role Has Been Deleted"
        ],
        "selectAll" => "Select All",
        "enable" => "Enabled",
        "enableAll" => "Enable all Permissions currently",
        "forRole" => "for this role",
    ],
    "users" => [
        "index" => "Users",
        "single" => "User",
        "id" => "ID",
        "name" => "Name",
        "email" => "Email",
        "password" => "Password",
        "password_confirmation" => "Password Confirmation",
        "roles" => "Roles",
        "actions" => "Actions",
        "messages" => [
            "created" => "User Has Been Created",
            "updated" => "User Has Been Updated",
            "deleted" => "User Has Been Deleted"
        ],
        "filters"=> [
            "roles" => "Filter By Role"
        ]
    ]
];
