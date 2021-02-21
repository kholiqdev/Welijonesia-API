<?php

namespace App\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuteDetail extends Model
{
    use HasFactory, UsesUuid;

    /**
     * Define relationship with the rute
     *
     * @return void
     */
    public function rute()
    {
        return $this->belongsTo(Rute::class);
    }
}
