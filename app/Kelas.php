<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'nama', 'mata_kuliah_id', 'dosen_id', 'jadwal_id', 'ruangan_id'
    ];

    public function mata_kuliah() {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function dosen() {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function jadwal() {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function ruangan() {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function kelas_active() {
        return $this->hasMany(KelasActive::class, 'kelas_id');
    }

    public function scopeWhereHari($query, $hari) {
        return $query->whereHas('jadwal', function ($q) use ($hari) {
            $q->where('hari', $hari);
        });
    }
}
