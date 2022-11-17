<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_viaBayar extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'via_pembayaran';
    protected $guarded = [];

    public static function getVia($via)
    {
        return DB::table('via_pembayaran')
            ->select(
                'via_bayar'
            )
            ->where('id', '=', $via)
            ->first();
    }
}
