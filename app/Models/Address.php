<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
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
     * Define relationship with the village
     *
     * @return void
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
