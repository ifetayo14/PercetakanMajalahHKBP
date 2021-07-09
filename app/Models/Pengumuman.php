<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = ['judul', 'isi', 'deskripsi', 'expired_date', 'file', 'role'];
    protected $table = 'pengumuman';

    use HasFactory;
}
