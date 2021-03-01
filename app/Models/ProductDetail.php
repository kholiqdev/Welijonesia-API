<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory, UsesUuid;


    /**
     * Define relationship with the product unit
     *
     * @return void
     */
    public function productUnit()
    {
        return $this->belongsTo(ProductUnit::class);
    }

    /**
     * Define relationship with the product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
