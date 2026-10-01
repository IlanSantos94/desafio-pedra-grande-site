<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            // Valor cobrado no checkout (R$)
            $table->decimal('valor_inscricao', 10, 2)->nullable()->after('pagamento');

            // Valor efetivamente pago, preenchido pelo webhook (R$)
            $table->decimal('valor_pago', 10, 2)->nullable()->after('valor_inscricao');

            // Referencia enviada ao PagBank ("ID_<id>") — usada para casar o webhook
            $table->string('pagbank_reference')->nullable()->after('valor_pago');

            // Momento da confirmacao do pagamento
            $table->timestamp('pago_em')->nullable()->after('pagbank_reference');

            $table->index('pagbank_reference');
        });
    }

    public function down(): void
    {
        Schema::table('cadastros', function (Blueprint $table) {
            $table->dropIndex(['pagbank_reference']);
            $table->dropColumn(['valor_inscricao', 'valor_pago', 'pagbank_reference', 'pago_em']);
        });
    }
};
