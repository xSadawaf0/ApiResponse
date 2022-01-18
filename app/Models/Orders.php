<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Laravel\Sanctum\HasApiTokens;
class Orders extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'tbl_orders';

    protected $fillable = [
        'product_id',
        'quantity',
    ];

}
