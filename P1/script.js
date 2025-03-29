document.addEventListener("DOMContentLoaded",function() {
    console.log("Javascript carregado");

    // Evento para monitorar a seleção de Professor ou Aluno
    document.querySelectorAll('button[name="acao"]').forEach(function(botao) {
        botao.addEventListener("click", function(event) {
            criarCampo(event.target.value); // pega o valor armazenado no value=

        });
    });
});

// Função para criar campos dinâmicos
function criarCampo(tipo) {
    var campoDinamico = document.getElementById("campoDinamico");
    campoDinamico.innerHTML = "";
    
    if (tipo === "selecionarAlterar") {
        campoDinamico.innerHTML = `
            <br>
            <label for="codigo">Informe o código abaixo para alteração:</label><br>
            <input type="number" id="codigo" name="codigo">
            <button type="submit" name="acao" value="alterar">Enviar</button>
        `;
    }
    if (tipo === "selecionarExcluir") {
        campoDinamico.innerHTML = `
            <br>
            <label for="codigo">Informe o código abaixo para exclusão:</label><br>
            <input type="number" id="codigo" name="codigo">
            <button type="submit" name="acao" value="excluir">Enviar</button>
        `;
    }
}