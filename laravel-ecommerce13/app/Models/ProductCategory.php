<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'product_category_id',
    ];
}
