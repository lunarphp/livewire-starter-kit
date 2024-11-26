<?php

namespace App\Models;

class Meta 
{
    public $title = '';
    public $keywords = 'fashion, style, clothing, women, men, kids, branded, aura, cheap, store, fur, sweater, sale, e-commerce, online, shopify, pkr';
    public $description = 'One stop fashion shop | Get your style online from countless high street to high end brands | Free Delivery | Zabrdast.com e-commerce storefront';

    public function __construct()
    {
        $this->title = config('app.name') . ' - One stop Branded Fashion, Style and Accessories';
    }
}