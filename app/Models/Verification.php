<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory, UsesUuid;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->expired_at = Carbon::now()->addMinutes(2);
        });
    }

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expired_at' => 'datetime',
    ];
}
