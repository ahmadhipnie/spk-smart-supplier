<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('hasil_perhitungan', function (Blueprint $table) {
        $table->id('id_hasil');
        $table->unsignedBigInteger('id_supplier');
        $table->decimal('nilai_utility', 10, 6);
        $table->integer('ranking');
        $table->timestamps();
        
        $table->foreign('id_supplier')->references('id_supplier')->on('supplier')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_perhitungan');
    }
};
