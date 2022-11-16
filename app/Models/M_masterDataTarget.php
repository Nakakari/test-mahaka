<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_masterDataTarget extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'master_data_target';
    protected $guarded = [];

    public static function basedTanggal($dari, $sampai)
    {
        return DB::table('master_data_target')
            ->select(
                'kode_rekening',
                'nama_rekening',
                DB::raw('SUM(target) as total_target'),
            )
            ->where('master_data_target.tgl_mulai', '>=', $dari)
            ->where('master_data_target.tgl_akhir', '<=',  $sampai)
            ->groupBy('kode_rekening', 'nama_rekening')
            ->having(DB::raw('count(*)'), '>=', 1)
            ->get();
    }
}
