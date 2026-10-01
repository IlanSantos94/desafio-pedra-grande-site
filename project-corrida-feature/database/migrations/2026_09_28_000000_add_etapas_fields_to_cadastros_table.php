<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            $table->string('modalidade')->nullable()->after('percurso');
            $table->string('kit')->nullable()->after('modalidade');
            $table->string('tamanho')->nullable()->after('kit');
            $table->string('pagamento')->nullable()->after('tamanho');
            $table->boolean('aceite')->default(false)->after('pagamento');
        });
    }

    public function down(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            $table->dropColumn(['modalidade', 'kit', 'tamanho', 'pagamento', 'aceite']);
        });
    }
};
