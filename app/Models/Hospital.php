<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    // fillable
    protected $fillable = [
        'nama_rumah_sakit',
        'alamat',
        'email',
        'telepon'
    ];

    // relationship
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
