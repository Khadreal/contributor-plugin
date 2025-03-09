<?php
return [
    'testShouldSaveValidContributorsData' => [
        'config' => [
            'contributors' =>  [ 1, 2, 3 ],
            'nonce' => true,
            'nonce_value' => 'rt_save_contributors',
            'current_user' => true,
            'post'  => 20
        ],
        'expected' => true
    ],
    'testEditorShouldSaveValidContributorsData' => [
        'config' => [
            'contributors' =>  [ 1, 2, 3 ],
            'nonce' => true,
            'nonce_value' => 'rt_save_contributors',
            'current_user' => true,
            'post'  => 201
        ],
        'expected' => true
    ],
    'testShouldNotSaveWhenInvalidNonce' => [
        'config' => [
            'contributors' => [ 100 ],
            'nonce' => false,
            'nonce_value' => 'invalid_nonce',
            'current_user' => true,
            'post'  => 100
        ],
        'expected' => false
    ],
    'testShouldNotSaveWhenUserDoesNotHavePermission' => [
        'config' => [
            'contributors' => [ 100 ],
            'nonce' => true,
            'nonce_value' => 'rt_save_contributors',
            'current_user' => false,
            'post'  => 20
        ],
        'expected' => false
    ],
    'testShouldNotSaveWhenNoContributorIsSelected' => [
        'config' => [
            'contributors' => [],
            'nonce' => true,
            'nonce_value' => 'rt_save_contributors',
            'current_user' => true,
            'post'  => 20
        ],
        'expected' => true
    ],
];