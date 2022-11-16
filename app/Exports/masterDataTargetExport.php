<?php

namespace App\Exports;

use App\Models\M_masterDataTarget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class masterDataTargetExport implements FromView
{
    protected $dari;
    protected $sampai;
    protected $year_dari;
    protected $year_sampai;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($dari, $sampai, $year_dari, $year_sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
        $this->year_dari = $year_dari;
        $this->year_sampai = $year_sampai;
    }

    public function view(): View
    {
        $data = [
            'items' => M_masterDataTarget::basedTanggal($this->dari, $this->sampai),
            'tahun_awal' => $this->year_dari,
            'tahun_akhir' => $this->year_sampai,
            'tgl_sampai' => $this->sampai,
        ];
        return view('masterDataTarget.v_exportExcel', $data);
    }
}
