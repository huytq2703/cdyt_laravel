<?php

return [
    'pagination' => [
        'pageSize' => '10',
    ],
    'roles' => [
        'SUPER_ADMIN',
        'ADMIN',
        'REGISTERED',
        'STUDENTS',
        'LECTURERS',
        'POST_WRITER',
        'POST_MANAGER'
    ],
    'permissions' => [
        'post_manage' => [
            'SUPER_ADMIN',
            'ADMIN',
            'POST_WRITER',
            'POST_MANAGER'
        ]

        ],
    'menu' => [
        'web' => [

        ],
        'admin' => [
            'SUPER_ADMIN' => [
                [
                    "name" => 'Sinh viên',
                    "child" => [
                        ['name' => 'Tra cứu điểm', 'route' => ''],
                        ['name' => 'Tra cứu lịch học', 'route' => ''],
                        ['name' => 'Tài liệu học tập', 'route' => ''],
                        ['name' => 'Thư viện bài giảng', 'route' => '']
                    ]
                ],
                [
                    "name" => "Đào tạo",
                    "child" => [
                        ['name' => 'Chương trình đào tạo', 'route' => ''],
                        ['name' => 'Lịch giảng viên', 'route' => ''],
                        ['name' => 'Lịch thi hết môn', 'route' => ''],
                        ['name' => 'Văn bản đào tạo', 'route' => ''],

                    ]
                ]
            ],


        ]
    ]

];
