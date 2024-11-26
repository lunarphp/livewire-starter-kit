<?php

namespace App\Models;

class Meta 
{
    public $title = '';
    public $keywords = 'fashion, style, clothing, women, men, kids, branded, cheap, ecommerce, online, shopify';
    public $description = 'One stop fashion shop to get your style | A Zabrdast ecommerce storefront';

    public function __construct()
    {
        $this->title = config('app.name') . ' - One stop for Fashion, Style and Accessories | Cheap | Branded';
    }
}