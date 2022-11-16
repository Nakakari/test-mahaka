<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntryViaPembayaran extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('via_pembayaran')->insert([
            'via_bayar' => 'Bank',
        ]);
        DB::table('via_pembayaran')->insert([
            'via_bayar' => 'Bendahara',
        ]);
    }
}
