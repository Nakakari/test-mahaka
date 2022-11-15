<?php

namespace App\Http\Controllers;

use App\Models\M_masterDataTarget;
use Illuminate\Http\Request;

class masterDataTargetController extends Controller
{
    public function index()
    {
        return view('masterDataTarget.v_index');
    }

    public function list_data()
    {
        $columns = [
            'kode_rekening',
            'target',
            'tgl_mulai',
            'tgl_akhir'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_masterDataTarget::select([
            '*'
        ])->orderBy('created_at', "asc");

        $recordsFiltered = $data->get()->count();

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(master_data_target.nama_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(master_data_target.kode_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
            });
        }
        if (request()->input('dari') != null && request()->input('sampai') != null) {
            $data = $data->whereBetween('master_data_target.tgl_mulai', [request()->dari, request()->sampai])
                ->orWhereBetween('master_data_target.tgl_akhir', [request()->dari, request()->sampai]);
        }
        $data = $data
            ->skip(request()->input('start'))
            ->take(request()->input('length'))
            ->orderBy($orderBy, request()->input("order.0.dir"))
            ->get();
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'all_request' => request()->all()
        ]);
    }
}
