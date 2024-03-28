<?php

use Modules\TomatoSupport\App\Transformers\FAQResource;
use Modules\TomatoSupport\App\Transformers\TicketsResource;
use Modules\TomatoSupport\App\Transformers\TicketResource;

return [
    /*
     * Add Actions Buttons to the Show Ticket Page with blade view
     */
    "actions" => null,

    /*
     * Show Create Button on Tickets Page
     */
    "show_create_ticket_button" => true,


    /*
     * Resources Classes
     */
    "resources" => [
        "tickets" => [
            "index" => TicketsResource::class,
            "show" => TicketResource::class
        ],
        "faq" => [
            "index" => FAQResource::class,
            "show" => FAQResource::class
        ]
    ],

    /*
     * Features
     */
    "features" => [
        "faq" => true,
        "tickets" => true,
        "apis" => true
    ]
];
