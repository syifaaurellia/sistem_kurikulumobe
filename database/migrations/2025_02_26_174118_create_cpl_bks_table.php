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
        Schema::create('cpl_bk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cpl', 10)->nullable();
            $table->string('kode', 10)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpl_bks');
    }
};
