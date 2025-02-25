<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightHouse extends Model
{
    use HasFactory;

    protected $table = 'light_houses';

    protected $primaryKey = 'light_house_id';

    protected $fillable = [
        'light_house_name',
        'light_house_type',
        'light_house_address',
        'light_house_structure',
        'status',
    ];
}
