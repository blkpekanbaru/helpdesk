<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;
    protected $table = 'teknisis';
    protected $fillable = [
        'nama_teknisi',
        'no_hp',
        'tugas',
    ];

    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'pic', 'id');
    }
}
