<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_masterDataTarget extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'master_data_target';
    protected $guarded = [];
}
