<?php

namespace App\Models;

use App\Models\Skema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    protected $fillable = ['user_id', 'skema_id', 'nik', 'nama', 'email', 'no_hp', 'alamat', 'status_verifikasi'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function skema()
    {
        return $this->belongsTo(Skema::class, 'skema_id');
    }

}
