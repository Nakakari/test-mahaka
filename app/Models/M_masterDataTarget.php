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
                'tabel_rekening.kode_rekening',
                'tabel_rekening.nama_rekening',
                DB::raw('SUM(target) as total_target'),
            )
            ->join('tabel_rekening', 'tabel_rekening.id', '=', 'master_data_target.kode_rekening')
            ->where('master_data_target.tgl_mulai', '>=', $dari)
            ->where('master_data_target.tgl_akhir', '<=',  $sampai)
            ->groupBy('tabel_rekening.kode_rekening', 'tabel_rekening.nama_rekening')
            ->having(DB::raw('count(*)'), '>=', 1)
            ->get();
    }

    public static function tanggalNull()
    {
        return DB::table('master_data_target')
            ->select(
                'tabel_rekening.kode_rekening',
                'tabel_rekening.nama_rekening',
                DB::raw('SUM(target) as total_target'),
            )
            ->join('tabel_rekening', 'tabel_rekening.id', '=', 'master_data_target.kode_rekening')
            ->groupBy('tabel_rekening.kode_rekening', 'tabel_rekening.nama_rekening')
            ->having(DB::raw('count(*)'), '>=', 1)
            ->get();
    }

    public static function tahunAwal()
    {
        return DB::table('master_data_target')
            ->select(
                DB::raw("(DATE_FORMAT(tgl_mulai,'%Y')) as tahun_awal")
            )
            ->first();
    }
    public static function tahunAkhir()
    {
        return DB::table('master_data_target')
            ->select(
                DB::raw("(DATE_FORMAT(tgl_akhir,'%Y')) as tahun_akhir")
            )
            ->orderBy('id', 'desc')->first();
    }

    public static function lastTanggal()
    {
        return DB::table('master_data_target')
            ->select(
                'tgl_akhir as tgl_sampai'
            )
            ->orderBy('id', 'desc')->first();
    }

    public static function getById($id)
    {
        return DB::table('master_data_target')
            ->select(
                'kode_rekening',
                'target',
                'tgl_mulai',
                'tgl_akhir',
            )
            ->where('id', '=', $id)
            ->first();
    }
}
