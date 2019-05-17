<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = [
        'user_id', 'kelas_active_id', 'status'
    ];
}
