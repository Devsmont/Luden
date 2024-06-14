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
        Schema::create('rpgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rpg_system_id');
            $table->unsignedBigInteger('master_id');
            $table->string('name');
            $table->longText('description');
            $table->foreign('rpg_system_id')
                ->references('id')
                ->on('rpg_systems')
                ->onDelete('cascade');
            $table->string('image_url');
            $table->dateTime('rpg_date');
            $table->foreign('master_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpgs');
    }
};
