<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that cannot mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
