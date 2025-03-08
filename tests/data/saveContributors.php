<?php
return [
    'testShouldSaveValidContributorsData' => [
        'config' => [
            'contributor_count' => 2,
            'nonce' => 'rt_save_contributors',
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
            'nonce' => 'rt_save_contributors',
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
            'nonce' => 'invalid_nonce',
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
    'testShouldNotSaveWhenUserDoesNotHavePermission' => [
        'config' => [
            'contributor_count' => 1,
            'nonce' => 'rt_save_contributors',
            'user_role' => 'subscriber',
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
    'testShouldNotSaveWhenNoContributorIsSelected' => [
        'config' => [
            'contributor_count' => 0,
            'nonce' => 'rt_save_contributors',
            'user_role' => 'administrator',
            'post'  => [
                'post_title' => 'Another Post',
                'post_status' => 'publish'
            ]
        ],
        'expected' => [
            'should_save' => true,
            'saved_count' => 0,
        ]
    ],
];