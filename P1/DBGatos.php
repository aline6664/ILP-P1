<?php
require_once "Database.php";

// a. Listar todos os registros da Tabela;
// b. Incluir um registro na Tabela;
// c. Alterar um registro na Tabela;
// d. Excluir um registro na Tabela;

// Implemente a funcionalidade Buscar um registro: o usuário poderá digitar um nome e o
// sistema deverá exibir os registros que contenham esse nome.

class DBGatos {
    private $conexao;
    private $tableName = 'gatos';

    public function __construct() {
        // cria a database e conecta ao banco de dados
        $db = new Database('localhost','provap1','root','');
        $this->conexao = $db->getConnection();
    }

    public function create($nome, $raca, $cor, $sexo) {
        // executar INSERT INTO gatos
        $sql = 'INSERT INTO ' . $this->tableName . ' (gat_nome, gat_raca, gat_cor, gat_sexo) VALUES (:param1, :param2, :param3, :param4)';
        try {
            $acesso = $this->conexao->prepare($sql);
            $acesso->bindParam(':param1', $nome);
            $acesso->bindParam(':param2', $raca);
            $acesso->bindParam(':param3', $cor);
            $acesso->bindParam(':param4', $sexo);
            if ($acesso->execute()) {
                // return true;
                return $this->conexao->lastInsertId(); // retornando o valor do id auto incrementado
            }
            else {
                return false;
            }
        }
        catch (PDOException $erro) {
            echo "Erro ao inserir na tabela 'gatos': " . $erro->getMessage();
        }
    }

    public function recovery() {
        // executar SELECT * from gatos
        $sql = 'SELECT * FROM ' . $this->tableName;
        try {
            $acesso = $this->conexao->prepare($sql);
            $acesso->execute();
            return $acesso->fetchAll(PDO::FETCH_ASSOC); // retorna todos os dados
        }
        catch (PDOException $erro) {
            echo "Erro ao recuperar os dados: " . $erro->getMessage();
        }
    }

    public function recoveryByName($nomeBusca) {
        // retornar a linha da tabela com o nome igual
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE gat_nome = :gat_nome';
        try {
            $acesso = $this->conexao->prepare($sql);
            $acesso->bindParam(':gat_nome', $nomeBusca);
            $acesso->execute();
            return $acesso->fetchAll(PDO::FETCH_ASSOC); // retorna as linhas encontradas
        }
        catch (PDOException $erro) {
            echo "Erro ao recuperar o registro por nome: " . $erro->getMessage();
        }
    }

    public function update($codigo, $nome = null, $raca = null, $cor = null, $sexo = null) {
        $campos = []; // array de campos que foram alterados
        $parametros = []; // array de valores recebidos
        if ($nome) {
            $campos[] = "gat_nome = ?";
            $parametros[] = $nome;
        }
        if ($raca) {
            $campos[] = "gat_raca = ?";
            $parametros[] = $raca;
        }
        if ($cor) {
            $campos[] = "gat_cor = ?";
            $parametros[] = $cor;
        }
        if ($sexo) {
            $campos[] = "gat_sexo = ?";
            $parametros[] = $sexo;
        }
        // se nenhum campo for passado (array de campos está vazio)
        if (count($campos) === 0) {
            return false;
        }
        // query SQL criado dinamicamente
        $sql = 'UPDATE ' . $this->tableName . ' SET ' . implode(", ", $campos) . ' WHERE gat_cod = ?';
        $parametros[] = $codigo;
    
        try {
            $acesso = $this->conexao->prepare($sql);
            return $acesso->execute($parametros);
        } catch (PDOException $e) {
            echo "Erro ao atualizar o registro: " . $e->getMessage();
            return false;
        }
    }

    public function delete($codigo) {
        // excluir o registro com codigo
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE gat_cod = :gat_cod';
        try {
            $acesso = $this->conexao->prepare($sql);
            $acesso->bindParam(':gat_cod', $codigo);
            if ($acesso->execute()) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (PDOException $erro) {
            echo "Erro ao excluir o registro: " . $erro->getMessage();
        }
    }
}

?>