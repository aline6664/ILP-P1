<?php
    require_once "Database.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <title>Formulário de Cadastro</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <!--<form action="processamento.php" method="POST">-->
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="raca">Raça:</label><br>
        <input type="text" id="raca" name="raca"><br>
        <label for="cor">Cor:</label><br>
        <input type="text" id="cor" name="cor"><br>
        <label for="sexo">Sexo:</label><br>
        <input type="text" id="sexo" name="sexo"><br><br>

        <!-- Botões -->
        <button type="submit" name="acao" value="incluir">Enviar</button>
        <button type="submit" name="acao" value="listar">Listar todos</button>
        <button type="submit" name="acao" value="buscarNome">Consultar por nome</button>

        <button type="button" name="acao" value="selecionarAlterar">Alterar</button>
        <button type="button" name="acao" value="selecionarExcluir">Excluir</button>
        <!--Cria um campo para inserir o id (para alterar/excluir)-->
        <div id="campoDinamico"> </div>
    </form> <br>

    <?php
    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Captura os dados do formulário
        $acao = $_POST['acao'];
        $nome = $_POST['nome'];
        $raca = $_POST['raca'];
        $cor = $_POST['cor'];
        $sexo = $_POST['sexo'];
        if (isset($_POST['codigo'])) { // se o codigo for passado pelo usuario no alterar/excluir
            $codigoBusca = $_POST['codigo'];
        }

        $bdGatos = new DBGatos();
        // Incluir dados do novo gato (create)
        if ($acao == "incluir") {
            $codigo = $bdGatos->create($nome, $raca, $cor, $sexo); // buscando o codigo auto incrementado
            if ($codigo !== false) {
                echo "<p>Cadastro inserido com sucesso.</p>";
            }
            else {
                echo "<p>Erro ao incluir cadastro.</p>";
            }
        }
        // Listar todos os gatos registrados (recovery)
        else if ($acao == "listar") {
            $listaGatos = $bdGatos->recovery();
            if ($listaGatos) {
                foreach ($listaGatos as $gato) {
                    echo "Código: " . $gato['gat_cod'] . "<br>";
                    echo "Nome: " . $gato['gat_nome'] . "<br>";
                    echo "Raça: " . $gato['gat_raca'] . "<br>";
                    echo "Cor: " . $gato['gat_cor'] . "<br>";
                    echo "Sexo: " . $gato['gat_sexo'] . "<br><br>";
                }
            }
            else {
                echo "<p>Erro ao consultar registros.</p>";
            }
        }
        // Buscar o gato registrado por nome
        else if ($acao == "buscarNome") {
            $listaGatos = $bdGatos->recoveryByName($nome);
            // var_dump($listaGatos); // teste para checar array de dados
            if ($listaGatos && is_array($listaGatos)) { // array pois varios gatos podem ter mesmo nome
                foreach ($listaGatos as $gato) {
                    echo "Código: " . $gato['gat_cod'] . "<br>";
                    echo "Nome: " . $gato['gat_nome'] . "<br>";
                    echo "Raça: " . $gato['gat_raca'] . "<br>";
                    echo "Cor: " . $gato['gat_cor'] . "<br>";
                    echo "Sexo: " . $gato['gat_sexo'] . "<br><br>";
                }
            }
            else {
                echo "<p>Erro ao consultar registro(s) por nome.</p>";
            }
        }
        // Alterar dados do gato registrado (update)
        else if ($acao == "alterar") {
            $gato = $bdGatos->update($codigoBusca, $nome, $raca, $cor, $sexo);
            if ($gato) {
                echo "<p>Dados alterados com sucesso.</p>";
            }
            else {
                echo "<p>Erro ao alterar os dados.</p>";
            }
        }
        // Apagar registro do gato (delete)
        else if ($acao == "excluir") {
            if ($bdGatos->delete($codigoBusca)) {
                echo "<p>Registro apagado com sucesso.</p>";
            }
            else {
                echo "<p>Erro ao apagar registro. Código inexistente.</p>";
            }
        }
        else {
            echo "<p>Ação inválida. Por favor, tente novamente.</p>";
        }

        // Exibe os dados - teste para verificar se os dados foram recebidos
        echo "<h2>Dados Recebidos:</h2>";
        if (isset($_POST['codigo'])) {
            echo "Código: . $codigoBusca . <br>";
        }
        echo "Nome: " . $nome . "<br>";
        echo "Raça: " . $raca . "<br>";
        echo "Cor: " . $cor . "<br>";
        echo "Sexo: " . $sexo . "<br>";
    }
    ?>
</body>
</html>