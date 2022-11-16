<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_trans_harian', function (Blueprint $table) {
            $table->increments('id');
            $table->float('kode_rekening');
            $table->string('nama_rekening');
            $table->integer('via_bayar');
            $table->date('tgl_setor');
            $table->integer('jml_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_trans_harian');
    }
};
