<?php

namespace Maria\AcmeFitness\Controllers;
use Maria\AcmeFitness\Models\Cliente;
use Maria\AcmeFitness\Dao\ClienteDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use http\HttpCodeStatus;



class ClienteController{

    private $clienteDao;

    public function __construct(ClienteDao $clienteDao){
        $this->clienteDao = $clienteDao;
    }

    public function adicionar(Request $request, Response $response, array $args): Response{
        try{
            $data = $request->getParsedBody();
        $cliente = new Cliente($data['nome'], $data['cpf'], $data['data_nascimento']);
        $cliente->setId($data['id']);
            $this->clienteDao->adicionar($cliente);

            $response = $response->withHeader('content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Cliente adicionado com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::CREATED);

        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function alterar(Request $request, Response $response, array $args): Response{
        try{
            $data = $request->getParsedBody();
            $cliente = new Cliente($data['nome'], $data['cpf'], $data['data_nascimento']);
            $cliente->setId($data['id']);
            $this->clienteDao->alterar($cliente);

            $response = $response->withHeader('content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Cliente alterado com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function excluir(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        if($id == null){
            $response->withStatus(HttpCodeStatus::BAD_REQUEST)->withHeader('Content-Type', 'application\json')->getBody()->write(json_encode(['erro' => 'É necessário informar o id do cliente']));
            return $response;
        }
        try{
            $this->clienteDao->excluir($id);

            $response = $response->withHeader('content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Cliente excluído com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function listarUm(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        if($id == null){
            $response->withStatus(HttpCodeStatus::BAD_REQUEST)->withHeader('Content-Type', 'application\json')->getBody()->write(json_encode(['erro' => 'É necessário informar o id do cliente']));
            return $response;
        }
        try{
            $cliente = $this->clienteDao->listarUm($id);

            if($cliente == null){
                $response->withStatus(HttpCodeStatus::NOT_FOUND)->withHeader('Content-Type', 'application\json')->getBody()->write(json_encode(['erro' => 'Cliente não encontrado']));
                return $response;
            }

            $response = $response->withHeader('content-type', 'application/json');
            $jsonResponse = json_encode($cliente);

            $response->getBody()->write($jsonResponse);

            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    } 

    public function listarTodos(Request $request, Response $response, array $args): Response{
        try{
            $clientes = $this->clienteDao->listarTodos();

            if(empty($clientes)){
                $response->withStatus(HttpCodeStatus::NOT_FOUND)->withHeader('Content-Type', 'application\json')->getBody()->write(json_encode(['erro' => 'Nenhum cliente encontrado']));
                return $response;
            }
            
            $response = $response->withHeader('content-type', 'application/json');
            $jsonResponse = json_encode($clientes);

            $response->getBody()->write($jsonResponse);

            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }
}