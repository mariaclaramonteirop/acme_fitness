<?php

namespace Maria\AcmeFitness\Dao;
use Maria\AcmeFitness\Models\Pedido;
use PDOException;
use core\PDOSingleton;

class PedidoDao{
    private $conn;

    public function __construct(){
        $this->conn = PDOSingleton::get();
    }

    private function adicionarItensPedido($itens, $id) {
        $variacaoDao = new VariacaoDao();
    
        foreach ($itens as $i) {
            $quantidadeDisponivel = $i['produto']->getQuantidade();
    
            if ($quantidadeDisponivel >= $i['quantidade']) {
                $novaQuantidade = $quantidadeDisponivel - $i['quantidade'];
                $i['produto']->setQuantidade($novaQuantidade);
                $variacaoDao->alterar($i['produto']);
    
                $sql = "INSERT INTO item_pedido(id_pedido, id_variacao, preco, quantidade) VALUES(:id_pedido, :id_variacao, :preco, :quantidade)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id_pedido', $id);
                $stmt->bindValue(':id_variacao', $i['produto']->getId());
                $stmt->bindValue(':preco', $i['produto']->getPreco());
                $stmt->bindValue(':quantidade', $i['quantidade']);
                $stmt->execute();
            } else {
                throw new PDOException("Quantidade indisponível em estoque para o produto {$i['produto']->getNome()} e id {$i['produto']->getId()}");
            }
        }
    }
    public function adicionar(Pedido $pedido){
        
        try{
        $this->conn->beginTransaction();
            $sql = "INSERT INTO pedido (id_cliente, id_endereco, valor_frete, desconto, valor_total, forma_pagamento, data_pedido) VALUES (:id_cliente, :id_endereco, :id_variacao, :quantidade, :valor_total, :forma_pagamento, :data_pedido)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id_cliente', $pedido->getCliente()->getId());
            $stmt->bindValue(':id_endereco', $pedido->getEndereco()->getId());
            $stmt->bindValue(':valor_frete', $pedido->getValorFrete());
            $stmt->bindValue(':desconto', $pedido->getDesconto());
            $stmt->bindValue(':valor_total', $pedido->calcularTotalPedido());
            $stmt->bindValue(':forma_pagamento', $pedido->getFormaPagamento());
            $stmt->bindValue(':data_pedido', $pedido->getDataPedido());
            $stmt->execute();

            $idPedido = $this->conn->lastInsertId();
            $this->adicionarItensPedido($idPedido, $pedido->getItensPedido());
            $this->conn->commit();
            
        }catch(PDOException $e){
            $this->conn->rollBack();
            throw new PDOException($e->getMessage());
        }


    }
}