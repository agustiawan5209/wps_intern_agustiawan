<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHarian extends Model
{
    use HasFactory;

    protected $table = 'log_harians';

    protected $fillable = [
        'id_pegawai', 'tanggal', 'file', 'deskripsi', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pegawai', 'id');
    }

}
