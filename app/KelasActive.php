<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasActive extends Model
{
    protected $fillable = [
        'kelas_id', 'jadwal_id', 'ruangan_id', 'status', 'pertemuan'
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jadwal() {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function ruangan() {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
