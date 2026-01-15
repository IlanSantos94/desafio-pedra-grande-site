document.getElementById("registration-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = e.target;

    const dados = {
        nome: form.nome.value.trim(),
        email: form.email.value.trim(),
        telefone: form.telefone.value.trim(),
        cpf: form.cpf.value.replace(/\D/g, ''), 
        dataNascimento: form.dataNascimento.value,
        categoria: form.categoria.value,
        aceite: form.aceite.checked
    };

    fetch("http://localhost:8000/api/cadastros", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(dados)
    })
    .then(async response => {
        const result = await response.json(); // Movemos para cima para ler o link de pagamento

        // Se o status for 201 (Created), o cadastro e o checkout foram gerados
        if (response.status === 201) {
            alert("Inscrição realizada! Redirecionando para o pagamento...");
            
            // Verifica se o Controller enviou a URL do PagBank
            if (result.payment_url) {
                window.location.href = result.payment_url; 
            } else {
                alert("Cadastro feito, mas o link de pagamento não foi gerado.");
            }
            return;
        }

        if (!response.ok) {
            console.error("Erro backend:", result);
            if (result.errors) {
                alert(Object.values(result.errors).flat().join("\n"));
            } else {
                alert(result.error || "Erro ao processar cadastro.");
            }
            return;
        }
    })
    .catch(error => {
        console.error("Erro JS:", error);
        alert("Erro de conexão com o servidor.");
    });
});