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
            $table->integer('kode_rekening');
            $table->integer('via_bayar');
            $table->date('tgl_setor');
            $table->bigInteger('jml_bayar');
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
