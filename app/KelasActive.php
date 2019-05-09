<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasActive extends Model
{
    protected $fillable = [
        'kelas_id', 'jadwal_id', 'ruangan_id', 'status', 'pertemuan'
    ];
}
