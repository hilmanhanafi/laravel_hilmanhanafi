<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // add fillable
    protected $fillable = [
        'nama_pasien',
        'alamat',
        'no_telepon',
        'id_rumah_sakit',
    ];

    // RELATIONSHIP
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_rumah_sakit');
    }
}
