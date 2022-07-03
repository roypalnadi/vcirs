<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilihanNarasumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilihan_narasumber', function (Blueprint $table) {
            $table->id();
            $table->integer('narasumber_id')->nullable();
            $table->integer('gejala_id')->nullable();
            $table->integer('pilihan_id')->nullable();
            $table->float('nilai_user')->nullable();
            $table->float('nilai_pakar')->nullable();
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
        Schema::dropIfExists('pilihan_narasumber');
    }
}
