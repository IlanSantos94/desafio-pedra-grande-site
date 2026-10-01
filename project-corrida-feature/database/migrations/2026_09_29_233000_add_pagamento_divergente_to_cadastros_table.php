<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            // true quando o valor confirmado pelo PagBank difere do valor cobrado
            $table->boolean('pagamento_divergente')->default(false)->after('valor_pago');
        });
    }

    public function down(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            $table->dropColumn('pagamento_divergente');
        });
    }
};
