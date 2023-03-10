<?php
return [
    'posts' => [
        'slug' => 'post',
        'name' => 'post',
        'labels' => [
            'menu_name' => 'مقاله آموزشی',
            'title' => 'مقاله آموزشی',
            'add_new' => 'اضافه کردن مقاله',
            'edit' => 'ویرایش مقاله',
        ],
        'components' => [
            'title',
            'slug',
            'description'
        ]
    ],
    'users' => [
        'slug' => 'user',
        'name' => 'user',
        'labels' => [
            'menu_name' => 'کاربران',
            'title' => 'کاربران',
            'add_new' => 'ایجاد کاربر',
            'edit' => 'ویرایش کاربر',
        ],
        'components' => [
            'title',
            'slug',
            'description'
        ]
    ]
];
