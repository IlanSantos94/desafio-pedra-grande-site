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
        // Adiciona a coluna status. Começa como 'pendente' por padrão.
        $table->string('status')->default('pendente')->after('categoria');
        
        // Opcional: Adicionar uma coluna para guardar o ID da transação do PagBank
        $table->string('pagbank_id')->nullable()->after('status');
    });
}

public function down(): void
{
    Schema::table('cadastros', function (Blueprint $table) {
        $table->dropColumn(['status', 'pagbank_id']);
    });
}
};
