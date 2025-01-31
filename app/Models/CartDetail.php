<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartDetail extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    /**
     * The attributes that cannot mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Define relationship with the cart
     *
     * @return void
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Define relationship with the product detail
     *
     * @return void
     */
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
