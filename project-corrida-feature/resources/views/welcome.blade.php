<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Desafio Pedra Grande — Mountain Bike em Igarapé, MG. 50km e 30km de trilha, altimetria e natureza. Inscreva-se.">

    <title>Desafio Pedra Grande — Mountain Bike</title>
    <link rel="icon" type="image/png" href="images/logo.png" sizes="35x35">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,inter-tight:600,700,800,900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    @vite(['resources/css/formulario.css', 'resources/js/formulario.js'])
</head>

<body>

    {{-- ================= HEADER ================= --}}
    <header class="site-header">
        <div class="site-header__inner">
            <a href="#topo" class="site-logo" aria-label="Desafio Pedra Grande — início">
                <img src="{{ asset('images/logo.png') }}" alt="Desafio Pedra Grande" width="800" height="800"
                        loading="lazy" decoding="async">
            </a>

            <div class="site-search">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"
                    stroke-linecap="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" />
                    <path d="M20 20l-3.5-3.5" />
                </svg>
                <input type="search" placeholder="Busque eventos, percursos ou conteúdos"
                    aria-label="Buscar no site">
            </div>

            <nav class="site-nav" aria-label="Navegação principal">
                <a href="#eventos">Eventos</a>
                <a href="#inscricoes">Inscrições</a>
                <a href="#galeria">Galeria</a>
                <a href="#o-desafio">O Desafio</a>
            </nav>

            <button class="nav-toggle" type="button" aria-label="Abrir menu" aria-expanded="false"
                data-nav-toggle>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" aria-hidden="true">
                    <path d="M3 6h18M3 12h18M3 18h18" />
                </svg>
            </button>
        </div>

        <nav class="site-nav--mobile" id="menu-mobile" aria-label="Navegação mobile">
            <a href="#eventos">Eventos</a>
            <a href="#inscricoes">Inscrições</a>
            <a href="#galeria">Galeria</a>
            <a href="#o-desafio">O Desafio</a>
            <a href="#patrocinadores">Patrocinadores</a>
        </nav>
    </header>

    <main id="topo">

{{-- ================= HERO ================= --}}
        {{-- Base44: imagem contida (nao full-bleed), cantos inferiores
             arredondados, overlay leve e texto fora da imagem no mobile. --}}
        <section class="hero">
            <div class="hero__container">
                <div class="hero__frame">
                    <div class="hero__media">
                        <img src="{{ asset('images/largada.jpeg') }}"
                            alt="Largada do VIII Desafio Pedra Grande" width="3648" height="5472"
                            decoding="async" fetchpriority="high">
                    </div>
                    <div class="hero__overlay"></div>

                    <div class="hero__content">
                        <div class="hero__content-inner">
                            <span class="hero__badge">Evento oficial DPG</span>
                            <h1 class="hero__title">Conquiste a Pedra Grande</h1>
                            <p class="hero__text">Esporte, natureza e pessoas que fazem o Desafio Pedra Grande
                                acontecer.</p>
                            <a href="#inscricoes" class="btn btn--primary hero__cta">
                                Inscrever-se
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Mobile: conteudo abaixo da imagem, sem overlay --}}
                <div class="hero__below">
                    <span class="hero__badge hero__badge--soft">Evento oficial DPG</span>
                    <h1 class="hero__title hero__title--ink">Conquiste a Pedra Grande</h1>
                    <p class="hero__text hero__text--ink">Esporte, natureza e pessoas que fazem o Desafio Pedra Grande
                        acontecer.</p>
                    <a href="#inscricoes" class="btn btn--primary btn--block hero__cta--block">
                        Inscrever-se
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- ================= EVENTOS ================= --}}
        <section class="section" id="eventos">
            <div class="container">
                <div class="head-row">
                    <div class="section-head" style="margin-bottom:0">
                        <h2 class="section-title">Eventos em destaque</h2>
                        <p class="section-sub">O Desafio Pedra Grande e eventos parceiros</p>
                    </div>
                    <a href="#inscricoes" class="link-more">
                        Ver todos
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>

                <div class="event-grid">

                    <article class="event-card">
                        <div class="event-card__media">
                            <img src="{{ asset('images/largada.jpeg') }}" alt="Percurso do Desafio Pedra Grande"
                                width="3648" height="5472" loading="lazy" decoding="async">
                            <span class="event-card__tag event-card__tag--official">Evento oficial DPG</span>
                        </div>
                        <div class="event-card__body">
                            <h3 class="event-card__title">Desafio Pedra Grande</h3>
                            <div class="event-card__meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" aria-hidden="true">
                                        <rect x="3" y="5" width="18" height="16" rx="2" />
                                        <path d="M8 3v4M16 3v4M3 11h18" />
                                    </svg>
                                    25/04/2027
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z" />
                                        <circle cx="12" cy="10" r="2.5" />
                                    </svg>
                                    Igarapé — MG
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 17l6-9 4 5 3-4 5 8z" />
                                    </svg>
                                    30 km e 55 km
                                </span>
                            </div>
                            <div class="event-card__foot">
                                <a href="#inscricoes" class="btn btn--primary">Inscrever-se</a>
                            </div>
                        </div>
                    </article>

                    <article class="event-card">
                        <div class="event-card__media">
                            <img src="{{ asset('images/action-trail.jpg') }}" alt="Trilha do Serra Mineira MTB Challenge"
                                width="1600" height="1067" loading="lazy" decoding="async">
                            <span class="event-card__tag">Evento parceiro</span>
                        </div>
                        <div class="event-card__body">
                            <h3 class="event-card__title">Serra Mineira MTB Challenge</h3>
                            <div class="event-card__meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" aria-hidden="true">
                                        <rect x="3" y="5" width="18" height="16" rx="2" />
                                        <path d="M8 3v4M16 3v4M3 11h18" />
                                    </svg>
                                    A definir
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z" />
                                        <circle cx="12" cy="10" r="2.5" />
                                    </svg>
                                    Igarapé — MG
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 17l6-9 4 5 3-4 5 8z" />
                                    </svg>
                                    35 km e 60 km
                                </span>
                            </div>
                            <div class="event-card__foot">
                                <a href="#inscricoes" class="btn btn--ghost">Em breve</a>
                            </div>
                        </div>
                    </article>

                    <article class="event-card">
                        <div class="event-card__media">
                            <img src="{{ asset('images/rider-smile.jpg') }}" alt="Ciclista do Trail Run Serra Verde"
                                width="1600" height="2400" loading="lazy" decoding="async">
                            <span class="event-card__tag">Evento parceiro</span>
                        </div>
                        <div class="event-card__body">
                            <h3 class="event-card__title">Trail Run Serra Verde</h3>
                            <div class="event-card__meta">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" aria-hidden="true">
                                        <rect x="3" y="5" width="18" height="16" rx="2" />
                                        <path d="M8 3v4M16 3v4M3 11h18" />
                                    </svg>
                                    A definir
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 21s-7-5.5-7-11a7 7 0 1114 0c0 5.5-7 11-7 11z" />
                                        <circle cx="12" cy="10" r="2.5" />
                                    </svg>
                                    Nova Lima — MG
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 17l6-9 4 5 3-4 5 8z" />
                                    </svg>
                                    5 km, 10 km e 21 km
                                </span>
                            </div>
                            <div class="event-card__foot">
                                <a href="#inscricoes" class="btn btn--ghost">Em breve</a>
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        {{-- ================= SOBRE / O DESAFIO ================= --}}
        <section class="section topo" id="o-desafio">
            <div class="container about">
                <div>
                    <span class="eyebrow">Sobre o Desafio</span>
                    <h2 class="section-title about__title">Três décadas sobre duas rodas</h2>
                    <p class="about__text">O Desafio Pedra Grande nasceu em Igarapé, Minas Gerais, e desde 2017 reúne
                        atletas, famílias e apaixonados pelo ciclismo em uma experiência marcada por esporte, natureza e
                        superação.</p>
                    <p class="about__text">Mais do que competição, o evento é feito por ciclistas para ciclistas. Cada
                        edição passa mais longe, mais alto e mais difícil — mas o bater do coração de sempre
                        permanece o mesmo: chegar junto.</p>

                    <dl class="about__stats">
                        <div>
                            <dt>50 km</dt>
                            <dd>Percurso completo</dd>
                        </div>
                        <div>
                            <dt>30 km</dt>
                            <dd>Percurso reduzido</dd>
                        </div>
                        <div>
                            <dt>2017</dt>
                            <dd>Primeira edição</dd>
                        </div>
                    </dl>
                </div>

                <div class="about__media">
                    <img src="{{ asset('images/team-group.jpg') }}" alt="Equipe do Desafio Pedra Grande"
                        width="1600" height="1067" loading="lazy" decoding="async">
                </div>
            </div>
        </section>

        {{-- ================= GALERIA ================= --}}
        <section class="section" id="galeria">
            <div class="container">
                <div class="head-row">
                    <div class="section-head" style="margin-bottom:0">
                        <span class="eyebrow">Viva o Desafio</span>
                        <h2 class="section-title">Histórias que ficam</h2>
                        <p class="section-sub">Registros de quem encarou a montanha</p>
                    </div>
                </div>

                <div class="gallery">
                    <div class="gallery__item gallery__item--wide">
                        <img src="{{ asset('images/trophies.jpg') }}" alt="Troféus do Desafio Pedra Grande"
                            width="1600" height="1067" loading="lazy" decoding="async">
                    </div>
                    <div class="gallery__item gallery__item--tall">
                        <img src="{{ asset('images/podium-duo.jpg') }}" alt="Dupla no pódio"
                            width="1600" height="2400" loading="lazy" decoding="async">
                    </div>
                    <div class="gallery__item gallery__item--square">
                        <img src="{{ asset('images/podium-women.jpg') }}" alt="Ciclistas no pódio"
                            width="1600" height="1067" loading="lazy" decoding="async">
                    </div>
                    <div class="gallery__item gallery__item--square">
                        <img src="{{ asset('images/podium-men.jpg') }}" alt="Ciclistas no pódio"
                            width="1600" height="1067" loading="lazy" decoding="async">
                    </div>
                    <div class="gallery__item gallery__item--square">
                        <img src="{{ asset('images/rider-smile.jpg') }}" alt="Ciclista sorrindo"
                            width="1600" height="2400" loading="lazy" decoding="async">
                    </div>
                    <div class="gallery__item gallery__item--wide">
                        <img src="{{ asset('images/action-trail.jpg') }}" alt="Ação na trilha"
                            width="1600" height="1067" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= APRESENTACAO DO EVENTO + FORMULARIO (padrao Base44 /inscricoes) =================
     O card tem duas visoes: "info" (dados do evento) e "form" (formulario de inscricao).
     O formulario so aparece depois de clicar em "Comecar inscricao" dentro do card. --}}
        <section class="ev-intro" id="inscricoes" aria-labelledby="ev-intro-title">
            <div class="ev-intro__heading">
                <span class="eyebrow">Inscrições</span>
                <h1 class="ev-intro__title" id="ev-intro-title">Escolha seu desafio.</h1>
                <p class="ev-intro__sub">Faça sua inscrição para o Desafio Pedra Grande de forma rápida e segura.</p>
            </div>

            <article class="ev-card" data-ev-card>

                {{-- ===== VISAO 1: INFORMACOES DO EVENTO ===== --}}
                <div class="ev-view ev-view--info" data-ev-view="info">
                <div class="ev-card__media">
                    <img src="{{ asset('images/largada.jpeg') }}" alt="Largada do Desafio Pedra Grande"
                        width="3648" height="5472" loading="lazy" decoding="async">
                </div>

                <div class="ev-card__body">
                    <span class="ev-card__flag">Evento Oficial DPG</span>
                    <h2 class="ev-card__title">Desafio Pedra Grande</h2>

                    <p class="ev-card__place">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Igarapé — MG
                    </p>

                    <p class="ev-card__status">
                        <span class="pulse" aria-hidden="true"><span class="pulse__ring"></span><span class="pulse__dot"></span></span>
                        Inscrições Abertas
                    </p>

                    <dl class="ev-facts">
                        <div class="ev-fact">
                            <dt>
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M8 2v4M16 2v4" />
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M3 10h18" />
                                </svg>
                                Data
                            </dt>
                            <dd>25/04/2027</dd>
                        </div>

                        <div class="ev-fact">
                            <dt>
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                Endereço
                            </dt>
                            <dd>A definir</dd>
                        </div>

                        <div class="ev-fact">
                            <dt>
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                                Encerramento das inscrições
                            </dt>
                            <dd>A definir</dd>
                        </div>

                        <div class="ev-fact">
                            <dt>
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                Vagas
                            </dt>
                            <dd>A definir</dd>
                        </div>
                    </dl>

                    <button type="button" class="btn btn--primary ev-card__cta" data-ev-open>
                        Começar inscrição
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </button>
                </div>
                </div>
                {{-- fim da visao 1 --}}

        {{-- ===== VISAO 2: FORMULARIO DE INSCRICAO ===== --}}
                {{-- So aparece depois de clicar em "Comecar inscricao" no card. --}}
                <div class="ev-view ev-view--form" data-ev-view="form" role="dialog" aria-modal="true"
                    aria-label="Formulário de inscrição" hidden>

                    <div class="ev-form__head" data-ev-form-head tabindex="-1">
                        <button type="button" class="ev-form__back" data-ev-close>
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M19 12H5M11 18l-6-6 6-6" />
                            </svg>
                            Voltar para o evento
                        </button>
                        <span class="eyebrow">Inscrições 2027</span>
                        <h2 class="ev-form__title">Garanta sua vaga</h2>
                        <p class="ev-form__sub">Preencha as seis etapas abaixo. Leva só alguns minutos.</p>
                    </div>

                <div class="reg-layout">
                    <div class="reg-card">

                        <form id="registration-form" novalidate>

                        {{-- STEP INDICATOR --}}
                        <div class="stepper">
                            <div class="stepper__head">
                                <div class="stepper__count">
                                    <span class="stepper__count-label">Etapa <b data-step-current>1</b> de 6</span>
                                    <span class="stepper__count-name" data-step-name>Percurso</span>
                                </div>
                            </div>

                            <ol class="stepper__track">
                                <li class="stepper__item is-current" data-stepper="1">
                                    <span class="stepper__dot">1</span>
                                    <span class="stepper__label">Percurso</span>
                                </li>
                                <span class="stepper__bar"></span>
                                <li class="stepper__item" data-stepper="2">
                                    <span class="stepper__dot">2</span>
                                    <span class="stepper__label">Atleta</span>
                                </li>
                                <span class="stepper__bar"></span>
                                <li class="stepper__item" data-stepper="3">
                                    <span class="stepper__dot">3</span>
                                    <span class="stepper__label">Categoria</span>
                                </li>
                                <span class="stepper__bar"></span>
                                <li class="stepper__item" data-stepper="4">
                                    <span class="stepper__dot">4</span>
                                    <span class="stepper__label">Kit</span>
                                </li>
                                <span class="stepper__bar"></span>
                                <li class="stepper__item" data-stepper="5">
                                    <span class="stepper__dot">5</span>
                                    <span class="stepper__label">Revisão</span>
                                </li>
                                <span class="stepper__bar"></span>
                                <li class="stepper__item" data-stepper="6">
                                    <span class="stepper__dot">6</span>
                                    <span class="stepper__label">Pagamento</span>
                                </li>
                            </ol>

                            <div class="stepper__mobile">
                                <div class="stepper__mobile-fill" data-step-fill></div>
                            </div>
                        </div>

                            {{-- ===== ETAPA 1: PERCURSO ===== --}}
                            <div class="step is-active" data-step="1">
                                <h3 class="step__title">Qual desafio você vai encarar?</h3>
                                <p class="step__desc">Escolha o percurso da sua inscrição.</p>

                                <div class="option-grid option-grid--3">
                                    <label class="option">
                                        <input type="radio" name="percurso" value="Completo" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Percurso Completo</span>
                                        <span class="option__tag">Mountain Bike</span>
                                        <span class="option__desc">O desafio completo para quem quer enfrentar toda a
                                            intensidade do Pedra Grande.</span>
                                        <span class="option__foot">
                                            <span class="option__dist">50 km</span>
                                            <span class="option__level">Avançado</span>
                                        </span>
                                    </label>

                                    <label class="option">
                                        <input type="radio" name="percurso" value="Reduzido" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Percurso Reduzido</span>
                                        <span class="option__tag">Mountain Bike</span>
                                        <span class="option__desc">Uma experiência desafiadora para quem quer viver o DPG
                                            em um percurso mais acessível.</span>
                                        <span class="option__foot">
                                            <span class="option__dist">30 km</span>
                                            <span class="option__level">Intermediário</span>
                                        </span>
                                    </label>

                                    <label class="option">
                                        <input type="radio" name="percurso" value="Completo Misto" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Completo Misto</span>
                                        <span class="option__tag">E-Bike</span>
                                        <span class="option__desc">Toda a extensão do percurso completo, na modalidade
                                            elétrica.</span>
                                        <span class="option__foot">
                                            <span class="option__dist">50 km</span>
                                            <span class="option__level">Misto</span>
                                        </span>
                                    </label>

                                    <label class="option">
                                        <input type="radio" name="percurso" value="Reduzido Misto" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Reduzido Misto</span>
                                        <span class="option__tag">PCD / Dupla</span>
                                        <span class="option__desc">Percurso reduzido nas modalidades PCD e dupla
                                            mista.</span>
                                        <span class="option__foot">
                                            <span class="option__dist">30 km</span>
                                            <span class="option__level">Misto</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            {{-- ===== ETAPA 2: ATLETA ===== --}}
                            <div class="step" data-step="2">
                                <h3 class="step__title">Seus dados</h3>
                                <p class="step__desc">Precisamos destes dados para emitir sua inscrição.</p>

                                <div class="field-grid">
                                    <div class="field">
                                        <label class="field-label" for="nome">Nome completo <span class="req">*</span></label>
                                        <input type="text" id="nome" name="nome" placeholder="Seu nome completo"
                                            autocomplete="name" required>
                                        <p class="field__error hide" data-error="nome"></p>
                                    </div>

                                    <div class="field-grid field-grid--2" style="margin-top:0">
                                        <div class="field">
                                            <label class="field-label" for="email">E-mail <span class="req">*</span></label>
                                            <input type="email" id="email" name="email" placeholder="seu@email.com"
                                                autocomplete="email" required>
                                            <p class="field__error hide" data-error="email"></p>
                                        </div>

                                        <div class="field">
                                            <label class="field-label" for="telefone">Telefone <span class="req">*</span></label>
                                            <input type="tel" id="telefone" name="telefone" placeholder="(31) 99999-0000"
                                                autocomplete="tel" required>
                                            <p class="field__error hide" data-error="telefone"></p>
                                        </div>
                                    </div>

                                    <div class="field-grid field-grid--2" style="margin-top:0">
                                        <div class="field">
                                            <label class="field-label" for="cpf">CPF <span class="req">*</span></label>
                                            <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00"
                                                inputmode="numeric" maxlength="14" required>
                                            <p class="field__error hide" data-error="cpf"></p>
                                        </div>

                                        <div class="field">
                                            <label class="field-label" for="dataNascimento">Data de nascimento
                                                <span class="req">*</span></label>
                                            <input type="date" id="dataNascimento" name="dataNascimento" required>
                                            <p class="field__error hide" data-error="dataNascimento"></p>
                                        </div>
                                    </div>

                                    <div class="field field--select" style="max-width:220px">
                                        <label class="field-label" for="sexo">Sexo <span class="req">*</span></label>
                                        <select id="sexo" name="sexo" required>
                                            <option value="">Selecione</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                        <p class="field__error hide" data-error="sexo"></p>
                                    </div>
                                </div>
                            </div>

                            {{-- ===== ETAPA 3: MODALIDADE E CATEGORIA ===== --}}
                            <div class="step" data-step="3">
                                <h3 class="step__title">Modalidade e categoria</h3>
                                <p class="step__desc">Definimos a categoria com base no seu percurso, idade e sexo.</p>

                                <div class="option-grid option-grid--3col">
                                    <div class="option" style="cursor:default">
                                        <span class="option__title" data-modalidade>—</span>
                                        <span class="option__tag" data-modalidade-tag>Modalidade</span>
                                        <span class="option__desc" data-percurso-resumo>Selecione o percurso na etapa
                                            anterior.</span>
                                    </div>
                                </div>

                                <div class="field field--select field--mt">
                                    <label class="field-label" for="categoria">Categoria <span class="req">*</span></label>
                                    <select id="categoria" name="categoria" required disabled>
                                        <option value="">Informe seus dados primeiro</option>
                                    </select>
                                    <p class="field__hint" data-categoria-hint></p>
                                    <p class="field__error hide" data-error="categoria"></p>
                                </div>
                            </div>

                            {{-- ===== ETAPA 4: KIT ===== --}}
                            <div class="step" data-step="4">
                                <h3 class="step__title">Kit do atleta</h3>
                                <p class="step__desc">Escolha se deseja contratar o kit oficial do desafio.</p>

                                <div class="option-grid option-grid--2">
                                    <label class="option">
                                        <input type="radio" name="kit" value="com" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Com kit</span>
                                        <span class="option__desc">Camisa de ciclismo, placa de bike, chip de
                                            cronometragem e medalha.</span>
                                        <span class="option__foot">
                                            <span class="option__price">+ R$ 60,00</span>
                                        </span>
                                    </label>

                                    <label class="option">
                                        <input type="radio" name="kit" value="sem" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Sem kit</span>
                                        <span class="option__desc">Apenas a inscrição, com chip de cronometragem e
                                            medalha de participação.</span>
                                        <span class="option__foot">
                                            <span class="option__price">Incluso</span>
                                        </span>
                                    </label>
                                </div>

                                <div class="field field--select field--mt hide" data-tamanho-wrap>
                                    <label class="field-label" for="tamanho">Tamanho da camisa <span class="req">*</span>
                                    </label>
                                    <select id="tamanho" name="tamanho">
                                        <option value="">Selecione</option>
                                        <option value="P">P</option>
                                        <option value="M">M</option>
                                        <option value="G">G</option>
                                        <option value="GG">GG</option>
                                    </select>
                                    <p class="field__error hide" data-error="tamanho"></p>
                                </div>
                            </div>

                            {{-- ===== ETAPA 5: REVISÃO ===== --}}
                            <div class="step" data-step="5">
                                <h3 class="step__title">Revise sua inscrição</h3>
                                <p class="step__desc">Confira os dados antes de finalizar.</p>

                                <div class="field-grid" style="margin-top:1.5rem">
                                    <div class="review-group">
                                        <div class="review-group__head">
                                            <span class="review-group__title">Percurso</span>
                                            <button type="button" class="review-group__edit" data-goto="1">
                                                Editar
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    aria-hidden="true">
                                                    <path d="M4 20h4L19 9a2.8 2.8 0 10-4-4L4 16v4z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <dl class="review-list" data-review="percurso"></dl>
                                    </div>

                                    <div class="review-group">
                                        <div class="review-group__head">
                                            <span class="review-group__title">Atleta</span>
                                            <button type="button" class="review-group__edit" data-goto="2">
                                                Editar
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    aria-hidden="true">
                                                    <path d="M4 20h4L19 9a2.8 2.8 0 10-4-4L4 16v4z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <dl class="review-list" data-review="atleta"></dl>
                                    </div>

                                    <div class="review-group">
                                        <div class="review-group__head">
                                            <span class="review-group__title">Categoria e kit</span>
                                            <button type="button" class="review-group__edit" data-goto="3">
                                                Editar
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    aria-hidden="true">
                                                    <path d="M4 20h4L19 9a2.8 2.8 0 10-4-4L4 16v4z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <dl class="review-list" data-review="kit"></dl>
                                    </div>

                                    <dl class="review-total">
                                        <dt>Total da inscrição</dt>
                                        <dd data-total>R$ 109,00</dd>
                                    </dl>
                                </div>
                            </div>

                            {{-- ===== ETAPA 6: PAGAMENTO ===== --}}
                            <div class="step" data-step="6">
                                <h3 class="step__title">Finalizar inscrição</h3>
                                <p class="step__desc">Escolha como deseja pagar e aceite os termos.</p>

                                <div class="option-grid option-grid--2">
                                    <label class="option">
                                        <input type="radio" name="pagamento" value="pix" required>
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Pix</span>
                                        <span class="option__desc">Aprovação em poucos minutos, 24 horas por dia.</span>
                                    </label>

                                    <label class="option">
                                        <input type="radio" name="pagamento" value="cartao">
                                        <span class="option__check">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <span class="option__title">Cartão de crédito</span>
                                        <span class="option__desc">Parcele em até 3x sem juros no checkout.</span>
                                    </label>
                                </div>

                                <div class="check-group">
                                    <label class="check">
                                        <input type="checkbox" name="termoRegulamento" required>
                                        <span class="check__text">Li e aceito o <a href="#o-desafio">Regulamento
                                                Oficial</a> do evento.</span>
                                    </label>
                                    <label class="check">
                                        <input type="checkbox" name="termoResponsabilidade" required>
                                        <span class="check__text">Declaro estar ciente dos riscos da prova e libero a
                                            organização de qualquer responsabilidade.</span>
                                    </label>
                                    <label class="check">
                                        <input type="checkbox" name="termoImagem" required>
                                        <span class="check__text">Autorizo o uso de imagens e vídeos nos quais eu
                                            apareça para divulgação do evento.</span>
                                    </label>
                                </div>

                                <p class="field__error hide" data-error="termos"></p>

                                <p class="field__hint" style="margin-top:1.5rem">
                                    Você será redirecionado para o ambiente seguro do PagBank para concluir o pagamento.
                                </p>
                            </div>

                            {{-- ===== NAVEGAÇÃO ===== --}}
                            <div class="step-nav">
                                <button type="button" class="step-nav__back" data-prev hidden>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M19 12H5M11 18l-6-6 6-6" />
                                    </svg>
                                    Voltar
                                </button>
                                <button type="button" class="btn btn--primary" data-next>
                                    Continuar
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </button>
                            </div>

                            <div class="confirm hide" data-confirm>
                                <span class="confirm__icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <h3 class="confirm__title">Agora é oficial</h3>
                                <p class="confirm__text">Nos vemos no Desafio Pedra Grande.</p>
                                <div class="confirm__box">
                                    <p style="font-size:.75rem;letter-spacing:.14em;text-transform:uppercase;color:var(--dpg-ink-45)">
                                        Número da inscrição
                                    </p>
                                    <p class="confirm__num" data-numero>—</p>
                                </div>
                            </div>

                        </form>
                    </div>

                    {{-- ===== SIDEBAR ===== --}}
                    <aside class="side">
                        <div class="side-card side-card--topo">
                            <span class="side-card__title">1º Lote promocional</span>
                            <div class="side-price">
                                <span class="side-price__value">R$ 109</span>
                                <span class="side-price__old">R$ 180</span>
                            </div>
                            <p class="side-note">Vagas limitadas. Garanta a sua agora.</p>
                        </div>

                        <div class="side-card">
                            <span class="side-card__title">Lotes e valores</span>
                            <div style="margin-top:.75rem">
                                <div class="side-lote is-current">
                                    <span>1º Lote (promocional)</span><b>R$ 109</b>
                                </div>
                                <div class="side-lote">
                                    <span>2º Lote</span><b>R$ 150</b>
                                </div>
                                <div class="side-lote">
                                    <span>3º Lote</span><b>R$ 180</b>
                                </div>
                            </div>
                        </div>

                        <div class="side-card">
                            <span class="side-card__title">Incluso na inscrição</span>
                            <ul class="side-list">
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Estrutura completa do evento
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Pontos de hidratação no percurso
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Café da manhã
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Suporte mecânico e de pista
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Número de atleta
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 13l4 4L19 7" />
                                    </svg>
                                    Premiação por categoria
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
                </div>
                {{-- fim da visao 2 --}}

            </article>
        </section>

        {{-- ================= PATROCINADORES ================= --}}
        <section class="section section--alloy" id="patrocinadores">
            <div class="container">
                <div class="section-head section-head--center">
                    <h2 class="section-title">Patrocinadores</h2>
                    <p class="section-sub">Quem faz o Desafio Pedra Grande acontecer</p>
                </div>

                <div class="sponsors">
                    <div class="sponsor">Apoiador</div>
                    <div class="sponsor">Apoiador</div>
                    <div class="sponsor">Apoiador</div>
                    <div class="sponsor">Apoiador</div>
                    <div class="sponsor">Apoiador</div>
                    <div class="sponsor">Apoiador</div>
                </div>
            </div>
        </section>

    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="site-footer">
        <div class="container">
            <div class="site-footer__top">
                <div class="site-footer__brand">
<img src="{{ asset('images/logo.png') }}" alt="Desafio Pedra Grande" width="800" height="800"
                    decoding="async" fetchpriority="high">
                    <p>Esporte, natureza e pessoas que fazem o Desafio Pedra Grande acontecer. Igarapé — Minas Gerais,
                        desde 2017.</p>
                </div>

                <div>
                    <h3 class="site-footer__title">Evento</h3>
                    <ul class="site-footer__list">
                        <li><a href="#o-desafio">O Desafio</a></li>
                        <li><a href="#eventos">Eventos</a></li>
                        <li><a href="#galeria">Galeria</a></li>
                        <li><a href="#inscricoes">Inscrições</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="site-footer__title">Contato</h3>
                    <ul class="site-footer__list">
                        <li><a href="mailto:contato@desafiopedragrande.com.br">contato@desafiopedragrande.com.br</a></li>
                        <li><a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a></li>
                        <li><a href="https://facebook.com" target="_blank" rel="noopener">Facebook</a></li>
                    </ul>
                </div>
            </div>

            <div class="site-footer__bottom">
                <p>&copy; {{ date('Y') }} Desafio Pedra Grande. Todos os direitos reservados.</p>
                <p>Regulamento · Privacidade</p>
            </div>
        </div>
    </footer>

</body>

</html>
