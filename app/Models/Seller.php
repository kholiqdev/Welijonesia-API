<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that cannot mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Define relationship with the user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define relationship with the rute detail
     *
     * @return void
     */
    public function ruteDetails()
    {
        return $this->hasMany(RuteDetail::class);
    }

    /**
     * Define relationship with the product
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Define relationship with the review
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Define relationship with the favorit
     *
     * @return void
     */
    public function favorits()
    {
        return $this->hasMany(Favorit::class);
    }
}
