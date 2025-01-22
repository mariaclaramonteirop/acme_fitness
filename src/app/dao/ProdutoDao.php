<?php

namespace Maria\AcmeFitness\Dao;
use Maria\AcmeFitness\Models\Produto;
use core\PDOSingleton;
use PDO;
use PDOException;

class ProdutoDao
{
    private $conn;

    public function __construct() {
        $this->conn = PDOSingleton::get();
    }

    public function adicionar(Produto $produto){

        try {
            $sql = "INSERT INTO produtos(codigo, nome, descricao, preco, peso, data_cadastro, id_categoria) VALUES(:codigo, :nome, :descricao, :preco, :peso, :data_cadastro, :id_categoria)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':codigo', $produto->getCodigo());
            $stmt->bindValue(':nome', $produto->getNome());
            $stmt->bindValue(':descricao', $produto->getDescricao());
            $stmt->bindValue(':preco', $produto->getPreco());
            $stmt->bindValue(':peso', $produto->getPeso());
            $stmt->bindValue(':data_cadastro', $produto->getDataCadastro());
            $stmt->bindValue(':id_categoria', ($produto->getCategoria())->getId());
            $stmt->execute();
            return true;

        } catch (PDOException $e) {

            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function alterar(Produto $produto){

        try {
            $sql = "UPDATE produtos SET codigo = :codigo , nome = :nome, descricao = :descricao, preco = :preco, peso = :peso, data_cadastro = :data_cadastro, id_categoria = :id_categoria WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':codigo', $produto->getCodigo());
            $stmt->bindValue(':nome', $produto->getNome());
            $stmt->bindValue(':descricao', $produto->getDescricao());
            $stmt->bindValue(':preco', $produto->getPreco());
            $stmt->bindValue(':peso', $produto->getPeso());
            $stmt->bindValue(':data_cadastro', $produto->getDataCadastro());
            $stmt->bindValue(':id_categoria', ($produto->getCategoria())->getId());
            $stmt->bindValue(':id', $produto->getId());
            return $stmt->execute();

        } catch (PDOException $e) {

            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function excluir($id){

        try {
            $sql = "DELETE FROM produtos WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return true;

        } catch (PDOException $e) {

            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function listarUm($id) {

        try {
            $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoriaDao = new CategoriaDao();
            $categoria = $categoriaDao->listarUm($result['id_categoria']);
            $produto = new Produto($result['codigo'], $result['nome'], $result['descricao'], $result['preco'], $result['peso'], $result['data_cadastro'], $categoria);
            $produto->setId($result['id']);

            return $produto;

        } catch (PDOException $e) {

            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function listarTodos() {

        try {
            $stmt = $this->conn->prepare("SELECT * FROM produtos");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $produtos = [];
            $categoriaDao = new CategoriaDao();
            $categoria = $categoriaDao->listarUm($result['id_categoria']);

            foreach($result as $resultado) {
                $categoria = $categoriaDao->listarUm($resultado['id_categoria']);
                $produto = new Produto($resultado['codigo'], $resultado['nome'], $resultado['descricao'], $resultado['preco'], $resultado['peso'], $resultado['data_cadastro'], $categoria);
                $produto->setId($resultado['id']);
                $produtos[] = $produto;
            }

            return $produtos;

        } catch (PDOException $e) {

            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

}
