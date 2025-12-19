<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alternatif', 10)->unique();
            $table->string('nama_supplier');
            $table->string('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('email')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alternatif');
    }
};
