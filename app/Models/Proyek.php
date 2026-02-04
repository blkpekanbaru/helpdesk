<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    protected $table = 'proyeks';
    protected $fillable = [
        'nama_proyek',
        'deskripsi',
        'pic',
        'bukti',
        'status',
        'tgl_mulai',
        'deadline',
    ];

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, 'pic', 'id');
    }
}
