<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmação de inscrição — Pedra Grande</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,inter-tight:600,700,800,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/formulario.css'])
</head>

<body class="obrigado-page">

    <div class="obrigado-wrap" data-reference="{{ $reference }}">

        <div class="obrigado-card" data-status-card>

            {{-- ESTADO: aguardando --}}
            <div class="obrigado-state" data-state="aguardando">
                <div class="obrigado-spinner" aria-hidden="true"></div>
                <h1 class="obrigado-title">Recebemos sua inscrição</h1>
                <p class="obrigado-text">
                    Estamos confirmando o pagamento junto ao PagBank.
                    <strong>Não feche esta página</strong> — ela atualiza sozinha.
                </p>
                <div class="obrigado-hint">
                    No Pix, a confirmação costuma levar até 10 minutos.
                </div>
            </div>

            {{-- ESTADO: pago --}}
            <div class="obrigado-state" data-state="pago" hidden>
                <div class="obrigado-badge obrigado-badge--ok">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="obrigado-title">Pagamento confirmado</h1>
                <p class="obrigado-text">
                    Sua inscrição na Pedra Grande está garantida.
                    Enviamos os detalhes para o e-mail cadastrado.
                </p>
                <dl class="obrigado-dl" data-detalhes hidden>
                    <div><dt>Atleta</dt><dd data-d="nome">—</dd></div>
                    <div><dt>Categoria</dt><dd data-d="categoria">—</dd></div>
                    <div><dt>Percurso</dt><dd data-d="percurso">—</dd></div>
                    <div><dt>Pagamento</dt><dd data-d="pagamento">—</dd></div>
                    <div class="obrigado-dl__total"><dt>Valor pago</dt><dd data-d="valor_pago">—</dd></div>
                    <div class="obrigado-dl__total"><dt>Confirmado em</dt><dd data-d="pago_em">—</dd></div>
                </dl>
            </div>

            {{-- ESTADO: aguardando/cancelado --}}
            <div class="obrigado-state" data-state="pendente" hidden>
                <div class="obrigado-badge obrigado-badge--wait">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 7v5l3 2" />
                    </svg>
                </div>
                <h1 class="obrigado-title">Pagamento em análise</h1>
                <p class="obrigado-text">
                    Recebemos seu pedido, mas a confirmação do banco ainda não chegou.
                    Se você pagou, aguarde alguns minutos — atualizamos esta página sozinha.
                </p>
                <dl class="obrigado-dl" data-detalhes hidden>
                    <div><dt>Atleta</dt><dd data-d="nome">—</dd></div>
                    <div><dt>Valor cobrado</dt><dd data-d="valor_inscricao">—</dd></div>
                </dl>
            </div>

            {{-- ESTADO: cancelado --}}
            <div class="obrigado-state" data-state="cancelado" hidden>
                <div class="obrigado-badge obrigado-badge--bad">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </div>
                <h1 class="obrigado-title">Pagamento não concluído</h1>
                <p class="obrigado-text">
                    O pedido foi cancelado ou expirou. Você pode refazer a inscrição.
                </p>
            </div>

            {{-- ESTADO: não encontrado --}}
            <div class="obrigado-state" data-state="erro" hidden>
                <div class="obrigado-badge obrigado-badge--bad">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 8v5" />
                        <path d="M12 16.5v.01" />
                    </svg>
                </div>
                <h1 class="obrigado-title">Inscrição não encontrada</h1>
                <p class="obrigado-text">
                    Não localizamos esta referência. Confira o link do e-mail ou refaça a inscrição.
                </p>
            </div>

            <a class="btn btn--primary" href="/">Voltar ao site</a>
        </div>
    </div>

    @vite(['resources/js/obrigado.js'])
</body>

</html>
