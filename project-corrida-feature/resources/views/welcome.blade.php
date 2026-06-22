<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAFIO PEDRA GRANDE | Edição 2026</title>
    @vite(['resources/css/formulario.css', 'resources/js/formulario.js'])
</head>

<body>

    <header class="main-header">
        <h1>Pedra Grande</h1>
        <nav>
            <ul>
                <li><a href="#o-desafio">O Desafio</a></li>
                <li><a href="#detalhes">Percurso</a></li>
                <li><a href="#inscricoes">Inscrição</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-badge">🏆 Edição 2026</div>
            <h2>Conquiste a<br><span>Pedra Grande</span></h2>
            <p>O maior desafio de mountain bike da região está de volta. 45km de pura superação entre trilhas, montanhas e natureza selvagem. Prepare-se para a aventura da sua vida.</p>
            <a href="#inscricoes" class="cta-button">
                Garanta Sua Vaga
                <svg viewBox="0 0 24 24"><path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/></svg>
            </a>
        </div>
        <a href="#o-desafio" class="hero-scroll">Role para conhecer</a>
    </section>

    <section id="o-desafio" class="section-padding">
        <div class="container">
            <h3>Nossa <span>História</span></h3>
            <p class="section-intro">O Desafio Pedra Grande não é apenas uma corrida — é uma jornada de superação que celebra a beleza e a robustez do mountain bike.</p>

            <div class="feature-grid">
                <div class="feature-item">
                    <div class="feature-icon">⛰️</div>
                    <h4>A Conquista da Pedra</h4>
                    <p>Tudo começou em 2020, com um grupo de amigos buscando um percurso que realmente testasse seus limites. A Pedra Grande, com sua altitude e terreno desafiador, se tornou o palco perfeito.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🤝</div>
                    <h4>Espírito Comunitário</h4>
                    <p>Mais do que competição, valorizamos a camaradagem. O evento é feito por ciclistas para ciclistas, com pontos de hidratação e apoio estratégico para todos.</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🌿</div>
                    <h4>Sustentabilidade</h4>
                    <p>Compromisso com a preservação ambiental. O percurso é planejado para mínimo impacto ecológico, e incentivamos a cultura de lixo zero entre todos os participantes.</p>
                </div>
            </div>

            <a href="#inscricoes" class="cta-secondary">Garanta sua vaga →</a>
        </div>
    </section>

    <section id="detalhes" class="section-padding section-dark">
        <div class="container">
            <h3>Detalhes <span>da Prova</span></h3>
            <p class="section-intro">Prepare-se para o desafio! Aqui estão todas as informações que você precisa para encarar a Pedra Grande.</p>

            <div class="info-grid">
                <div class="info-block">
                    <h4>🚴 O Percurso 2026</h4>
                    <p>45km com altimetria acumulada de 1.800 metros. A rota da superação passa por:</p>
                    <ul>
                        <li><strong>Largada/Chegada:</strong> Praça Central de Igarapé</li>
                        <li><strong>Ponto Mais Alto:</strong> 1450m (Acesso Norte da Pedra Grande)</li>
                        <li><strong>Trechos Técnicos:</strong> 5km de single-track na Mata do Roncador</li>
                        <li><strong>Pontos de Apoio:</strong> PA-1 (Km 15) e PA-2 (Km 30)</li>
                    </ul>
                    <div class="map-placeholder">[ Mapa interativo do percurso ]</div>
                    <a href="#" class="btn-download">⬇️ Baixar GPX do Percurso</a>
                </div>

                <div class="info-block">
                    <h4>📜 Regulamento</h4>
                    <h5>Regras Principais</h5>
                    <ol>
                        <li>Uso obrigatório de capacete</li>
                        <li>Proibido jogar lixo no percurso</li>
                        <li>Idade mínima de 18 anos para a categoria Pro</li>
                        <li>Respeito total à equipe de apoio</li>
                    </ol>
                    <a href="#" class="btn-download">📄 Regulamento Completo (PDF)</a>
                </div>

                <div class="info-block full">
                    <h4>⏰ Cronograma</h4>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:15px;">
                        <div>
                            <h5>Sábado, 15/05/2026</h5>
                            <ul>
                                <li><strong>06:00</strong> — Retirada de Kits (Praça Central)</li>
                                <li><strong>07:30</strong> — Fechamento do Grid</li>
                                <li><strong>08:00</strong> — Largada Principal</li>
                                <li><strong>12:00</strong> — Início da Premiação</li>
                                <li><strong>14:00</strong> — Encerramento</li>
                            </ul>
                        </div>
                        <div>
                            <h5>Categorias</h5>
                            <ul>
                                <li><strong>Completo (50km):</strong> Elite, Expert, Sub-30, Master A1/A2/B1/B2/C, Dupla Pro</li>
                                <li><strong>Reduzido (30km):</strong> Juvenil, Cadete, Sênior, Veterano, Master D</li>
                                <li><strong>Completo Misto:</strong> E-BIKE</li>
                                <li><strong>Reduzido Misto:</strong> PCD, Dupla Mista</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="inscricoes" class="section-padding">
        <div class="container">
            <h3>Preparado para o <span>Desafio</span>?</h3>
            <p class="section-intro">Garanta sua vaga no lote promocional! Preencha seus dados em poucas etapas.</p>

            <div class="registration-layout">
                <form id="registration-form" class="registration-form">

                    <div class="step-indicator">
                        <div class="step-progress" style="width: 0%;"></div>
                        <div class="step-item active" data-step="1">
                            <div class="step-circle">1</div>
                            <span class="step-label">Dados</span>
                        </div>
                        <div class="step-item" data-step="2">
                            <div class="step-circle">2</div>
                            <span class="step-label">Corrida</span>
                        </div>
                        <div class="step-item" data-step="3">
                            <div class="step-circle">3</div>
                            <span class="step-label">Confirmação</span>
                        </div>
                    </div>

                    <div class="form-step active" data-step="1">
                        <h4>📋 Dados Pessoais</h4>
                        <p class="form-step-desc">Conte-nos sobre você para começarmos a aventura.</p>

                        <div class="form-group">
                            <label for="nome">Nome Completo <span class="required">*</span></label>
                            <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">E-mail <span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone <span class="required">*</span></label>
                                <input type="tel" id="telefone" name="telefone" placeholder="(31) 99999-0000" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="cpf">CPF <span class="required">*</span></label>
                                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                            </div>
                            <div class="form-group">
                                <label for="dataNascimento">Data de Nascimento <span class="required">*</span></label>
                                <input type="date" id="dataNascimento" name="dataNascimento" required>
                            </div>
                        </div>

                        <div class="form-buttons">
                            <button type="button" class="btn-next" onclick="nextStep()">Próxima Etapa →</button>
                        </div>
                    </div>

                    <div class="form-step" data-step="2">
                        <h4>🚴 Dados da Corrida</h4>
                        <p class="form-step-desc">Escolha o percurso ideal para o seu estilo.</p>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="sexo">Sexo <span class="required">*</span></label>
                                <select id="sexo" name="sexo" required>
                                    <option value="">Selecione...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="percurso">Percurso <span class="required">*</span></label>
                                <select id="percurso" name="percurso" required disabled>
                                    <option value="">Informe data e sexo primeiro...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoria <span class="required">*</span></label>
                            <select id="categoria" name="categoria" required disabled>
                                <option value="">Selecione o percurso primeiro...</option>
                            </select>
                        </div>

                        <div class="form-buttons">
                            <button type="button" class="btn-prev" onclick="prevStep()">← Voltar</button>
                            <button type="button" class="btn-next" onclick="nextStep()">Revisar Inscrição →</button>
                        </div>
                    </div>

                    <div class="form-step" data-step="3">
                        <h4>✅ Revisar e Confirmar</h4>
                        <p class="form-step-desc">Confira seus dados antes de finalizar.</p>

                        <div id="review-data" style="background:var(--bg);padding:20px;border-radius:10px;margin-bottom:20px;">
                            <p style="color:var(--text-light);font-size:.85em;">Carregando dados...</p>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="aceite" name="aceite" required>
                            <label for="aceite">Li e aceito o <a href="#regulamento" target="_blank">Regulamento Oficial</a> do evento.</label>
                        </div>

                        <div class="form-buttons" style="flex-direction:column;">
                            <button type="button" class="btn-prev" onclick="prevStep()" style="width:100%;justify-content:center;">← Voltar e Editar</button>
                            <button type="submit" class="btn-submit">💳 Confirmar Inscrição e Pagar</button>
                            <p class="form-note">Você será redirecionado para a página de pagamento após a confirmação.</p>
                        </div>
                    </div>

                </form>

                <div class="reg-info-sidebar">
                    <div class="sidebar-header">
                        <h4>Lotes e Valores</h4>
                        <div class="price-highlight">
                            R$ 109 <small>1º Lote Promocional</small>
                        </div>
                    </div>
                    <ul class="price-list">
                        <li>
                            <span class="lote-name">1º Lote (Promocional)</span>
                            <span class="lote-value">R$ 109</span>
                        </li>
                        <li>
                            <span class="lote-name">2º Lote</span>
                            <span class="lote-value">R$ 150</span>
                        </li>
                        <li>
                            <span class="lote-name">3º Lote</span>
                            <span class="lote-value">R$ 180</span>
                        </li>
                    </ul>

                    <h4 style="font-family:'Oswald',sans-serif;color:var(--secondary);font-size:1.1em;margin-bottom:15px;text-transform:uppercase;">Kit do Atleta</h4>
                    <ul class="kit-list">
                        <li>Camisa de Ciclismo Personalizada</li>
                        <li>Placa de Identificação da Bike</li>
                        <li>Chip de Cronometragem</li>
                        <li>Medalha de Participação</li>
                        <li>Seguro Atleta</li>
                    </ul>

                    <div class="sidebar-cta">
                        <small>✋ Vagas limitadas! Garanta a sua agora.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <p>&copy; 2026 DESAFIO PEDRA GRANDE. Todos os direitos reservados.</p>
        <div class="social-links">
            <a href="#" target="_blank">Instagram</a>
            <a href="#" target="_blank">Facebook</a>
        </div>
    </footer>

</body>
</html>
