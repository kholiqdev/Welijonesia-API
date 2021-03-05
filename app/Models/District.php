<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'json',
    ];

    /**
     * Define relationship with the city
     *
     * @return void
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
