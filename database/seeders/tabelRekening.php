<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabelRekening extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabel_rekening')->insert([
            'kode_rekening' => 41101.01,
            'nama_rekening' => 'Pajak Hotel Bintang 1',
        ]);
        DB::table('tabel_rekening')->insert([
            'kode_rekening' => 41101.02,
            'nama_rekening' => 'Pajak Hotel Bintang 2',
        ]);
        DB::table('tabel_rekening')->insert([
            'kode_rekening' => 41101.03,
            'nama_rekening' => 'Pajak Hotel Bintang 3',
        ]);
        DB::table('tabel_rekening')->insert([
            'kode_rekening' => 41101.04,
            'nama_rekening' => 'Pajak Hotel Bintang 4',
        ]);
        DB::table('tabel_rekening')->insert([
            'kode_rekening' => 41101.05,
            'nama_rekening' => 'Pajak Hotel Bintang 5',
        ]);
    }
}
