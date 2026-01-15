<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAFIO PEDRA GRANDE | Edição 2026</title>

    @vite(['resources/css/formulario.css', 'resources/js/formulario.js'])

</head>

<body>

    <header class="main-header">
        <h1>DESAFIO PEDRA GRANDE</h1>
        <nav>
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="#o-desafio">O Desafio</a></li>
                <li><a href="#percurso">Percurso</a></li>
                <li><a href="#regulamento">Regulamento</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>
    </header>

    <main class="hero-section">
        <div class="hero-content">
            <h2>A Próxima Aventura Te Espera!</h2>
            <p>O maior desafio de mountain bike da região está de volta. Prepare-se para conquistar a Pedra Grande.</p>
            <a href="#inscricoes" class="cta-button">INSCREVA-SE AGORA</a>
        </div>
    </main>

    <!-- NOSSA HISTÓRIA -->
    <section id="o-desafio" class="section-padding">
        <div class="container">
            <h3>Nossa História e Filosofia</h3>
            <p class="section-intro">O Desafio Pedra Grande não é apenas uma corrida; é uma jornada de superação que
                celebra a beleza e a robustez do mountain bike.</p>

            <div class="feature-grid">
                <div class="feature-item">
                    <h4>🏔️ A Conquista da Pedra</h4>
                    <p>Tudo começou em 2020, com um grupo de amigos buscando um percurso que realmente testasse seus
                        limites. A Pedra Grande, com sua altitude e terreno desafiador, se tornou o palco perfeito.
                        Hoje, é uma tradição anual.</p>
                </div>
                <div class="feature-item">
                    <h4>🤝 Espírito Comunitário</h4>
                    <p>Mais do que competição, valorizamos a camaradagem. O evento é feito por ciclistas para ciclistas.
                        Oferecemos pontos de hidratação e apoio estratégico, garantindo que todos tenham as melhores
                        condições para completar a prova.</p>
                </div>
                <div class="feature-item">
                    <h4>🌿 Sustentabilidade</h4>
                    <p>Temos um forte compromisso com a preservação ambiental. O percurso é planejado para ter o mínimo
                        impacto ecológico, e incentivamos a cultura de lixo zero entre todos os participantes. Respeito
                        à natureza é a nossa regra número 1.</p>
                </div>
            </div>

            <a href="#inscricoes" class="cta-secondary">Garanta sua vaga!</a>
        </div>
    </section>

    <!-- DETALHES ESSENCIAIS -->
    <section class="section-padding section-dark">
        <div class="container">
            <h3>Detalhes Essenciais</h3>
            <p class="section-intro">Prepare-se para o desafio! Aqui estão todas as informações que você precisa para
                encarar a Pedra Grande com segurança e conhecimento.</p>

            <div id="percurso" class="info-block">
                <h4>🌄 O Percurso 2026: A Rota da Superação</h4>
                <p>O trajeto deste ano foi desenhado para testar a resistência e a técnica. Serão 45km com altimetria
                    acumulada de 1.800 metros. Fique atento aos pontos-chave:</p>
                <ul>
                    <li>Largada e Chegada: Praça Central de Igarapé.</li>
                    <li>Ponto Mais Alto: 1450m (Acesso Norte da Pedra Grande).</li>
                    <li>Trechos Técnicos: 5km de single-track na Mata do Roncador.</li>
                    <li>Pontos de Apoio (PA): PA-1 (Km 15) e PA-2 (Km 30), com hidratação e frutas.</li>
                </ul>
                <div class="map-placeholder">
                    [ Placeholder para o mapa interativo do percurso (Google Maps/Strava) ]
                </div>
                <a href="#" class="btn-download">⬇️ Baixar GPX do Percurso</a>
            </div>

            <div id="regulamento" class="info-block">
                <h4>📜 Regulamento e Cronograma</h4>
                <p>Leia o regulamento completo para garantir sua participação e segurança. Seguem os pontos principais e
                    o cronograma do dia:</p>

                <div class="reg-columns">
                    <div class="reg-item">
                        <h5>Regras Chave</h5>
                        <ol>
                            <li>Uso obrigatório de capacete.</li>
                            <li>É proibido jogar lixo no percurso.</li>
                            <li>Idade mínima de 18 anos para a categoria Pro.</li>
                            <li>Respeito total à equipe de apoio.</li>
                        </ol>
                    </div>
                    <div class="reg-item">
                        <h5>Cronograma (Sábado, 15/05/2026)</h5>
                        <ul>
                            <li>06:00h - Retirada de Kits (Praça Central)</li>
                            <li>07:30h - Fechamento do Grid</li>
                            <li>08:00h - Largada Principal (Pro/Sport)</li>
                            <li>12:00h - Início da Premiação</li>
                            <li>14:00h - Encerramento do Evento</li>
                        </ul>
                    </div>
                </div>
                <a href="#" class="btn-download">📄 Regulamento Completo (PDF)</a>
            </div>
        </div>
    </section>

    <!-- INSCRIÇÕES -->
    <section id="inscricoes" class="section-padding">
        <div class="container">
            <h3>Preparado para o Desafio?</h3>
            <p class="section-intro">Garanta sua vaga no lote promocional! Preencha o formulário abaixo e receba todas
                as instruções de pagamento e retirada de kit.</p>

            <div class="registration-layout">

                <form id="registration-form" class="registration-form">
                    <h4>Dados do Ciclista</h4>

                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" placeholder="Ex: (31) 99999-0000" required>
                    </div>

                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="Ex: 000.000.000-00" required>
                    </div>

                    <div class="form-group">
                        <label for="dataNascimento">Data de Nascimento</label>
                        <input type="date" id="dataNascimento" name="dataNascimento" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria de Participação</label>
                        <select id="categoria" name="categoria" required>
                            <option value="">Selecione a Categoria</option>
                            <option value="pro">Pro (Avançado - 45km)</option>
                            <option value="sport">Sport (Intermediário - 30km)</option>
                            <option value="turismo">Turismo (Iniciante - 15km)</option>
                        </select>
                    </div>

                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="aceite" name="aceite" required>
                        <label for="aceite">Li e aceito o <a href="#regulamento">Regulamento Oficial</a> do
                            evento.</label>
                    </div>

                    <button type="submit" class="cta-button">Confirmar Inscrição e Pagar</button>
                    <p class="form-note">Você será redirecionado para a página de pagamento após a confirmação.</p>
                </form>

                <div class="reg-info-sidebar">
                    <h4>Lotes e Valores</h4>
                    <ul class="price-list">
                        <li>**1º Lote (Promocional):** R$ 120,00 (Até 31/12)</li>
                        <li>**2º Lote:** R$ 150,00 (Janeiro)</li>
                        <li>**3º Lote:** R$ 180,00 (Fevereiro)</li>
                    </ul>

                    <h4>O que o Kit Inclui?</h4>
                    <ul class="kit-list">
                        <li>Camisa de Ciclismo Personalizada</li>
                        <li>Placa de Identificação da Bike</li>
                        <li>Chip de Cronometragem</li>
                        <li>Medalha de Participação (Pós-prova)</li>
                        <li>Seguro Atleta</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <footer class="main-footer">

        <hr>


        <footer class="main-footer">
            <p>&copy; 2026 DESAFIO PEDRA GRANDE. Todos os direitos reservados.</p>
            <div class="social-links">
                <a href="#" target="_blank">Instagram</a>
                <a href="#" target="_blank">Facebook</a>
            </div>
        </footer>

</body>

</html>