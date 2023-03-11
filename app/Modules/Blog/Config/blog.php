<?php
return [
    'module' => 'blog',
    'version' => '1.0.0',
    'type' => 'post_type',
    'slug' => 'post',
    'title' => 'مقاله آموزشی',
    'menu' => [
        'index' => [
            'title' => 'مقاله آموزشی',
            'url' => ''
        ],
        'add_new' => [
            'title' => 'اضافه کردن مقاله',
            'url' => 'create'
        ],
    ],
    'components' => [
        'title',
        'slug',
        'description'
    ]
];
