<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, UsesUuid,SoftDeletes;

    /**
     * The attributes that cannot mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Define relationship with the cart detail
     *
     * @return void
     */
    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

    /**
     * Define relationship with the seller
     *
     * @return void
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
