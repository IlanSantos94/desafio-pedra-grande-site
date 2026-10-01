/* Página de confirmação: consulta o status da inscrição e atualiza sozinha. */
(function () {
    'use strict';

    const wrap = document.querySelector('.obrigado-wrap');
    if (!wrap) return;

    const reference = wrap.dataset.reference;

    const brl = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });
    const ROTULO_PAGAMENTO = { pix: 'Pix', cartao: 'Cartão de crédito' };
    const ROTULO_STATUS = {
        pago: 'pago',
        aguardando: 'pendente',
        pendente: 'pendente',
        cancelado: 'cancelado'
    };

    /* O Pix pode confirmar bem depois dos 5 minutos, então a janela é de 15. */
    const INTERVALO = 5000;
    const MAX_TENTATIVAS = 180;

    let tentativas = 0;
    let finalizado = false;
    let ultimo = {};

    const bloco = (estado) => wrap.querySelector('[data-state="' + estado + '"]');

    function mostrar(estado) {
        wrap.querySelectorAll('[data-state]').forEach(function (el) {
            el.hidden = el.dataset.state !== estado;
        });
    }

    /* Precisa ser por estado: cada estado tem o seu proprio <dl data-detalhes>. */
    function preencher(estado, campos) {
        const alvo = bloco(estado);
        const dl = alvo && alvo.querySelector('[data-detalhes]');
        if (!dl) return;

        dl.querySelectorAll('[data-d]').forEach(function (dd) {
            const chave = dd.dataset.d;
            if (!(chave in campos)) return;

            const bruto = campos[chave];
            let texto = bruto === null || bruto === '' ? '—' : bruto;

            if (chave === 'valor_pago' || chave === 'valor_inscricao') {
                texto = bruto ? brl.format(bruto) : '—';
            }
            if (chave === 'pagamento') {
                texto = ROTULO_PAGAMENTO[bruto] || bruto || '—';
            }
            dd.textContent = texto;
        });

        dl.hidden = false;
    }

    function avisarTimeout() {
        const alvo = bloco('pendente');
        const texto = alvo && alvo.querySelector('.obrigado-text');
        if (!texto) return;

        texto.textContent = 'A confirmação do banco ainda não chegou. Se você pagou, ' +
            'espere alguns minutos e recarregue esta página para atualizar.';
    }

    function consultar() {
        if (!reference) { mostrar('erro'); return; }

        fetch('/api/cadastros/' + encodeURIComponent(reference) + '/status', {
            headers: { Accept: 'application/json' }
        })
            .then(function (r) { return r.ok ? r.json() : Promise.reject(r.status); })
            .then(function (dados) {
                if (!dados.found) { mostrar('erro'); finalizado = true; return; }

                ultimo = dados;

                const estado = ROTULO_STATUS[dados.status] || 'pendente';
                mostrar(estado);

                if (dados.valor_pago !== null || estado === 'pendente') preencher(estado, dados);

                if (estado === 'pago' || estado === 'cancelado') finalizado = true;
            })
            .catch(function () { /* mantém tentando */ })
            .finally(function () {
                if (finalizado) return;

                tentativas += 1;
                if (tentativas < MAX_TENTATIVAS) {
                    setTimeout(consultar, INTERVALO);
                    return;
                }

                mostrar('pendente');
                preencher('pendente', ultimo);
                avisarTimeout();
            });
    }

    consultar();
})();