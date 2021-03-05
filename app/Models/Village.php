<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
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
     * Define relationship with the district
     *
     * @return void
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Define relationship with the address
     *
     * @return void
     */
    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
