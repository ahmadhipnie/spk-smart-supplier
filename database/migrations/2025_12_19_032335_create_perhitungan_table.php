<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('perhitungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->decimal('nilai_utility', 10, 4);
            $table->decimal('bobot_kriteria', 5, 2);
            $table->decimal('nilai_akhir', 10, 4);
            $table->timestamps();
            
            $table->unique(['alternatif_id', 'kriteria_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('perhitungan');
    }
};
