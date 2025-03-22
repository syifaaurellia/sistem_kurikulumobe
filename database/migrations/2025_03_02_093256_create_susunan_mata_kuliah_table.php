<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('susunan_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade');
            $table->boolean('semester_1')->default(false);
            $table->boolean('semester_2')->default(false);
            $table->boolean('semester_3')->default(false);
            $table->boolean('semester_4')->default(false);
            $table->boolean('semester_5')->default(false);
            $table->boolean('semester_6')->default(false);
            $table->boolean('semester_7')->default(false);
            $table->boolean('semester_8')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('susunan_mata_kuliah');
    }
};
