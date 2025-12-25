<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hasil_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->decimal('total_nilai', 10, 4);
            $table->integer('ranking');
            $table->date('tanggal_perhitungan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_akhir');
    }
};
