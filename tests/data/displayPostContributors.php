<?php

$users = [
    [
        'name' => 'User 1',
        'url' => 'https://example.com/author/1',
        'avatar' => "<img src='avatar_1.png' width='32' />"
    ],
    [
        'name' => 'User 2',
        'url' => 'https://example.com/author/2',
        'avatar' => "<img src='avatar_2.png' width='32' />"
    ],
    [
        'name' => 'User 3',
        'url' => 'https://example.com/author/3',
        'avatar' => "<img src='avatar_3.png' width='32' />"
    ]
];
return [
    'testShouldReturnContentIfNoContributors' => [
        'config' => [
            'is_single' => true,
            'post_id' => 100,
            'contributors' => [],
            'content' => 'This is post content, random description',
            'args' => []
        ],
        'expected' => false
    ],
    'testShouldReturnContentIfNotSinglePost' => [
        'config' => [
            'is_single' => false,
            'post_id' => 100,
            'contributors' => [1, 2, 3],
            'content' => 'This is post content, random description',
            'args' => []
        ],
        'expected' => false
    ],
    'testShouldReturnModifiedContentWithContributors' => [
        'config' => [
            'is_single' => true,
            'post_id' => 100,
            'contributors' => [1, 2, 3],
            'content' => 'This is post content, random description',
            'modified_content' => 'This is post content, random description<div>Contributors Box</div>',
            'args' => [
                'contributors' => $users
            ]
        ],
        'expected' => true
    ]
];