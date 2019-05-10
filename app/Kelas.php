<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'nama', 'mata_kuliah_id', 'dosen_id', 'jadwal_id', 'ruangan_id'
    ];

    public function kelas_active() {
        return $this->hasMany(KelasActive::class, 'kelas_id');
    }
}
