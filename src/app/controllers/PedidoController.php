<?php

namespace Maria\AcmeFitness\Controllers;

use App\dao\ClienteDao;
use App\dao\enderecoDao;
use App\dao\PedidoDao;
use App\dao\VariacaoDao;
use App\models\Pedido;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use http\HttpCodeStatus;

class PedidoController {
    private $pedidoDao;
    private $clienteDao;
    private $enderecoDao;
    private $variacaoDao;
    public function __construct(PedidoDao $pedidoDao, ClienteDao $clienteDao, EnderecoDao $enderecoDao, VariacaoDao $variacaoDao) {
        $this->pedidoDao = $pedidoDao;
        $this->clienteDao = $clienteDao;
        $this->enderecoDao = $enderecoDao;
        $this->variacaoDao = $variacaoDao;
    }

    public function adicionar(Request $request, Response $response, array $args) {
        try {
            $data = $request->getParsedBody();

            // Obtendo os dados do cliente
            $cliente = $this->clienteDao->listarUm($data['id_cliente']);

            // Obtendo os dados do endereço
            $endereco = $this->enderecoDao->listarUm($data['id_endereco']);

            $formaPagamento = $data['formaPagamento'];
            $dataPedido = date('Y-m-d');

            $pedido = new Pedido($cliente, $endereco, $formaPagamento, $dataPedido, $itensData);

            // Obtendo os itens de venda
            $itensData = $data['itensPedido'];
            
            foreach ($itensData as $i) {
                $variacao = $this->variacaoDao->listarUm($i['id_variacao']);
                $pedido->adicionarItemPedido($variacao, $i['quantidade']);
            }

            $this->pedidoDao->adicionar($pedido);

            $response = $response->withHeader('Content-Type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Pedido adicionado com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::CREATED);
        } catch (Exception $e) {
            // Resposta de erro
            $response->getBody()->write(json_encode(['error' => 'Erro ao adicionar pedido: ' . $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR)->withHeader('Content-Type', 'application/json');
        }
    }
}