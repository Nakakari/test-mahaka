<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\masterDataTargetExport;
use App\Models\M_masterDataTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class masterDataTargetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Target'
        ];
        return view('masterDataTarget.v_index', $data);
    }

    public function list_data(Request $request)
    {
        $columns = [
            'kode_rekening',
            'target',
            'tgl_mulai',
            'tgl_akhir',
            'nama_rekening'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_masterDataTarget::select([
            'id',
            'kode_rekening',
            'nama_rekening',
            'target',
            DB::raw("(DATE_FORMAT(tgl_mulai,'%m-%d-%Y')) as tgl_mulai_c"),
            DB::raw("(DATE_FORMAT(tgl_akhir,'%m-%d-%Y')) as tgl_akhir_c"),
            'tgl_akhir',
            'tgl_mulai',
        ])->orderBy('created_at', "asc");

        if (request()->input('dari') != null && request()->input('sampai') != null) {
            $data = $data->where('master_data_target.tgl_mulai', '>=', request()->dari)
                ->where('master_data_target.tgl_akhir', '<=',  request()->sampai);
        }

        if (request()->input("search.value") != null) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(master_data_target.nama_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(master_data_target.kode_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
            });
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

    public function add_data(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'kode_rekening'  => ['required', 'min:1', 'max:8'],
            'nama_rekening'  => 'required',
            'target'  => ['required', 'min:1'],
            'awal_berlaku'  =>  'required',
            'akhir_berlaku'  =>  'required',
        ]);
        $data = [
            'kode_rekening' => request()->get('kode_rekening'),
            'nama_rekening' => request()->get('nama_rekening'),
            'target' => request()->get('target'),
            'tgl_mulai' => request()->get('awal_berlaku'),
            'tgl_akhir' => request()->get('akhir_berlaku'),
        ];
        DB::table('master_data_target')->insert($data);
        return response()->json(true);
    }

    public function delete_data()
    {
        // dd(request()->all());
        $item = M_masterDataTarget::findOrFail(request()->input('id'));
        $item->delete();
        return response()->json(true);
    }

    public function edit_data(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'kode_rekening'  => ['required', 'min:1', 'max:8'],
            'nama_rekening'  => 'required',
            'target'  => ['required', 'min:1'],
            'awal_berlaku'  =>  'required',
            'akhir_berlaku'  =>  'required',
        ]);
        $data = [
            'kode_rekening' => request()->get('kode_rekening'),
            'nama_rekening' => request()->get('nama_rekening'),
            'target' => request()->get('target'),
            'tgl_mulai' => request()->get('awal_berlaku'),
            'tgl_akhir' => request()->get('akhir_berlaku'),
        ];
        DB::table('master_data_target')->where('id', request()->get('id'))
            ->update($data);
        return response()->json(true);
    }

    public function excell_data()
    {
        $dari = request()->input('dari');
        $sampai = request()->input('sampai');
        // dd(M_masterDataTarget::basedTanggal($dari, $sampai));
        if (request()->input('dari') != null && request()->input('sampai') != null) {


            $year_dari = Carbon::createFromFormat('Y-m-d', $dari)->format('Y');
            $year_sampai = Carbon::createFromFormat('Y-m-d', $sampai)->format('Y');

            if ($year_dari == $year_sampai) {
                return Excel::download(new masterDataTargetExport($dari, $sampai, $year_dari, $year_sampai), 'Data Master Target Export ' . $year_dari . '.xlsx');
            } else {
                return Excel::download(new masterDataTargetExport($dari, $sampai, $year_dari, $year_sampai), 'Data Master Target Export ' . $year_dari . ' sd ' . $year_sampai . '.xlsx');
            }
        } else {
            return "bbbb";
        }
    }
}
