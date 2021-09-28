<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['status', 'start_date', 'end_date', 'crated_date', 'updated_date'];
    protected $table = 'member';

    use HasFactory;
}
