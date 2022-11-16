<?php

namespace Database\Seeders;

use App\Models\M_entryTransHarian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntryTransHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        M_entryTransHarian::create([
            'kode_rekening' => 1,
            'via_bayar' => 2,
            'tgl_setor' => '2021-10-02',
            'jml_bayar' => 2000000
        ]);
        M_entryTransHarian::create([
            'kode_rekening' => 3,
            'via_bayar' => 1,
            'tgl_setor' => '2021-10-02',
            'jml_bayar' => 1500000
        ]);
        M_entryTransHarian::create([
            'kode_rekening' => 2,
            'via_bayar' => 2,
            'tgl_setor' => '2021-10-09',
            'jml_bayar' => 1750000
        ]);
        M_entryTransHarian::create([
            'kode_rekening' => 1,
            'via_bayar' => 1,
            'tgl_setor' => '2021-10-11',
            'jml_bayar' => 2000000
        ]);
    }
}
