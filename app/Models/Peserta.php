<?php

namespace App\Models;

use App\Models\Skema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $fillable =[
        'skema_id',
        'nik',
        'nama',
        'email',
        'no_hp',
        'alamat',
    ];

    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class);
    }
}
