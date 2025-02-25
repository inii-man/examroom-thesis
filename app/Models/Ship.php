<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $table = 'ships';

    protected $primaryKey = 'ship_id';

    protected $fillable = [
        'ship_name',
        'ship_type',
    ];
}
