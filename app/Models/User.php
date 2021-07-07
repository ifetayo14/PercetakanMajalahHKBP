<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['Username', 'Alamat', 'Email', 'Password', 'Status', 'Role'];
    protected $table = 'users';

    use HasFactory;
}
