<?php

namespace Maria\AcmeFitness\Dao;

use Src\core\PDOSingleton;
use App\models\Cliente;
use PDO;
use PDOException;

class ClienteDao{
    private $conn;

    public function __construct(){
        $this->conn = PDOSingleton::get();
    }

    public function adicionar(Cliente $cliente){
        try{
            $sql = "INSERT INTO clientes(nome, cpf, data_nacimento) VALUES(:nome, :cpf, :data_nacimento)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $cliente->getNome());
            $stmt->bindParam(':cpf', $cliente->getCpf());
            $stmt->bindParam(':data_nacimento', $cliente->getDataDeNascimento());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao adicionar cliente: " . $e->getMessage();
            return false;
        }
    }
    public function alterar(Cliente $cliente){
        try{
            $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, data_nacimento = :data_nacimento WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $cliente->getNome());
            $stmt->bindParam(':cpf', $cliente->getCpf());
            $stmt->bindParam(':data_nacimento', $cliente->getDataDeNascimento());
            $stmt->bindParam(':id', $cliente->getId());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao alterar cliente: " . $e->getMessage();
            return false;
        }
    }
    public function excluir($id){
        try{
            $sql = "DELETE FROM clientes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao excluir cliente: " . $e->getMessage();
            return false;
        }
    }

    public function listarUm($id){
        try{
            $sql = "SELECT * FROM clientes WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erro ao listar um cliente: " . $e->getMessage();
            return false;
        }
    }

    public function listarTodos(){
        try{
            $sql = "SELECT * FROM clientes";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $clientes = [] ;
            foreach($result as $r){
                $cliente = new Cliente($r['nome'], $r['cpf'], $r['data_nacimento']);
                $cliente->setId($r['id']);
                $clientes[] = $cliente;
            }
            return $clientes;
        }catch(PDOException $e){
            echo "Erro ao listar todos os clientes: " . $e->getMessage();
            return false;
        }
    }

}
