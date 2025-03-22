<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bk_mk', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('kode_mk');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bk_mk');
    }
};

