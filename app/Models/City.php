<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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
     * Define relationship with the province
     *
     * @return void
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
