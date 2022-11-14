<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_entryTransHarian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'entry_trans_harian';
    protected $guarded = [];
}
