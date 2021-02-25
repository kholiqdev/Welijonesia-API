<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UsesUuid;


    /**
     * Define relationship with the seller
     *
     * @return void
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }


    /**
     * Define relationship with the comodity
     *
     * @return void
     */
    public function comodity()
    {
        return $this->belongsTo(Comodity::class);
    }


    /**
     * Define relationship with the product detail
     *
     * @return void
     */
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
