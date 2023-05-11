<?php

use App\Enums\UserRoleEnum;
use App\Enums\WishCategoryEnum;

return [
    'fields' => [
        'title' => 'Title (:LOCALE)',
        'name' => 'Name (:LOCALE)',
        'content' => 'Content (:LOCALE)',
        'visible' => 'Visible',
    ],

    'wishes' => [
        WishCategoryEnum::Additional->value => 'Additional',
        WishCategoryEnum::Common->value => 'Common',
    ],

    'users' => [
        'roles' => [
            UserRoleEnum::Administrator->value => 'Administrator',
            UserRoleEnum::Customer->value => 'Customer',
        ],
    ],
];
