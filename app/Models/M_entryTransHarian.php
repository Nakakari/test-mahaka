<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_entryTransHarian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'entry_trans_harian';
    protected $guarded = [];

    public static function basedTanggalVia($dari, $sampai, $nama_via, $via)
    {
        return DB::table('master_data_target')
            ->select(
                'tabel_rekening.kode_rekening',
                'tabel_rekening.nama_rekening',
                DB::raw('SUM(target) as total_target'),
            )
            ->join('tabel_rekening', 'tabel_rekening.id', '=', 'master_data_target.kode_rekening')
            ->leftjoin('entry_trans_harian', 'entry_trans_harian.kode_rekening', '=', 'master_data_target.kode_rekening')
            ->where('master_data_target.tgl_mulai', '>=', $dari)
            ->where('master_data_target.tgl_akhir', '<=',  $sampai)
            ->where('entry_trans_harian.kode_rekening', '<=',  $via)
            ->groupBy('tabel_rekening.kode_rekening', 'tabel_rekening.nama_rekening')
            ->having(DB::raw('count(*)'), '>=', 1)
            ->get();
    }
}
