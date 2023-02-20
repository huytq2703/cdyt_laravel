<?php

return [
    'web' => [

    ],
    'admin' => [
        'SUPER_ADMIN' => [
            [
                "name" => 'Sinh viên',
                "child" => [
                    ['name' => 'Tra cứu điểm', 'route' => 'student.score'],
                    ['name' => 'Tra cứu lịch học', 'route' => 'student.schedule'],
                    ['name' => 'Tài liệu học tập', 'route' => 'student.document'],
                    ['name' => 'Thư viện bài giảng', 'route' => 'student.lecture_library']
                ]
            ],
            [
                "name" => "Đào tạo",
                "child" => [
                    ['name' => 'Chương trình đào tạo', 'route' => 'training.program'],
                    ['name' => 'Lịch giảng viên', 'route' => 'training.schedule'],
                    ['name' => 'Lịch thi hết môn', 'route' => 'training.schedule.end_course_test'],
                    ['name' => 'Văn bản đào tạo', 'route' => 'training.training_doc'],

                ]
            ],
            [
                "name" => "Nội dung",
                "child" => [
                    ['name' => 'Danh mục', 'route' => 'admin.category'],
                    ['name' => 'Quản lý bài viết', 'route' => 'admin.posts'],
                    ['name' => 'Quản lý thông báo', 'route' => 'admin.notice'],
                    ['name' => 'Quản lý trang tĩnh', 'route' => 'admin.pages'],
                    ['name' => 'Kiểm duyệt bài viết', 'route' => 'admin.posts.verify'],
                ]
            ],
            [
                "name" => "Hệ thống",
                "child" => [
                    ['name' => 'Quản lý tài khoản', 'route' => 'system.user'],
                    ['name' => 'Quản lý quyền', 'route' => 'system.permission'],
                    ['name' => 'Quản lý menu', 'route' => 'system.menu'],
                ]
            ],
            [
                "name" => "Tuyển sinh & tư vấn",
                "child" => [
                    ['name' => 'Đăng ký tuyển sinh', 'route' => 'admin.admissions'],
                    ['name' => 'Đăng ký hướng nghiệp', 'route' => 'system.permission'],
                ]
            ],
        ],

        'ADMIN' => [
            [
                "name" => 'Sinh viên',
                "child" => [
                    ['name' => 'Tra cứu điểm', 'route' => 'student.score'],
                    ['name' => 'Tra cứu lịch học', 'route' => 'student.schedule'],
                    ['name' => 'Tài liệu học tập', 'route' => 'student.document'],
                    ['name' => 'Thư viện bài giảng', 'route' => 'student.lecture_library']
                ]
            ],
            [
                "name" => "Đào tạo",
                "child" => [
                    ['name' => 'Chương trình đào tạo', 'route' => 'training.program'],
                    ['name' => 'Lịch giảng viên', 'route' => 'training.schedule'],
                    ['name' => 'Lịch thi hết môn', 'route' => 'training.schedule.end_course_test'],
                    ['name' => 'Văn bản đào tạo', 'route' => 'training.training_doc'],

                ]
            ],
            [
                "name" => "Bài viết",
                "child" => [
                    ['name' => 'Quản lý bài viết', 'route' => 'admin.posts'],
                    ['name' => 'Kiểm duyệt bài viết', 'route' => 'admin.posts.verify'],
                ]
            ]
        ],

        'POST_MANAGE' => [
            [
                "name" => "Bài viết",
                "child" => [
                    ['name' => 'Quản lý bài viết', 'route' => 'admin.posts'],
                    ['name' => 'Kiểm duyệt bài viết', 'route' => 'admin.posts.verify'],
                ]
            ]
        ],

    ]
];
