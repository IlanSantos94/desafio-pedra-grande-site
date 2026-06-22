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
        Schema::table('cadastros', function (Blueprint $table) {
            // Adicionamos os novos campos
            $table->string('percurso')->nullable();
            $table->string('sexo', 1)->nullable(); // 'M' ou 'F'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            // Removemos os campos caso você precise desfazer a migration
            $table->dropColumn(['percurso', 'sexo']);
        });
    }
};