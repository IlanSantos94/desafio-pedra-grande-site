document.addEventListener('DOMContentLoaded', function () {

    /* ---------- Card de inscricao: informacoes <-> formulario ----------
       O card mostra os dados do evento. So depois de clicar em
       "Comecar inscricao" e que o formulario de 6 etapas aparece. */

    const evCard = document.querySelector('[data-ev-card]');

    if (evCard) {
        const viewInfo = evCard.querySelector('[data-ev-view="info"]');
        const viewForm = evCard.querySelector('[data-ev-view="form"]');
        const formHead = evCard.querySelector('[data-ev-form-head]');
        const openBtn = evCard.querySelector('[data-ev-open]');

        const mostrarInfo = function () {
            evCard.classList.remove('is-form');
            document.body.classList.remove('is-registration');
            if (viewInfo) viewInfo.hidden = false;
            if (viewForm) viewForm.hidden = true;
        };

        const mostrarForm = function () {
            evCard.classList.add('is-form');
            document.body.classList.add('is-registration');
            if (viewInfo) viewInfo.hidden = true;
            if (viewForm) {
                viewForm.hidden = false;
                viewForm.scrollTop = 0;
            }
            if (formHead) formHead.focus();
        };

        // Botao "Comecar inscricao" dentro do card
        evCard.querySelectorAll('[data-ev-open]').forEach(function (b) {
            b.addEventListener('click', mostrarForm);
        });

        // "Voltar para o evento", breadcrumb "Inscricoes" e tecla Esc
        document.querySelectorAll('[data-ev-close]').forEach(function (b) {
            b.addEventListener('click', function () {
                mostrarInfo();
                if (openBtn) openBtn.focus();
                const cardTop = evCard.getBoundingClientRect().top + window.scrollY
                    - parseInt(getComputedStyle(document.documentElement).fontSize, 10) * 7;
                window.scrollTo({ top: cardTop, behavior: 'smooth' });
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key !== 'Escape' || !viewForm || viewForm.hidden) return;
            mostrarInfo();
            if (openBtn) openBtn.focus();
        });

        // O painel e a unica coisa visivel: prende o foco dentro dele.
        viewForm.addEventListener('keydown', function (e) {
            if (e.key !== 'Tab') return;
            var focaveis = viewForm.querySelectorAll(
                'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
            );
            if (!focaveis.length) return;

            var primeiro = focaveis[0];
            var ultimo = focaveis[focaveis.length - 1];

            if (e.shiftKey && document.activeElement === primeiro) {
                e.preventDefault();
                ultimo.focus();
            } else if (!e.shiftKey && document.activeElement === ultimo) {
                e.preventDefault();
                primeiro.focus();
            }
        });

        // Botoes "Inscrever-se" do site sempre trazem o card de informacoes
        document.querySelectorAll('a[href="#inscricoes"]').forEach(function (a) {
            a.addEventListener('click', mostrarInfo);
        });

        mostrarInfo();
    }

    const form = document.getElementById('registration-form');
    if (!form) return;

    const TOTAL_STEPS = 6;
    const STEP_NAMES = ['Percurso', 'Atleta', 'Categoria', 'Kit', 'Revisão', 'Pagamento'];
    const ANO_BASE = 2026;
    const VALOR_BASE = 109;
    const VALOR_KIT = 60;

    const ICONE_CHECK = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" ' +
        'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 13l4 4L19 7"/></svg>';
    const ICONE_SETA = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
        'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
    const ICONE_CADEADO = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
        'stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
        '<rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 018 0v3"/></svg>';

    let currentStep = 1;

    /* ---------- Regras de categoria (preservadas do projeto original) ---------- */

    const REGRAS = [
        { nome: 'Elite (Masculino)', sexo: 'M', percurso: 'Completo', idadeMin: 17, idadeMax: 99 },
        { nome: 'Expert (Masculino)', sexo: 'M', percurso: 'Completo', idadeMin: 17, idadeMax: 22 },
        { nome: 'Sub-30 (Masculino)', sexo: 'M', percurso: 'Completo', idadeMin: 23, idadeMax: 29 },
        { nome: 'Master A1', sexo: 'M', percurso: 'Completo', idadeMin: 30, idadeMax: 34 },
        { nome: 'Master A2', sexo: 'M', percurso: 'Completo', idadeMin: 35, idadeMax: 39 },
        { nome: 'Master B1', sexo: 'M', percurso: 'Completo', idadeMin: 40, idadeMax: 44 },
        { nome: 'Master B2', sexo: 'M', percurso: 'Completo', idadeMin: 45, idadeMax: 49 },
        { nome: 'Master C', sexo: 'M', percurso: 'Completo', idadeMin: 50, idadeMax: 99 },
        { nome: 'Dupla Pro 2 Homens', sexo: 'M', percurso: 'Completo', idadeMin: 12, idadeMax: 99 },
        { nome: 'Peso Pesado Acima de 95kg', sexo: 'M', percurso: 'Completo', idadeMin: 12, idadeMax: 99 },
        { nome: 'Juvenil (Masculino)', sexo: 'M', percurso: 'Reduzido', idadeMin: 12, idadeMax: 16 },
        { nome: 'Cadete', sexo: 'M', percurso: 'Reduzido', idadeMin: 17, idadeMax: 34 },
        { nome: 'Sênior', sexo: 'M', percurso: 'Reduzido', idadeMin: 35, idadeMax: 44 },
        { nome: 'Veterano', sexo: 'M', percurso: 'Reduzido', idadeMin: 45, idadeMax: 59 },
        { nome: 'Master D', sexo: 'M', percurso: 'Reduzido', idadeMin: 60, idadeMax: 99 },
        { nome: 'Elite (Feminino)', sexo: 'F', percurso: 'Completo', idadeMin: 17, idadeMax: 99 },
        { nome: 'Master 30 (Feminino)', sexo: 'F', percurso: 'Completo', idadeMin: 30, idadeMax: 99 },
        { nome: 'Sub 30 (Feminino)', sexo: 'F', percurso: 'Completo', idadeMin: 17, idadeMax: 29 },
        { nome: 'Amadora (Feminino)', sexo: 'F', percurso: 'Reduzido', idadeMin: 12, idadeMax: 39 },
        { nome: 'Cadete (Feminino)', sexo: 'F', percurso: 'Reduzido', idadeMin: 39, idadeMax: 99 },
        { nome: 'E-BIKE MISTO', sexo: 'M', percurso: 'Completo Misto', idadeMin: 19, idadeMax: 99 },
        { nome: 'E-BIKE MISTO', sexo: 'F', percurso: 'Completo Misto', idadeMin: 19, idadeMax: 99 },
        { nome: 'PCD Misto', sexo: 'M', percurso: 'Reduzido Misto', idadeMin: 12, idadeMax: 99 },
        { nome: 'PCD Misto', sexo: 'F', percurso: 'Reduzido Misto', idadeMin: 12, idadeMax: 99 },
        { nome: 'Dupla Mista (1 Homem / 1 Mulher)', sexo: 'M', percurso: 'Reduzido Misto', idadeMin: 12, idadeMax: 99 },
        { nome: 'Dupla Mista (1 Homem / 1 Mulher)', sexo: 'F', percurso: 'Reduzido Misto', idadeMin: 12, idadeMax: 99 }
    ];

    const MODALIDADES = {
        'Completo': 'Mountain Bike',
        'Reduzido': 'Mountain Bike',
        'Completo Misto': 'E-Bike',
        'Reduzido Misto': 'PCD / Dupla Mista'
    };

    const PERCURSO_LABEL = {
        'Completo': 'Percurso Completo',
        'Reduzido': 'Percurso Reduzido',
        'Completo Misto': 'Completo Misto',
        'Reduzido Misto': 'Reduzido Misto'
    };

    /* ---------- Elementos (consulta tolerante a ausencia) ---------- */

    const q = (sel) => form.querySelector(sel);
    const elNome = q('[name="nome"]');
    const elEmail = q('[name="email"]');
    const elTelefone = q('[name="telefone"]');
    const elCpf = q('[name="cpf"]');
    const elNasc = q('[name="dataNascimento"]');
    const elSexo = q('[name="sexo"]');
    const elCategoria = q('[name="categoria"]');
    const elTamanho = q('[name="tamanho"]');
    const elTamanhoWrap = q('[data-tamanho-wrap]');
    const elCategoriaHint = q('[data-categoria-hint]');
    const elModalidade = q('[data-modalidade]');
    const elModalidadeTag = q('[data-modalidade-tag]');
    const elPercursoResumo = q('[data-percurso-resumo]');
    const elTotal = q('[data-total]');
    const btnNext = q('[data-next]');
    const btnPrev = q('[data-prev]');
    const elConfirm = q('[data-confirm]');
    const stepper = q('[data-stepper]');
    const stepperEls = [...form.querySelectorAll('[data-stepper]')];
    const stepperCurrent = q('[data-step-current]');
    const stepperName = q('[data-step-name]');
    const stepperFill = q('[data-step-fill]');

    /* ---------- Utilidades ---------- */

    const valor = (name) => {
        const el = form.querySelector('[name="' + name + '"]:checked');
        return el ? el.value : '';
    };

    const apenasDigitos = (s) => (s || '').replace(/\D/g, '');

    const formatarCPF = (v) => {
        const d = apenasDigitos(v).slice(0, 11);
        return d.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    };

    const formatarTelefone = (v) => {
        const d = apenasDigitos(v).slice(0, 11);
        if (d.length <= 2) return d;
        if (d.length <= 6) return d.replace(/(\d{2})(\d+)/, '($1) $2');
        if (d.length <= 10) return d.replace(/(\d{2})(\d{4})(\d+)/, '($1) $2-$3');
        return d.replace(/(\d{2})(\d{5})(\d+)/, '($1) $2-$3');
    };

    const formatarNome = (v) => v
        .replace(/\s+/g, ' ')
        .replace(/\S+/g, (p) => p.charAt(0).toUpperCase() + p.slice(1).toLowerCase());

    const formatarData = (v) => {
        if (!v) return '—';
        const p = v.split('-');
        return p[2] + '/' + p[1] + '/' + p[0];
    };

    const idadeDe = (dataNasc) => {
        if (!dataNasc) return null;
        return ANO_BASE - new Date(dataNasc + 'T12:00:00').getFullYear();
    };

    const brl = (n) => 'R$ ' + n.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    const emailValido = (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test((v || '').trim());

    const telefoneValido = (v) => {
        const d = apenasDigitos(v);
        return d.length === 10 || d.length === 11;
    };

    const cpfValido = (cpf) => {
        const s = apenasDigitos(cpf);
        if (s.length !== 11 || /^(\d)\1{10}$/.test(s)) return false;
        const alvos = [[9, 9], [10, 10]];
        for (const [tamanho, posicao] of alvos) {
            let soma = 0;
            for (let i = 0; i < tamanho; i++) soma += parseInt(s[i], 10) * (tamanho + 1 - i);
            let resto = (soma * 10) % 11;
            if (resto === 10) resto = 0;
            if (resto !== parseInt(s[posicao], 10)) return false;
        }
        return true;
    };

    function mostrarErro(campo, mensagem) {
        const alvo = q('[data-error="' + campo + '"]');
        if (alvo) {
            alvo.textContent = mensagem || '';
            alvo.classList.toggle('hide', !mensagem);
        }
        if (campo !== 'termos') {
            const container = q('[name="' + campo + '"]');
            if (container && container.closest) container.closest('.field')?.classList.toggle('has-error', !!mensagem);
        }
    }

    function limparErros() {
        form.querySelectorAll('[data-error]').forEach(el => {
            el.textContent = '';
            el.classList.add('hide');
        });
        form.querySelectorAll('.field.has-error').forEach(el => el.classList.remove('has-error'));
    }

    const aviso = (titulo, texto) => {
        if (window.Swal) window.Swal.fire(titulo, texto, 'warning');
        else alert(titulo + '\n\n' + texto);
    };

    /* ---------- Etapa concluida? (drive do stepper) ---------- */

    function etapaConcluida(n) {
        switch (n) {
            case 1:
                return !!valor('percurso');

            case 2:
                return !!elNome.value.trim()
                    && emailValido(elEmail.value)
                    && telefoneValido(elTelefone.value)
                    && cpfValido(elCpf.value)
                    && !!elNasc.value
                    && idadeDe(elNasc.value) >= 3
                    && !!elSexo.value;

            case 3:
                return !!valor('percurso') && !!elSexo.value && !!elNasc.value
                    && !elCategoria.disabled && !!elCategoria.value;

            case 4: {
                const kit = valor('kit');
                return !!kit && (kit === 'sem' || !!elTamanho.value);
            }

            case 5:
                return [1, 2, 3, 4].every(etapaConcluida);

            case 6:
                return !!(form.termoRegulamento && form.termoResponsabilidade && form.termoImagem)
                    && form.termoRegulamento.checked
                    && form.termoResponsabilidade.checked
                    && form.termoImagem.checked;

            default:
                return false;
        }
    }

    /* ---------- Categoria / modalidade ---------- */

    function atualizarModalidade() {
        const percurso = valor('percurso');
        if (!percurso) {
            if (elModalidade) elModalidade.textContent = '—';
            if (elModalidadeTag) elModalidadeTag.textContent = 'Modalidade';
            if (elPercursoResumo) elPercursoResumo.textContent = 'Selecione o percurso na etapa anterior.';
            return;
        }
        const completo = percurso.includes('Completo');
        if (elModalidade) elModalidade.textContent = PERCURSO_LABEL[percurso];
        if (elModalidadeTag) elModalidadeTag.textContent = MODALIDADES[percurso];
        if (elPercursoResumo) {
            elPercursoResumo.textContent = (completo ? '50 km · Avançado' : '30 km · Intermediário')
                + ' · ' + MODALIDADES[percurso];
        }
    }

    function atualizarCategorias() {
        if (!elCategoria) return;

        const percurso = valor('percurso');
        const sexo = elSexo ? elSexo.value : '';
        const idade = elNasc ? idadeDe(elNasc.value) : null;
        const selecionada = elCategoria.value;

        elCategoria.innerHTML = '<option value="">Selecione a categoria</option>';
        elCategoria.disabled = true;
        if (elCategoriaHint) elCategoriaHint.textContent = '';

        if (!percurso || !sexo || idade === null) {
            const falta = [];
            if (!percurso) falta.push('o percurso');
            if (!sexo) falta.push('o sexo');
            if (idade === null) falta.push('a data de nascimento');
            if (elCategoriaHint) elCategoriaHint.textContent = 'Informe ' + falta.join(', ') + ' para ver as categorias.';
            return;
        }

        const nomes = [...new Set(REGRAS
            .filter(r => r.percurso === percurso && r.sexo === sexo && idade >= r.idadeMin && idade <= r.idadeMax)
            .map(r => r.nome))];

        nomes.forEach(n => {
            const opt = document.createElement('option');
            opt.value = n;
            opt.textContent = n;
            elCategoria.appendChild(opt);
        });

        elCategoria.disabled = false;
        if (selecionada && nomes.includes(selecionada)) elCategoria.value = selecionada;

        if (elCategoriaHint) {
            elCategoriaHint.textContent = nomes.length
                ? 'Idade calculada: ' + idade + ' anos.'
                : 'Nenhuma categoria disponível para ' + idade + ' anos em ' + MODALIDADES[percurso]
                    + '. Fale com a organização.';
        }
    }

    function atualizarTotal() {
        if (!elTotal) return;
        elTotal.textContent = brl(VALOR_BASE + (valor('kit') === 'com' ? VALOR_KIT : 0));
    }

    function atualizarTamanho() {
        if (elTamanhoWrap) elTamanhoWrap.classList.toggle('hide', valor('kit') !== 'com');
    }

    /* ---------- Validacao por etapa ---------- */

    const validadores = {
        1: () => {
            if (!valor('percurso')) {
                aviso('Atenção', 'Escolha o percurso para continuar.');
                return false;
            }
            return true;
        },

        2: () => {
            limparErros();
            let ok = true;

            if (!elNome.value.trim()) { mostrarErro('nome', 'Informe seu nome completo.'); ok = false; }

            if (!elEmail.value.trim()) {
                mostrarErro('email', 'Informe seu e-mail.'); ok = false;
            } else if (!emailValido(elEmail.value)) {
                mostrarErro('email', 'E-mail inválido.'); ok = false;
            }

            if (!elTelefone.value.trim()) { mostrarErro('telefone', 'Informe seu telefone.'); ok = false; }
            else if (!telefoneValido(elTelefone.value)) { mostrarErro('telefone', 'Telefone incompleto.'); ok = false; }

            if (!elCpf.value.trim()) { mostrarErro('cpf', 'Informe seu CPF.'); ok = false; }
            else if (!cpfValido(elCpf.value)) { mostrarErro('cpf', 'CPF inválido.'); ok = false; }

            if (!elNasc.value) { mostrarErro('dataNascimento', 'Informe sua data de nascimento.'); ok = false; }
            else if (idadeDe(elNasc.value) < 3) { mostrarErro('dataNascimento', 'Data de nascimento inválida.'); ok = false; }

            if (!elSexo.value) { mostrarErro('sexo', 'Selecione o sexo.'); ok = false; }

            if (!ok) aviso('Atenção', 'Revise os campos destacados.');
            return ok;
        },

        3: () => {
            limparErros();
            if (elCategoria.disabled) {
                mostrarErro('categoria', 'Selecione percurso, sexo e data de nascimento na etapa anterior.');
                return false;
            }
            if (!elCategoria.value) {
                mostrarErro('categoria', 'Selecione sua categoria.');
                return false;
            }
            return true;
        },

        4: () => {
            limparErros();
            const kit = valor('kit');
            if (!kit) { aviso('Atenção', 'Escolha se deseja o kit do atleta.'); return false; }
            if (kit === 'com' && !elTamanho.value) {
                mostrarErro('tamanho', 'Escolha o tamanho da camisa.');
                return false;
            }
            return true;
        },

        5: () => true,

        6: () => {
            limparErros();
            if (!q('[name="pagamento"]:checked')) {
                mostrarErro('pagamento', 'Escolha Pix ou Cartão de crédito para continuar.');
                return false;
            }
            if (!etapaConcluida(6)) {
                mostrarErro('termos', 'É necessário aceitar todos os termos para concluir.');
                const primeiro = [...form.querySelectorAll('.check input')].find(i => !i.checked);
                if (primeiro) primeiro.focus();
                return false;
            }
            return true;
        }
    };

    /* ---------- Stepper ---------- */

    function renderStepper() {
        if (!stepperEls.length) return;

        let furthestDone = 0;
        for (let n = 1; n <= TOTAL_STEPS; n++) {
            if (etapaConcluida(n) && n < TOTAL_STEPS) furthestDone = Math.max(furthestDone, n);
        }

        stepperEls.forEach(li => {
            const n = parseInt(li.dataset.stepper, 10);
            const done = etapaConcluida(n);
            const current = n === currentStep;

            li.classList.toggle('is-current', current);
            li.classList.toggle('is-done', done && !current);

            const dot = li.querySelector('.stepper__dot');
            if (dot) dot.innerHTML = done ? ICONE_CHECK : String(n);

            const label = li.querySelector('.stepper__label');
            if (label) label.classList.toggle('is-done', done && !current);
        });

        if (stepperCurrent) stepperCurrent.textContent = currentStep;
        if (stepperName) stepperName.textContent = STEP_NAMES[currentStep - 1];
        if (stepperFill) stepperFill.style.width = (Math.max(furthestDone, currentStep - 1) / (TOTAL_STEPS - 1)) * 100 + '%';
    }

    /* ---------- Revisao ---------- */

    function linha(k, v) {
        return '<div class="review-row"><dt>' + k + '</dt><dd>' + v + '</dd></div>';
    }

    function renderReview() {
        const percurso = valor('percurso');
        const kit = valor('kit');
        const pagamento = valor('pagamento');
        const idade = idadeDe(elNasc.value);

        const elPercurso = q('[data-review="percurso"]');
        if (elPercurso) {
            elPercurso.innerHTML = percurso
                ? linha('Percurso', PERCURSO_LABEL[percurso])
                    + linha('Modalidade', MODALIDADES[percurso])
                    + linha('Distância', percurso.includes('Completo') ? '50 km' : '30 km')
                    + linha('Nível', percurso.includes('Completo') ? 'Avançado' : 'Intermediário')
                : '<p class="review-empty">Nenhum percurso selecionado.</p>';
        }

        const elAtleta = q('[data-review="atleta"]');
        if (elAtleta) {
            elAtleta.innerHTML = linha('Nome', elNome.value || '—')
                + linha('E-mail', elEmail.value || '—')
                + linha('Telefone', elTelefone.value || '—')
                + linha('CPF', elCpf.value || '—')
                + linha('Nascimento', formatarData(elNasc.value))
                + linha('Sexo', elSexo.value === 'M' ? 'Masculino' : elSexo.value === 'F' ? 'Feminino' : '—')
                + linha('Idade', idade === null ? '—' : idade + ' anos');
        }

        const elKit = q('[data-review="kit"]');
        if (elKit) {
            elKit.innerHTML = linha('Categoria', elCategoria.value || '—')
                + linha('Kit do atleta', kit === 'com' ? 'Com kit' : kit === 'sem' ? 'Sem kit' : '—')
                + linha('Tamanho', kit === 'com' ? (elTamanho.value || '—') : 'Não se aplica')
                + linha('Pagamento', pagamento ? (pagamento === 'cartao' ? 'Cartão de crédito' : 'Pix') : 'A escolher na próxima etapa');
        }

        atualizarTotal();
    }

    /* ---------- Render geral ---------- */

    function render() {
        form.querySelectorAll('.step').forEach(el => {
            el.classList.toggle('is-active', parseInt(el.dataset.step, 10) === currentStep);
        });

        renderStepper();

        if (btnPrev) btnPrev.hidden = currentStep === 1;

        if (btnNext) {
            const ultima = currentStep === TOTAL_STEPS;
            btnNext.type = ultima ? 'submit' : 'button';
            btnNext.innerHTML = ultima
                ? 'Finalizar inscrição ' + ICONE_CADEADO
                : 'Continuar ' + ICONE_SETA;
        }

        if (currentStep === 5 || currentStep === 6) renderReview();
    }

    function next() {
        if (!validadores[currentStep]()) return;
        if (currentStep < TOTAL_STEPS) {
            currentStep++;
            render();
            if (stepper && typeof stepper.scrollIntoView === 'function') {
                stepper.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
    }

    function prev() {
        if (currentStep > 1) {
            currentStep--;
            render();
        }
    }

    function goTo(n) {
        currentStep = Math.min(Math.max(1, n), TOTAL_STEPS);
        render();
    }

    /* ---------- Mascaras ---------- */

    if (elCpf) elCpf.addEventListener('input', (e) => { e.target.value = formatarCPF(e.target.value); });
    if (elTelefone) elTelefone.addEventListener('input', (e) => { e.target.value = formatarTelefone(e.target.value); });
    if (elNome) elNome.addEventListener('input', (e) => { e.target.value = formatarNome(e.target.value); });

    /* ---------- Eventos ---------- */

    if (elSexo) elSexo.addEventListener('change', atualizarCategorias);
    if (elNasc) elNasc.addEventListener('change', atualizarCategorias);

    form.querySelectorAll('[name="percurso"]').forEach(r => {
        r.addEventListener('change', () => { atualizarModalidade(); atualizarCategorias(); });
    });

    form.querySelectorAll('[name="kit"]').forEach(r => {
        r.addEventListener('change', () => { atualizarTamanho(); atualizarTotal(); });
    });

    // Atualiza o stepper em tempo real conforme os campos sao preenchidos
    form.addEventListener('input', () => {
        renderStepper();
        if (currentStep === 5 || currentStep === 6) renderReview();
    });

    form.addEventListener('change', () => {
        renderStepper();
        if (currentStep === 5 || currentStep === 6) renderReview();
    });

    if (btnNext) btnNext.addEventListener('click', (e) => {
        if (btnNext.type === 'button') next();
        else return;
    });

    if (btnPrev) btnPrev.addEventListener('click', prev);

    form.querySelectorAll('[data-goto]').forEach(b => {
        b.addEventListener('click', () => goTo(parseInt(b.dataset.goto, 10)));
    });

    /* ---------- Envio ---------- */

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!validadores[6]()) { renderStepper(); return; }

        const kit = valor('kit');
        const dados = {
            nome: elNome.value.trim(),
            email: elEmail.value.trim(),
            telefone: apenasDigitos(elTelefone.value),
            cpf: apenasDigitos(elCpf.value),
            dataNascimento: elNasc.value,
            sexo: elSexo.value,
            percurso: valor('percurso'),
            modalidade: MODALIDADES[valor('percurso')],
            categoria: elCategoria.value,
            kit: kit,
            tamanho: kit === 'com' ? elTamanho.value : null,
            pagamento: valor('pagamento'),
            aceite: form.termoRegulamento.checked
                && form.termoResponsabilidade.checked
                && form.termoImagem.checked
        };

        const rotulo = btnNext.innerHTML;
        btnNext.disabled = true;
        btnNext.textContent = 'Processando...';

        fetch('/api/cadastros', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(dados)
        })
            .then(async (response) => {
                const result = await response.json().catch(() => ({}));

                if (response.status === 422) {
                    Object.entries(result.errors || {}).forEach(([campo, msgs]) => {
                        mostrarErro(campo, Array.isArray(msgs) ? msgs[0] : msgs);
                    });
                    throw new Error(result.message || 'Confira os dados informados.');
                }

                if (!response.ok) throw new Error(result.error || 'Não foi possível concluir a inscrição.');

                form.querySelectorAll('.step, .stepper, .step-nav').forEach(el => el.classList.add('hide'));
                if (elConfirm) {
                    elConfirm.classList.remove('hide');
                    const num = elConfirm.querySelector('[data-numero]');
                    if (num) num.textContent = 'DPG-' + new Date().getFullYear() + '-'
                        + String(Math.floor(1000 + Math.random() * 9000));
                }

                if (window.Swal) {
                    window.Swal.fire({
                        title: 'Inscrição registrada!',
                        text: 'Redirecionando para o pagamento...',
                        icon: 'success',
                        showConfirmButton: false,
                        didOpen: () => window.Swal.showLoading()
                    });
                }

                setTimeout(() => {
                    if (result.payment_url) window.location.href = result.payment_url;
                }, 1200);
            })
            .catch((err) => {
                if (window.Swal) window.Swal.fire('Não foi possível concluir', err.message, 'error');
                else alert(err.message);
                btnNext.disabled = false;
                btnNext.innerHTML = rotulo;
            });
    });

    /* ---------- Menu mobile ---------- */

    const navToggle = document.querySelector('[data-nav-toggle]');
    const navMobile = document.getElementById('menu-mobile');

    if (navToggle && navMobile) {
        navToggle.addEventListener('click', () => {
            const aberto = navMobile.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', String(aberto));
        });
        navMobile.addEventListener('click', (e) => {
            if (e.target.tagName === 'A') {
                navMobile.classList.remove('open');
                navToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ---------- Init ---------- */

    atualizarModalidade();
    atualizarCategorias();
    atualizarTamanho();
    atualizarTotal();
    render();
});
