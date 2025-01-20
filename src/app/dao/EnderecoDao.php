<?php

namespace Maria\AcmeFitness\Dao;
use App\models\Endereco;
use Src\core\PDOSingleton;
use PDO;
use PDOException;

class EnderecoDao{

    private $conn;

    public function __construct(){
        $this->conn = PDOSingleton::get();
    }

    public function adicionar(Endereco $endereco){
        try{
            $sql = "INSERT INTO endereco (logradouro, numero, bairro, cidade, estado, cep) VALUES (:logradouro, :numero, :bairro, :cidade, :estado, :cep)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':logradouro', $endereco->getLogradouro());
            $stmt->bindValue(':numero', $endereco->getNumero());
            $stmt->bindValue(':bairro', $endereco->getBairro());
            $stmt->bindValue(':cidade', $endereco->getCidade());
            $stmt->bindValue(':estado', $endereco->getEstado());
            $stmt->bindValue(':cep', $endereco->getCep());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    public function alterar(Endereco $endereco){
        try{
            $sql = "UPDATE endereco SET logradouro = :logradouro, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':logradouro', $endereco->getLogradouro());
            $stmt->bindValue(':numero', $endereco->getNumero());
            $stmt->bindValue(':bairro', $endereco->getBairro());
            $stmt->bindValue(':cidade', $endereco->getCidade());
            $stmt->bindValue(':estado', $endereco->getEstado());
            $stmt->bindValue(':cep', $endereco->getCep());
            $stmt->bindValue(':id', $endereco->getId());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    public function excluir($id){
        try{
            $sql = "DELETE FROM endereco WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    public function listarUm($id){
        try{
            $sql = "SELECT * FROM endereco WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $clienteDao = new ClienteDao();
            $cliente = $clienteDao->listarUm($result['id_cliente']);
            $endereco = new Endereco($result['logradouro'], $result['numero'], $result['bairro'], $result['cidade'], $result['estado'], $result['cep'], $cliente);
            $endereco->setId($stmt['id']);

            return $endereco;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }
    }

    public function listarTodos(){
        try{
            $sql = "SELECT * FROM endereco";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $clienteDao = new ClienteDao();

            foreach($result as $r){
                $cliente = $clienteDao->listarUm($r['id_cliente']);
                $endereco = new Endereco($r['logradouro'], $r['numero'], $r['bairro'], $r['cidade'], $r['estado'], $r['cep'], $cliente);
                $endereco->setId($r['id']);
                $enderecos[] = $endereco;
            }

            return $enderecos;
        }catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
            return false;
        }
    }
}