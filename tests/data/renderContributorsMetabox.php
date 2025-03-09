<?php
$users = [
    (object) [ 'ID' => 1, 'display_name' => 'Olayiwola', 'roles' => ['administrator'] ],
    (object) [ 'ID' => 2, 'display_name' => 'Thomas', 'roles' => ['editor'] ],
    (object) [ 'ID' => 3, 'display_name' => 'Samir', 'roles' => ['author'] ],
];

return [
    'testShouldRenderContributorMetaBox' => [
        'config' => [
            'users' => $users,
            'post' => (object) [
                'ID' => 123,
            ],
            'selected_contributors' => [ 1, 3 ]
        ],
        'expected' => [
            'users' => $users,
            'selected_contributors' => [ 1, 3 ]
        ]
    ],
    'testShouldRenderContributorMetaBoxWithEmptyContributors' => [
        'config' => [
            'users' => $users,
            'post' => (object) [
                'ID' => 123,
            ],
            'selected_contributors' => []
        ],
        'expected' => [
            'users' => $users,
            'selected_contributors' => []
        ]
    ]
];