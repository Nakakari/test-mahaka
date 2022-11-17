<?php

namespace App\Exports;

use App\Models\M_entryTransHarian;
use App\Models\M_masterDataTarget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class viaBayarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $nama_via;
    protected $via;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($nama_via, $via)
    {
        $this->nama_via = $nama_via;
        $this->via = $via;
    }

    public function view(): View
    {
        $data = [
            'items' => M_entryTransHarian::basedVia($this->via),
            'tahun_awal' => M_masterDataTarget::tahunAwal()->tahun_awal,
            'tahun_akhir' => M_masterDataTarget::tahunAkhir()->tahun_akhir,
            'tgl_sampai' => M_masterDataTarget::lastTanggal()->tgl_sampai,
            'nama_via' => $this->nama_via,
        ];
        return view('entryTransHarian.v_exportData', $data);
    }
}
