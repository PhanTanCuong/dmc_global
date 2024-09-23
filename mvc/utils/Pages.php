<?php

namespace Mvc\Utils;
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
                'link' => 'home',
                'name' => 'Home'
            ],
        'Cooperation' =>
            [
                'link' => 'cooperation',
                'name' => 'Cooperation'
            ],
        'Contact' =>
            [
                'link' => 'contact',
                'name' => 'Contact'
            ],
    ];

    // Mảng chứa các trang động
    public static $dynamic_pages = [
        'about_page' =>
            [
                'link' => 'about_us',
                'name' => 'Abouts'
            ],
        'product_page' =>
            [
                'link' => 'product_category',
                'name' => 'Products'
            ],
        'service_page' =>
            [
                'link' => 'business_services',
                'name' => 'Services'
            ],
        'media_page' =>
            [
                'link' => 'media',
                'name' => 'Media'
            ],
        'news_page' =>
            [
                'link' => 'news',
                'name' => 'News'
            ],
    ];


}
?>