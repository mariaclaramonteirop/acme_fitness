<?php
namespace Maria\AcmeFitness\Dao;
use App\models\Categoria;
use Src\core\PDOSingleton;
use PDO;
use PDOException;

class CategoriaDao {
    
    private $conn;
    public function __construct() {
        $this->conn = PDOSingleton::get();
        
    }

    public function adicionar(Categoria $categoria) {
        try{$sql = "INSERT INTO categorias(nome , descricao ) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $categoria->getNome());
        $stmt->bindParam(2, $categoria->getDescricao());
        $stmt->execute();

        return true;
        }catch(PDOException $e){
            echo "Erro ao adicionar categoria: " . $e->getMessage();
            return false;
        }
    }

    public function alterar(Categoria $categoria) {
        try{
            $sql = "UPDATE categorias SET nome = ?, descricao = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $categoria->getNome());
            $stmt->bindParam(2, $categoria->getDescricao());
            $stmt->bindParam(3, $categoria->getId());
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao alterar categoria: " . $e->getMessage();
            return false;
        }
    }

    public function excluir($id) {
        try{
            $sql = "DELETE FROM categorias WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo "Erro ao excluir categoria: " . $e->getMessage();
            return false;
        }
    }

    public function listarUm($id) {
        try{
            $sql = "SELECT * FROM categorias WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $categoria = new Categoria($result['nome'], $result['descricao']);
            $categoria->setId($result['id']);
            return $categoria;
        }catch(PDOException $e){
            echo "Erro ao listar categoria: " . $e->getMessage();
            return false;
        }
    }

    public function listarTodos() {
        try{
            $sql = "SELECT * FROM categorias";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $categorias = array();

            foreach($result as $r){
                $categoria = new Categoria($r['nome'], $r['descricao']);
                $categoria->setId($r['id']);
                array_push($categorias, $categoria);
            }
            return $categorias;
        }catch(PDOException $e){
            echo "Erro ao listar categorias: " . $e->getMessage();
            return false;
        }
    }
}