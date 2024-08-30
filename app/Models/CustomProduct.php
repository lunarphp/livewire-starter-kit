<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lunar\Models\Product as LunarProduct;

class CustomProduct extends LunarProduct
{
    protected $table = 'products';
}
