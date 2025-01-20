<?php

namespace Maria\AcmeFitness\Controllers;

use App\dao\ClienteDao;
use App\dao\EnderecoDao;
use App\models\Endereco;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use http\HttpCodeStatus;

class EnderecoController{

    private $enderecoDao;
    private $clienteDao;

    public function __construct(EnderecoDao $enderecoDao, ClienteDao $clienteDao){
        $this->enderecoDao = $enderecoDao;
        $this->clienteDao = $clienteDao;
    }

    public function adicionar(Request $request, Response $response, $args){
        try{
            $data = $request->getParsedBody();
            $cliente = $this->clienteDao->listarUm($data['id_cliente']);
            $endereco = new Endereco($cliente, $data['logradouro'], $data['numero'], $data['bairro'], $data['cidade'], $data['estado']);
            $this->enderecoDao->adicionar($endereco);

            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Endereço adicionado com sucesso!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Erro ao adicionar endereço!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function alterar(Request $request, Response $response, $args){
        try{
            $data = $request->getParsedBody();
            $cliente = $this->clienteDao->listarUm($data['id_cliente']);
            $endereco = new Endereco($cliente, $data['logradouro'], $data['numero'], $data['bairro'], $data['cidade'], $data['estado']);
            $endereco->setId($data['id']);
            $this->enderecoDao->alterar($endereco);

            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Endereço alterado com sucesso!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Erro ao alterar endereço!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function excluir(Request $request, Response $response, $args){
        $id = $args['id'];
        if($id == null){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Endereço não encontrado!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::NOT_FOUND);
        }
        try{
            $data = $request->getParsedBody();
            $this->enderecoDao->excluir($id);

            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Endereço excluído com sucesso!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Erro ao excluir endereço!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }
    public function listarUm(Request $request, Response $response, $args){
        $id = $args['id'];
        if($id == null){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Endereço não encontrado!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::NOT_FOUND);
        }
        try{
            $endereco = $this->enderecoDao->listarUm($id);
            if($endereco == null){
                $response->withHeader('Content-type', 'application/json');
                $jsonResponse = json_encode(['message' => 'Endereço não encontrado!']);
                $response->getBody()->write($jsonResponse);
                return $response->withStatus(HttpCodeStatus::NOT_FOUND);
            }
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode($endereco);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Erro ao buscar endereço!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function listarTodos(Request $request, Response $response, $args){
        try{
            $enderecos = $this->enderecoDao->listarTodos();
            if(empty($enderecos)){
                $response->withHeader('Content-type', 'application/json');
                $jsonResponse = json_encode(['message' => 'Nenhum endereço encontrado!']);
                $response->getBody()->write($jsonResponse);
                return $response->withStatus(HttpCodeStatus::NOT_FOUND);
            }
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode($enderecos);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Erro ao buscar endereços!']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }
}
