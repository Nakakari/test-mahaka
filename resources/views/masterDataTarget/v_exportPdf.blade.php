<table style="width:100%">
    <thead>
        <tr>
            <td width="50px"></td>
            <td width="140px"></td>
            <td width="140px"></td>
            <td width="100px"></td>
            <?php for ($b = 0; $b < 3; $b++) { ?>
            <td width="100px"></td>
            <?php } ?>
            <td width="130px"></td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: center;">
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
            <td colspan="8" style="text-align: center;">
                <b>s/d Tanggal : <?= date('d F Y', strtotime($tgl_sampai)) ?></b>
            </td>
        </tr>
        <tr>
            <td width="50px"></td>
            <td width="140px"></td>
            <td width="140px"></td>
            <td width="100px"></td>
            <?php for ($b = 0; $b < 3; $b++) { ?>
            <td width="100px"></td>
            <?php } ?>
            <td width="130px"></td>
        </tr>
        <tr>
            <td rowspan="3"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>NO</b>
            </td>
            <td rowspan="3"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>KODE
                    REKENING</b>
            </td>
            <td rowspan="3"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>NAMA
                    REKENING</b>
            </td>
            <td rowspan="3"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>TARGET (Rp.)</b>
            </td>
            <td colspan="3"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>REALISASI</b>
            </td>
            <td rowspan="3"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>%</b>
            </td>
        </tr>
        <tr>
            <td rowspan="2"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>s/d Bulan
                    Lalu</b>
            </td>
            <td rowspan="2"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>Bulan
                    Ini</b>
            </td>
            <td rowspan="2"
                style="text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">
                <b>s/d Bulan
                    Ini</b>
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td width="50px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>1</b>
            </td>
            <td width="140px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>2</b>
            </td>
            <td width="140px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>3</b>
            </td>
            <td width="100px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>4</b>
            </td>
            <td width="100px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>5</b>
            </td>
            <td width="100px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>6</b>
            </td>
            <td width="100px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>7</b>
            </td>
            <td width="130px" style="text-align: center; border: 1px solid black; border-collapse: collapse;"><b>8
                    (7/4)</b></td>
        </tr>
    </thead>

    <tbody>
        <?php $sum_tot_Price = 0; ?>
        @php $no = 1 @endphp
        @foreach ($items as $item)
            <tr>
                <td width="50px" style="text-align: left; border: 1px solid black; border-collapse: collapse;">
                    <b>{{ $no . '.' }}</b>
                </td>
                <td width="140px" style="text-align: left; border: 1px solid black; border-collapse: collapse;">
                    <b>{{ $item->kode_rekening }}</b>
                </td>
                <td width="140px" style="text-align: left; border: 1px solid black; border-collapse: collapse;">
                    <b>{{ $item->nama_rekening }}</b>
                </td>
                <td width="100px" style="text-align: left; border: 1px solid black; border-collapse: collapse;">
                    <b>{{ number_format($item->total_target, 2, ',', '.') }}</b>
                </td>
                <td width="100px" style="text-align: left; border: 1px solid black; border-collapse: collapse;"><b></b>
                </td>
                <td width="100px" style="text-align: left; border: 1px solid black; border-collapse: collapse;"><b></b>
                </td>
                <td width="100px" style="text-align: left;border: 1px solid black; border-collapse: collapse;"><b></b>
                </td>
                <td width="130px" style="text-align: left; border: 1px solid black; border-collapse: collapse;"><b></b>
                </td>
            </tr>
            <?php $sum_tot_Price += $item->total_target; ?>
            @php $no++ ; @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="text-align: center; border: 1px solid black; border-collapse: collapse;">
                <b>TOTAL</b>
            </td>
            <td width="100px" style="text-align: left; border: 1px solid black; border-collapse: collapse;">
                <b>{{ number_format($sum_tot_Price, 2, ',', '.') }}</b>
            </td>
            <td width="100px" style="text-align: left; border: 1px solid black; border-collapse: collapse;"></td>
            <td width="100px" style="text-align: left; border: 1px solid black; border-collapse: collapse;"></td>
            <td width="100px" style="text-align: left;border: 1px solid black; border-collapse: collapse;"></td>
            <td width="130px" style="text-align: left; border: 1px solid black; border-collapse: collapse;"></td>
        </tr>
    </tfoot>
</table>
