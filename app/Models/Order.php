<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    /**
     * The attributes that cannot mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Define relationship with the order detail
     *
     * @return void
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Define relationship with the billing
     *
     * @return void
     */
    public function billings()
    {
        return $this->hasMany(Billing::class);
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

    /**
     * Define relationship with the user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
