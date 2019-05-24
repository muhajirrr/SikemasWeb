<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = [
        'user_id', 'kelas_active_id', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas_active() {
        return $this->belongsTo(KelasActive::class, 'kelas_active_id');
    }
}
