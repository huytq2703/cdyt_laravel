<?php

return [
    'web' => [

    ],
    'admin' => [
        'SUPER_ADMIN' => [
            [
                "name" => 'Sinh viên',
                "role" => 'student_manager',
                "child" => [
                    ['name' => 'Tài liệu học tập', 'route' => 'student.document', 'role' => 'learning_document'],
                    ['name' => 'Thư viện bài giảng', 'route' => 'student.lecture_library', 'role' => 'lecture_library']
                ]
            ],
            [
                "name" => "Đào tạo",
                "role"  => "training_manager",
                "child" => [
                    ['name' => 'Lịch giảng & học', 'route' => 'training.schedules', 'role' => 'schedules'],
                    ['name' => 'Quản lý phòng ban', 'route' => 'training.departments', 'role' => 'departments'],
                ]
            ],
            [
                "name" => "Nội dung",
                "role"  => 'content_manager',
                "child" => [
                    ['name' => 'Danh mục', 'route' => 'admin.category', 'role' => 'category'],
                    ['name' => 'Quản lý bài viết', 'route' => 'admin.posts', 'role' => 'post'],
                    ['name' => 'Quản lý thông báo', 'route' => 'admin.notice', 'role' => 'notice'],
                    ['name' => 'Quản lý trang tĩnh', 'route' => 'admin.pages', 'role' => 'page'],
                    ['name' => 'Kiểm duyệt nội dung', 'route' => 'admin.posts.verify.list', 'role' => 'content_verify'],
                ]
            ],
            [
                "name" => "Tuyển sinh & Hướng nghiệp",
                "role"  => 'admission_manger',
                "child" => [
                    ['name' => 'Quản lý tuyển sinh', 'route' => 'admin.admissions', 'role' => 'admissions'],
                    ['name' => 'Quản lý hướng nghiệp', 'route' => 'admin.career_direction', 'role' => 'career_direction'],
                    ['name' => 'Quản lý ngành học', 'route' => 'admin.majors', 'role' => 'majors_manage'],
                ]
            ],
            [
                "name" => "Hệ thống",
                "role"  => "system_manager",
                "child" => [
                    ['name' => 'Thông tin chung', 'route' => 'system.setting', 'role' => 'general_info'],
                    ['name' => 'Quản lý quyền & tài khoản', 'route' => 'system.permission', 'role' => ['permission', 'account']],
                    ['name' => 'Quản lý menu', 'route' => 'system.menu', 'role' => 'menu'],
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
