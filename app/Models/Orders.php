<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $primaryKey = 'orders_id';

    protected $fillable = ['user_id',
    'order_date',
    'status',
    'ship_date',
    'ship_name',
    'ship_address',
    'ship_city',
    'ship_region',
    'ship_postal_code',
    'ship_country',
    'created_by',
    'updated_by',
    'qty',
    'price',
    'producthardcopy_id',
    'bukti',
    'resi'
];
    protected $table = 'orders';
}
