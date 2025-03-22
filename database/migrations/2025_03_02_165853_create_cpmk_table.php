<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cpmk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cpmk')->unique();
            $table->text('deskripsi_cpmk');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cpmk');
    }
};
