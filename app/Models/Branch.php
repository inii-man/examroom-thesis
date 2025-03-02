<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_name',
        'branch_type',
    ];
}
