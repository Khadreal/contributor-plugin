<?php
return [
    'testShouldSaveValidContributorsData' => [
        'config' => [
            'contributor_count' => 2,
            'valid_nonce' => true,
            'user_role' => 'administrator',
            'post'  => [
                'post_title' => 'Test Post',
                'post_status' => 'publish'
            ]
        ],
        'expected' => [
            'should_save' => true,
            'saved_count' => 2,
        ]
    ],
    'testEditorShouldSaveValidContributorsData' => [
        'config' => [
            'contributor_count' => 3,
            'valid_nonce' => true,
            'user_role' => 'editor',
            'post'  => [
                'post_title' => 'Test Post',
                'post_status' => 'publish'
            ]
        ],
        'expected' => [
            'should_save' => true,
            'saved_count' => 3,
        ]
    ],
    'testShouldNotSaveWhenInvalidNonce' => [
        'config' => [
            'contributor_count' => 1,
            'valid_nonce' => false,
            'user_role' => 'administrator',
            'post'  => [
                'post_title' => 'Another Post',
                'post_status' => 'publish'
            ]
        ],
        'expected' => [
            'should_save' => false,
            'saved_count' => 0,
        ]
    ],
];