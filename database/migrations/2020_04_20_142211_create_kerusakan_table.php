<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKerusakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fasilitas_id')->unsigned();
            $table->string('foto');
            $table->integer('total');
            $table->string('biaya')->nullable();
            $table->enum('status', ['Pending', 'Proses', 'Approved', 'Cancel'])->default('pending');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('fasilitas_id')->references('id')->on('fasilitas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kerusakan');
    }
}
