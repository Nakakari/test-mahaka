<?php

namespace App\Http\Controllers;

use App\Models\M_entryTransHarian;
use App\Models\M_viaBayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
