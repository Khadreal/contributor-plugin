<?php
return [
    'testShouldSaveValidContributorsData' => [
        'config' => [
            'contributor_count' => 2,
            'valid_nonce' => true,
            'user_role' => 'administrator',
        ],
        'expected' => [
            'should_save' => true,
            'saved_count' => null,
        ]
    ]
];