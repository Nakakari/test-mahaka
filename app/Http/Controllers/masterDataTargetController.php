<?php

namespace App\Http\Controllers;

use App\Exports\allData_masterDataTargetExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\masterDataTargetExport;
use App\Models\M_masterDataTarget;
use App\Models\M_rekening;
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
            'tabel_rekening.kode_rekening',
            'target',
            'tgl_mulai',
            'tgl_akhir',
            'tabel_rekening.nama_rekening'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_masterDataTarget::select([
            'master_data_target.id',
            'tabel_rekening.kode_rekening',
            'tabel_rekening.nama_rekening',
            'target',
            DB::raw("(DATE_FORMAT(tgl_mulai,'%m-%d-%Y')) as tgl_mulai_c"),
            DB::raw("(DATE_FORMAT(tgl_akhir,'%m-%d-%Y')) as tgl_akhir_c"),
            'tgl_akhir',
            'tgl_mulai',
        ])
            ->join('tabel_rekening', 'tabel_rekening.id', '=', 'master_data_target.kode_rekening')
            ->orderBy('created_at', "desc");

        if (request()->input('dari') != null && request()->input('sampai') != null) {
            $data = $data->where('master_data_target.tgl_mulai', '>=', request()->dari)
                ->where('master_data_target.tgl_akhir', '<=',  request()->sampai);
        }

        if (request()->input("search.value") != null) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(tabel_rekening.nama_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%'])
                    ->orWhereRaw('LOWER(tabel_rekening.kode_rekening) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
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

    public function form_add_data()
    {
        $data = [
            'title' => 'Tambah Data Target',
            'rekening' => M_rekening::all()
        ];
        return view('masterDataTarget.v_add', $data);
    }

    public function add_data(Request $request)
    {
        // dd(request()->all());
        $this->validate(
            $request,
            [
                'kode_rekening'  => ['required'],
                'target'  => ['required', 'min:1', 'max:20'],
                'awal_berlaku'  =>  'required',
                'akhir_berlaku'  =>  'required',
            ],
            [
                'kode_rekening.required' => 'Wajib.',
                'target.required'  => 'Wajib diisi.',
                'awal_berlaku.required'  => 'Wajib diisi.',
                'akhir_berlaku.required'  => 'Wajib diisi.',
            ]
        );
        $data = [
            'kode_rekening' => Request()->kode_rekening,
            'target' => Request()->target,
            'tgl_mulai' => Request()->awal_berlaku,
            'tgl_akhir' => Request()->akhir_berlaku,
        ];
        M_masterDataTarget::create($data);
        return redirect('/data_target')->with('pesan', 'Data Berhasil Disimpan');
    }

    public function delete_data()
    {
        // dd(request()->all());
        $item = M_masterDataTarget::findOrFail(request()->input('id'));
        $item->delete();
        return response()->json(true);
    }

    public function form_edit_data($id)
    {
        $data = [
            'title' => 'Edit Data Target',
            'rekening' => M_rekening::all(),
            'items' => M_masterDataTarget::getById($id),
            'id' => $id
        ];
        // dd($data['items']);
        return view('masterDataTarget.v_edit', $data);
    }

    public function edit_data(Request $request)
    {
        // dd(request()->all());
        $this->validate(
            $request,
            [
                'kode_rekening'  => ['required'],
                'target'  => ['required', 'min:1', 'max:20'],
                'awal_berlaku'  =>  'required',
                'akhir_berlaku'  =>  'required',
            ],
            [
                'kode_rekening.required' => 'Wajib.',
                'target.required'  => 'Wajib diisi.',
                'awal_berlaku.required'  => 'Wajib diisi.',
                'akhir_berlaku.required'  => 'Wajib diisi.',
            ]
        );
        $data = [
            'kode_rekening' => request()->get('kode_rekening'),
            'target' => request()->get('target'),
            'tgl_mulai' => request()->get('awal_berlaku'),
            'tgl_akhir' => request()->get('akhir_berlaku'),
        ];
        DB::table('master_data_target')->where('id', request()->get('id'))
            ->update($data);
        return redirect('/data_target')->with('pesan', 'Data Berhasil Diedit');
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
            // dd(M_masterDataTarget::lastTanggal()->tgl_sampai);
            return Excel::download(new allData_masterDataTargetExport, 'All Data Master Target Export.xlsx');
        }
    }

    public function downloadPDF()
    {
        $dari = request()->input('dari');
        $sampai = request()->input('sampai');

        $year_dari = Carbon::createFromFormat('Y-m-d', $dari)->format('Y');
        $year_sampai = Carbon::createFromFormat('Y-m-d', $sampai)->format('Y');

        $data = [
            'items' => M_masterDataTarget::basedTanggal($dari, $sampai),
            'tahun_awal' => $year_dari,
            'tahun_akhir' => $year_sampai,
            'tgl_sampai' => $sampai,
        ];

        $pdf = PDF::loadView('masterDataTarget.v_exportPdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Data Master Target Export ' . $year_dari . '.pdf');
    }
}
