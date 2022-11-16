<?php

namespace Database\Seeders;

use App\Models\M_masterDataTarget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        M_masterDataTarget::create([
            'kode_rekening' => 1,
            'target' => 70500000,
            'tgl_mulai' => '2021-01-01',
            'tgl_akhir' => '2021-01-31'
        ]);

        M_masterDataTarget::create([
            'kode_rekening' => 2,
            'target' => 70750000,
            'tgl_mulai' => '2021-01-01',
            'tgl_akhir' => '2021-01-31'
        ]);

        M_masterDataTarget::create([
            'kode_rekening' => 1,
            'target' => 60500000,
            'tgl_mulai' => '2022-01-01',
            'tgl_akhir' => '2022-01-31'
        ]);

        M_masterDataTarget::create([
            'kode_rekening' => 2,
            'target' => 50750000,
            'tgl_mulai' => '2022-01-01',
            'tgl_akhir' => '2022-01-31'
        ]);

        M_masterDataTarget::create([
            'kode_rekening' => 3,
            'target' => 50500000,
            'tgl_mulai' => '2022-01-01',
            'tgl_akhir' => '2022-01-31'
        ]);

        M_masterDataTarget::create([
            'kode_rekening' => 4,
            'target' => 50250000,
            'tgl_mulai' => '2022-01-01',
            'tgl_akhir' => '2022-01-31'
        ]);

        M_masterDataTarget::create([
            'kode_rekening' => 5,
            'target' => 50000000,
            'tgl_mulai' => '2022-01-01',
            'tgl_akhir' => '2022-01-31'
        ]);
    }
}
