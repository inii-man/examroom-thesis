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
        Schema::create('light_houses', function (Blueprint $table) {
            $table->id('light_house_id');
            $table->string('light_house_name');
            $table->string('light_house_type');
            $table->string('light_house_address');
            $table->string('light_house_structure');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('light_houses');
    }
};
