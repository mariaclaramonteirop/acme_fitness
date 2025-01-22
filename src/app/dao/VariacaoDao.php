<?php

namespace Maria\AcmeFitness\Dao;

use Maria\AcmeFitness\Models\Variacao;
use core\PDOSingleton;
use PDO;
use PDOException;

class VariacaoDao{

    private $conn;

    public function __construct() {
        $this->conn = PDOSingleton::get();
    }

    public function adicionar(Variacao $variacao) {
        try{
            $sql = "INSERT INTO variacoes(id_produto, cor, imagem, tamanho, estoque) VALUES (:id_produto, :cor, :imagem, :tamanho, :estoque)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_produto', $variacao->getProduto()->getId());
            $stmt->bindParam(':cor', $variacao->getCor());
            $stmt->bindParam(':imagem', $variacao->getImagem());
            $stmt->bindParam(':tamanho', $variacao->getTamanho());
            $stmt->bindParam(':estoque', $variacao->getQuantidade());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao adicionar variação: " . $e->getMessage();
            return false;
        }
    }

    public function alterar(Variacao $variacao) {
        try{
            $sql = "UPDATE variacoes SET cor = :cor, imagem = :imagem, tamanho = :tamanho, estoque = :estoque WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_produto', $variacao->getProduto()->getId());
            $stmt->bindParam(':cor', $variacao->getCor());
            $stmt->bindParam(':imagem', $variacao->getImagem());
            $stmt->bindParam(':tamanho', $variacao->getTamanho());
            $stmt->bindParam(':estoque', $variacao->getQuantidade());
            $stmt->bindParam(':id', $variacao->getId());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao alterar variação: " . $e->getMessage();
            return false;
        }
    }

    public function excluir($id) {
        try{
            $sql = "DELETE FROM variacoes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao excluir variação: " . $e->getMessage();
            return false;
        }
    }

    public function listarUm($id) {
        try{
            $sql = "SELECT * FROM variacoes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $produtoDao = new ProdutoDao();
            $produto = $result['id_produto'];
            $variacao = new Variacao($result['cor'], $result['imagem'], $result['tamanho'], $result['estoque'], $produto);
            $variacao->setId($result['id']);

            return $variacao;

        }catch(PDOException $e){
            echo "Erro ao listar variação: " . $e->getMessage();
            return null;
        }
    }

    public function listarTodos() {
        try{
            $sql = "SELECT * FROM variacoes";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $variacoes = array();
            foreach($result as $r){
                $produtoDao = new ProdutoDao();
                $produto = $produtoDao->listarUm($r['id_produto']);
                $variacao = new Variacao($r['cor'], $r['imagem'], $r['tamanho'], $r['estoque'], $produto);
                $variacao->setId($r['id']);
                array_push($variacoes, $variacao);
            }
            
            return $variacoes;
        }catch(PDOException $e){
            echo "Erro ao listar variações: " . $e->getMessage();
            return null;
        }
    }
}