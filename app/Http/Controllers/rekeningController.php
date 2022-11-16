<?php

namespace App\Http\Controllers;

use App\Models\M_rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rekeningController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Master Data Daftar Rekening',
        ];
        return view('rekening.v_index', $data);
    }

    public function list_rekening(Request $request)
    {
        $columns = [
            'kode_rekening',
            'nama_rekening'
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = M_rekening::select([
            'id',
            'kode_rekening',
            'nama_rekening',
        ])
            ->orderBy('id', "desc");

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

    public function add_rekening(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'kode_rekening'  => ['required', 'min:1', 'max:8', 'unique:tabel_rekening'],
            'nama_rekening'  => 'required',
        ], [
            'kode_rekening.required' => 'Kode Rekening sudah terpakai.',
            'nama_rekening.required'  => 'Nama rekening wajib diisi.',
        ]);
        $data = [
            'kode_rekening' => request()->get('kode_rekening'),
            'nama_rekening' => request()->get('nama_rekening'),
        ];
        M_rekening::create($data);
        return redirect('/rekening')->with('pesan', 'Data Berhasil Ditambahkan');
    }

    public function edit_rekening(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'kode_rekening'  => ['required', 'min:1', 'max:8'],
            'nama_rekening'  => 'required',
        ]);
        $data = [
            'kode_rekening' => request()->get('kode_rekening'),
            'nama_rekening' => request()->get('nama_rekening'),
        ];
        DB::table('tabel_rekening')->where('id', request()->get('id'))
            ->update($data);
        return response()->json(true);
    }

    public function delete_rekening()
    {
        // dd(request()->all());
        $item = M_rekening::findOrFail(request()->input('id'));
        $item->delete();
        return response()->json(true);
    }
}
