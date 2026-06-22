let currentStep = 1;
const totalSteps = 3;

document.addEventListener('DOMContentLoaded', function () {
    const dataNascInput = document.querySelector('input[name="dataNascimento"]');
    const sexoInput = document.querySelector('select[name="sexo"]');
    const percursoInput = document.querySelector('select[name="percurso"]');
    const categoriaInput = document.querySelector('select[name="categoria"]');
    const form = document.getElementById('registration-form');

    const REGRAS = [
        { nome: "Elite (Masculino)", sexo: 'M', percurso: "Completo", idadeMin: 17, idadeMax: 99 },
        { nome: "Expert (Masculino)", sexo: 'M', percurso: "Completo", idadeMin: 17, idadeMax: 22 },
        { nome: "Sub-30 (Masculino)", sexo: 'M', percurso: "Completo", idadeMin: 23, idadeMax: 29 },
        { nome: "Master A1", sexo: 'M', percurso: "Completo", idadeMin: 30, idadeMax: 34 },
        { nome: "Master A2", sexo: 'M', percurso: "Completo", idadeMin: 35, idadeMax: 39 },
        { nome: "Master B1", sexo: 'M', percurso: "Completo", idadeMin: 40, idadeMax: 44 },
        { nome: "Master B2", sexo: 'M', percurso: "Completo", idadeMin: 45, idadeMax: 49 },
        { nome: "Master C", sexo: 'M', percurso: "Completo", idadeMin: 50, idadeMax: 99 },
        { nome: "Dupla Pro 2 Homens", sexo: 'M', percurso: "Completo", idadeMin: 12, idadeMax: 99 },
        { nome: "Peso Pesado Acima de 95kg", sexo: 'M', percurso: "Completo", idadeMin: 12, idadeMax: 99 },
        { nome: "Juvenil (Masculino)", sexo: 'M', percurso: "Reduzido", idadeMin: 12, idadeMax: 16 },
        { nome: "Cadete", sexo: 'M', percurso: "Reduzido", idadeMin: 17, idadeMax: 34 },
        { nome: "Sênior", sexo: 'M', percurso: "Reduzido", idadeMin: 35, idadeMax: 44 },
        { nome: "Veterano", sexo: 'M', percurso: "Reduzido", idadeMin: 45, idadeMax: 59 },
        { nome: "Master D", sexo: 'M', percurso: "Reduzido", idadeMin: 60, idadeMax: 99 },
        { nome: "Elite (Feminino)", sexo: 'F', percurso: "Completo", idadeMin: 17, idadeMax: 99 },
        { nome: "Master 30 (Feminino)", sexo: 'F', percurso: "Completo", idadeMin: 30, idadeMax: 99 },
        { nome: "Sub 30 (Feminino)", sexo: 'F', percurso: "Completo", idadeMin: 17, idadeMax: 29 },
        { nome: "Amadora (Feminino)", sexo: 'F', percurso: "Reduzido", idadeMin: 12, idadeMax: 39 },
        { nome: "Cadete (Feminino)", sexo: 'F', percurso: "Reduzido", idadeMin: 39, idadeMax: 99 },
        { nome: "E-BIKE MISTO", sexo: 'M', percurso: "Completo Misto", idadeMin: 19, idadeMax: 99 },
        { nome: "E-BIKE MISTO", sexo: 'F', percurso: "Completo Misto", idadeMin: 19, idadeMax: 99 },
        { nome: "PCD Misto", sexo: 'M', percurso: "Reduzido Misto", idadeMin: 12, idadeMax: 99 },
        { nome: "PCD Misto", sexo: 'F', percurso: "Reduzido Misto", idadeMin: 12, idadeMax: 99 },
        { nome: "Dupla Mista (1 Homem / 1 Mulher)", sexo: 'M', percurso: "Reduzido Misto", idadeMin: 12, idadeMax: 99 },
        { nome: "Dupla Mista (1 Homem / 1 Mulher)", sexo: 'F', percurso: "Reduzido Misto", idadeMin: 12, idadeMax: 99 }
    ];

    function atualizarPercursos() {
        const dataNasc = dataNascInput.value;
        const sexo = sexoInput.value;
        if (!dataNasc || !sexo) return;

        const anoNasc = new Date(dataNasc).getUTCFullYear();
        const anoAtual = 2026;
        const idade = anoAtual - anoNasc;

        const disponiveis = [...new Set(REGRAS
            .filter(r => r.sexo === sexo && idade >= r.idadeMin && idade <= r.idadeMax)
            .map(r => r.percurso))];

        percursoInput.innerHTML = '<option value="">Selecione o percurso...</option>';
        disponiveis.forEach(p => {
            const opt = document.createElement('option');
            opt.value = p;
            opt.textContent = "Percurso " + p + (p.includes("Completo") ? " - 50 Km" : " - 30 Km");
            percursoInput.appendChild(opt);
        });

        percursoInput.disabled = false;
        categoriaInput.innerHTML = '<option value="">Selecione o percurso primeiro...</option>';
        categoriaInput.disabled = true;
    }

    function atualizarCategorias() {
        const dataNasc = dataNascInput.value;
        const sexo = sexoInput.value;
        const percurso = percursoInput.value;
        if (!percurso) return;

        const anoNasc = new Date(dataNasc).getUTCFullYear();
        const anoAtual = 2026;
        const idade = anoAtual - anoNasc;

        const cats = REGRAS.filter(r =>
            r.sexo === sexo &&
            r.percurso === percurso &&
            idade >= r.idadeMin &&
            idade <= r.idadeMax
        );

        categoriaInput.innerHTML = '<option value="">Selecione a categoria...</option>';
        cats.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.nome;
            opt.textContent = c.nome;
            categoriaInput.appendChild(opt);
        });

        categoriaInput.disabled = false;
    }

    dataNascInput.addEventListener('change', atualizarPercursos);
    sexoInput.addEventListener('change', atualizarPercursos);
    percursoInput.addEventListener('change', atualizarCategorias);

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = "Processando...";

        const dados = {
            nome: form.nome.value,
            email: form.email.value,
            telefone: form.telefone.value,
            cpf: form.cpf.value.replace(/\D/g, ''),
            dataNascimento: form.dataNascimento.value,
            sexo: form.sexo.value,
            percurso: form.percurso.value,
            categoria: form.categoria.value,
            aceite: form.aceite.checked
        };

        fetch("http://127.0.0.1:8000/api/cadastros", {
            method: "POST",
            headers: { "Content-Type": "application/json", "Accept": "application/json" },
            body: JSON.stringify(dados)
        })
        .then(async response => {
            const result = await response.json();
            if (response.ok) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Redirecionando para o pagamento...',
                    icon: 'success',
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });
                if (result.payment_url) window.location.href = result.payment_url;
            } else {
                throw new Error(result.error || "Erro no cadastro");
            }
        })
        .catch(err => {
            Swal.fire('Erro', err.message, 'error');
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    });
});

function nextStep() {
    const form = document.getElementById('registration-form');
    const current = document.querySelector(`.form-step[data-step="${currentStep}"]`);

    if (currentStep === 1) {
        const nome = form.nome.value.trim();
        const email = form.email.value.trim();
        const telefone = form.telefone.value.trim();
        const cpf = form.cpf.value.replace(/\D/g, '');
        const dataNasc = form.dataNascimento.value;

        if (!nome || !email || !telefone || !cpf || !dataNasc) {
            Swal.fire('Atenção', 'Preencha todos os campos obrigatórios.', 'warning');
            return;
        }
        if (cpf.length !== 11) {
            Swal.fire('CPF Inválido', 'O CPF deve ter 11 dígitos.', 'warning');
            return;
        }
    }

    if (currentStep === 2) {
        if (!form.sexo.value || !form.percurso.value || !form.categoria.value) {
            Swal.fire('Atenção', 'Preencha sexo, percurso e categoria.', 'warning');
            return;
        }
    }

    if (currentStep < totalSteps) {
        currentStep++;
        updateSteps();
        if (currentStep === 3) renderReview();
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateSteps();
    }
}

window.nextStep = nextStep;
window.prevStep = prevStep;

function updateSteps() {
    document.querySelectorAll('.form-step').forEach(el => {
        el.classList.toggle('active', parseInt(el.dataset.step) === currentStep);
    });

    document.querySelectorAll('.step-item').forEach(el => {
        const step = parseInt(el.dataset.step);
        el.classList.remove('active', 'done');
        if (step === currentStep) el.classList.add('active');
        else if (step < currentStep) el.classList.add('done');
    });

    const progress = document.querySelector('.step-progress');
    if (progress) {
        const pct = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progress.style.width = pct + '%';
    }

    const form = document.getElementById('registration-form');
    if (currentStep === 1) form.querySelector('input[name="nome"]')?.focus();
    if (currentStep === 2) form.querySelector('select[name="sexo"]')?.focus();
}

function renderReview() {
    const form = document.getElementById('registration-form');
    const container = document.getElementById('review-data');
    if (!container) return;

    container.innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Nome</strong><span style="font-size:.95em;">${form.nome.value}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Email</strong><span style="font-size:.95em;">${form.email.value}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Telefone</strong><span style="font-size:.95em;">${form.telefone.value}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">CPF</strong><span style="font-size:.95em;">${form.cpf.value}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Data Nasc.</strong><span style="font-size:.95em;">${formatDate(form.dataNascimento.value)}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Sexo</strong><span style="font-size:.95em;">${form.sexo.value === 'M' ? 'Masculino' : 'Feminino'}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Percurso</strong><span style="font-size:.95em;">${form.percurso.value}</span></div>
            <div><strong style="font-size:.75em;color:var(--text-light);text-transform:uppercase;display:block;">Categoria</strong><span style="font-size:.95em;">${form.categoria.value}</span></div>
        </div>
    `;
}

function formatDate(dateStr) {
    if (!dateStr) return '-';
    const d = new Date(dateStr + 'T12:00:00');
    return d.toLocaleDateString('pt-BR');
}
