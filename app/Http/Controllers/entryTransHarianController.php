<?php

namespace App\Http\Controllers;

use App\Exports\entryDataTargetExport;
use App\Exports\viaBayarExport;
use App\Models\M_entryTransHarian;
use App\Models\M_rekening;
use App\Models\M_viaBayar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class entryTransHarianController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Entry Transaksi Harian',
            'via_bayar' => M_viaBayar::all(),
        ];
        return view('entryTransHarian.v_index', $data);
    }

    public function list_data(Request $request)
    {
        $columns = [
            'tabel_rekening.kode_rekening',
            'tabel_rekening.nama_rekening',
            'via_pembayaran.via_bayar',
            'tgl_setor',
            'jml_bayar',
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_entryTransHarian::select([
            'entry_trans_harian.id',
            'tabel_rekening.kode_rekening',
            'tabel_rekening.nama_rekening',
            'via_pembayaran.via_bayar',
            DB::raw("(DATE_FORMAT(tgl_setor,'%m-%d-%Y')) as tgl_setor_a"),
            'tgl_setor',
            'jml_bayar',
        ])
            ->join('tabel_rekening', 'tabel_rekening.id', '=', 'entry_trans_harian.kode_rekening')
            ->join('via_pembayaran', 'entry_trans_harian.via_bayar', '=', 'via_pembayaran.id')
            ->orderBy('created_at', "desc");

        if (request()->input('dari') != null && request()->input('sampai') != null) {
            $data = $data->whereBetween('entry_trans_harian.tgl_setor', [request()->dari, request()->sampai]);
        }

        if (request()->input("search.value") != null) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(tabel_rekening.nama_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tabel_rekening.kode_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
            });
        }

        if (request()->input('via') != null) {
            $data = $data->where('entry_trans_harian.via_bayar', request()->via);
        }

        $recordsFiltered = $data->get()->count();

        if ($request->input('length') != -1) $data = $data->skip($request->input('start'))->take($request->input('length'));

        $data = $data->orderBy($orderBy, $request->input('order.0.dir'))->get();

        $recordsTotal = $data->count();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function delete_data()
    {
        // dd(request()->all());
        $item = M_entryTransHarian::findOrFail(request()->input('id'));
        $item->delete();
        return response()->json(true);
    }

    public function excell_data()
    {
        // dd(request()->all());
        $dari = request()->input('dari');
        $sampai = request()->input('sampai');
        $via = request()->input('via');

        if ($dari != null && $sampai != null && $via != null) {


            $year_dari = Carbon::createFromFormat('Y-m-d', $dari)->format('Y');
            $year_sampai = Carbon::createFromFormat('Y-m-d', $sampai)->format('Y');
            $nama_via = M_viaBayar::getVia($via)->via_bayar;

            // dd($nama_via);

            if ($year_dari == $year_sampai) {
                return Excel::download(new entryDataTargetExport($dari, $sampai, $year_dari, $year_sampai, $nama_via, $via), 'Laporan Pendapatan Asli Daerah Via ' . $nama_via . ' Tahun ' . $year_dari . '.xlsx');
            } else {
                return Excel::download(new entryDataTargetExport($dari, $sampai, $year_dari, $year_sampai, $nama_via, $via), 'Laporan Pendapatan Asli Daerah Via ' . $nama_via . ' Tahun ' . $year_dari . ' sd ' . $year_sampai . '.xlsx');
            }
        } else {

            $nama_via = M_viaBayar::getVia($via)->via_bayar;

            return Excel::download(new  viaBayarExport($nama_via, $via), 'Laporan Pendapatan Asli Daerah Via ' . $nama_via . '.xlsx');
            // return "aa";
        }
    }

    public function form_data()
    {
        $data = [
            'title' => 'Tambah Transaksi Harian',
            'rekening' => M_rekening::all(),
            'via_bayar' => M_viaBayar::all(),
        ];
        return view('entryTransHarian.v_form', $data);
    }

    public function add_data(Request $request)
    {
        if (is_array($request->get('kode_rekening')) || is_object($request->get('kode_rekening'))) {
            foreach ($request->get('kode_rekening') as $kode) {
                M_entryTransHarian::create([
                    'via_bayar' => $request->get('via_bayar'),
                    'tgl_setor' => $request->get('tgl_setor'),
                    'jml_bayar' => $request->get('jml_bayar'),
                    'kode_rekening' => $kode
                ]);
            }
        }
        return redirect('/trans_harian');
    }
}
