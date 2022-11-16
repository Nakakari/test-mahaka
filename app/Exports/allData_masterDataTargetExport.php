<?php

namespace App\Exports;

use App\Models\M_masterDataTarget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class allData_masterDataTargetExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $data = [
            'items' => M_masterDataTarget::tanggalNull(),
            'tahun_awal' => M_masterDataTarget::tahunAwal()->tahun_awal,
            'tahun_akhir' => M_masterDataTarget::tahunAkhir()->tahun_akhir,
            'tgl_sampai' => M_masterDataTarget::lastTanggal()->tgl_sampai,
        ];
        return view('masterDataTarget.v_exportExcel', $data);
    }
}
