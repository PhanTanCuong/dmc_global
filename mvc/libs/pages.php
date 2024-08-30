<?php

namespace Mvc\Libraries;
class Pages
{


    // Mảng chứa các trang tĩnh
    public static $static_pages = [
        ''=>[
            'link'=>'#',
            'name'=>'None'
        ],
        'home' =>
            [
                'link' => '/home',
                'name' => 'Home'
            ],
        'Cooperation' =>
            [
                'link' => '/cooperation',
                'name' => 'Cooperation'
            ],
        'Contact' =>
            [
                'link' => '/contact',
                'name' => 'Contact'
            ],
    ];

    // Mảng chứa các trang động
    public static $dynamic_pages = [
        'about_page' =>
            [
                'link' => '/about/{about_id}',
                'name' => 'Abouts'
            ],
        'product_page' =>
            [
                'link' => '/product/{product_id}',
                'name' => 'Products'
            ],
        'service_page' =>
            [
                'link' => '/service/{service_id}',
                'name' => 'Services'
            ],
        'media_page' =>
            [
                'link' => '/media/{media_id}',
                'name' => 'Media'
            ],
        'news_page' =>
            [
                'link' => '/news/{news_id}',
                'name' => 'News'
            ],
    ];


}
?>