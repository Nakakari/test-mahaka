<table style="width:100%">
    <thead>
        <tr>
            <td width="80px"></td>
            <td width="140px"></td>
            <td width="140px"></td>
            <td width="100px"></td>
            <?php for ($b = 0; $b < 3; $b++) { ?>
            <td width="100px"></td>
            <?php } ?>
            <td width="130px"></td>
        </tr>
        <tr>
            <td colspan="10" style="text-align: center;">
                <b>
                    LAPORAN PENDAPATAN ASLI DAERAH TAHUN
                    @if ($tahun_awal == $tahun_akhir)
                        {{ $tahun_akhir }}
                    @else
                        {{ $tahun_awal }} - {{ $tahun_akhir }}
                    @endif
                </b>
            </td>
        </tr>
        <tr>
            <td colspan="10" style="text-align: center;">
                <b>s/d Tanggal <?= date('d F Y', strtotime($tgl_sampai)) ?></b>
            </td>
        </tr>
        <tr>
            <td width="80px"></td>
            <td width="140px"></td>
            <td width="140px"></td>
            <td width="100px"></td>
            <?php for ($b = 0; $b < 3; $b++) { ?>
            <td width="100px"></td>
            <?php } ?>
            <td width="130px"></td>
        </tr>
        <tr>
            <td rowspan="3" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>NO</b>
            </td>
            <td rowspan="3" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>KODE
                    REKENING</b></td>
            <td rowspan="3" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>NAMA
                    REKENING</b></td>
            <td rowspan="3" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                <b>TARGET (Rp.)</b>
            </td>
            <td colspan="3" style="text-align: center; vertical-align: middle; border: 1px solid black;">
                <b>REALISASI</b>
            </td>
            <td rowspan="3" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>%</b>
            </td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>s/d Bulan
                    Lalu</b></td>
            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>Bulan
                    Ini</b></td>
            <td rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;"><b>s/d Bulan
                    Ini</b></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td width="80px" style="text-align: center; border: 1px solid black;"><b>1</b></td>
            <td width="140px" style="text-align: center; border: 1px solid black;"><b>2</b></td>
            <td width="140px" style="text-align: center; border: 1px solid black;"><b>3</b></td>
            <td width="100px" style="text-align: center; border: 1px solid black;"><b>4</b></td>
            <td width="100px" style="text-align: center; border: 1px solid black;"><b>5</b></td>
            <td width="100px" style="text-align: center; border: 1px solid black;"><b>6</b></td>
            <td width="100px" style="text-align: center; border: 1px solid black;"><b>7</b></td>
            <td width="130px" style="text-align: center; border: 1px solid black;"><b>8 (7/4)</b></td>
        </tr>
    </thead>

    <tbody>
        <?php $sum_tot_Price = 0; ?>
        @php $no = 1 @endphp
        @foreach ($items as $item)
            <tr>
                <td width="80px" style="text-align: left; border: 1px solid black;"><b>{{ $no }}</b></td>
                <td width="140px" style="text-align: left; border: 1px solid black;"><b>{{ $item->kode_rekening }}</b>
                </td>
                <td width="140px" style="text-align: left; border: 1px solid black;"><b>{{ $item->nama_rekening }}</b>
                </td>
                <td width="100px" style="text-align: left; border: 1px solid black;">
                    <b>{{ number_format($item->total_target, 2, ',', '.') }}</b>
                </td>
                <td width="100px" style="text-align: left; border: 1px solid black;"><b></b></td>
                <td width="100px" style="text-align: left; border: 1px solid black;"><b></b></td>
                <td width="100px" style="text-align: left;border: 1px solid black;"><b></b></td>
                <td width="130px" style="text-align: left; border: 1px solid black;"><b></b></td>
            </tr>
            <?php $sum_tot_Price += $item->total_target; ?>
            @php $no++ ; @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align: center; border: 1px solid black;"><b>TOTAL</b></td>
            <td width="100px" style="text-align: left; border: 1px solid black;">
                <b>{{ number_format($sum_tot_Price, 2, ',', '.') }}</b></td>
            <td width="100px" style="text-align: left; border: 1px solid black;"></td>
            <td width="100px" style="text-align: left; border: 1px solid black;"></td>
            <td width="100px" style="text-align: left;border: 1px solid black;"></td>
            <td width="130px" style="text-align: left; border: 1px solid black;"></td>
        </tr>
    </tfoot>
</table>
