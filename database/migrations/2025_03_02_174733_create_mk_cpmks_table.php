<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('mk_cpmks', function (Blueprint $table) {
        $table->id();
        $table->string('kode_mk'); // Simpan kode MK tanpa foreign key
        $table->string('kode_cpmk'); // Simpan kode CPMK tanpa foreign key
        $table->timestamps();
    });    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mk_cpmks');
    }
};
