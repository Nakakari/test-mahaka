<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_rekening extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tabel_rekening';
    protected $guarded = [];
    public $timestamps = false;
}
