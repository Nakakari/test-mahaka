<?php

namespace App\Exports;

use App\Models\M_entryTransHarian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class entryDataTargetExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $dari;
    protected $sampai;
    protected $year_dari;
    protected $year_sampai;
    protected $nama_via;
    protected $via;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($dari, $sampai, $year_dari, $year_sampai, $nama_via, $via)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
        $this->year_dari = $year_dari;
        $this->year_sampai = $year_sampai;
        $this->nama_via = $nama_via;
        $this->via = $via;
    }

    public function view(): View
    {
        $data = [
            'items' => M_entryTransHarian::basedTanggalVia($this->dari, $this->sampai, $this->nama_via, $this->via),
            'tahun_awal' => $this->year_dari,
            'tahun_akhir' => $this->year_sampai,
            'tgl_sampai' => $this->sampai,
            'nama_via' => $this->nama_via,
        ];
        return view('entryTransHarian.v_exportData', $data);
    }
}
