<?php

namespace \App\Controllers;

use CategoriaDao;
use http\HttpCodeStatus;
use App\models\Categoria;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
class CategoriaController {

    private $categoriaDao;

    public function __construct(CategoriaDao $categoriaDao) {
        $this->categoriaDao = $categoriaDao;
    }

    public function adicionar(Request $request, Response $response, $args) {
        try{      
            $data = $request->getParsedBody();

            $categoria = new Categoria($data['nome'], $data['descricao']);
            $this->categoriaDao->adicionar($categoria);

            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Categoria adicionada com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response;
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['error' => 'Erro ao adicionar categoria: ' . $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR)->withHeader('Content-Type', 'application/json');
        }
    }
    public function alterar(Request $request, Response $response, $args) {
        try{
            $data = $request->getParsedBody();
            $categoria = new Categoria($data['nome'], $data['descricao'], $data['id']);
            $this->categoriaDao->alterar($categoria);

            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Categoria alterada com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response;
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['error' => 'Erro ao alterar categoria: ' . $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR)->withHeader('Content-Type', 'application/json');
        }
    }

    public function excluir(Request $request, Response $response, $args) {
        $id = $args['id'];
        if($id === null){
            $response->getBody()->write(json_encode(['error' => 'ID não informado']));
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST)->withHeader('Content-Type', 'application/json');
        }
        try{
            $this->categoriaDao->excluir($id);

            $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Categoria excluída com sucesso']);
            $response->getBody()->write($jsonResponse);

            return $response;
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['error' => 'Erro ao excluir categoria: ' . $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR)->withHeader('Content-Type', 'application/json');
        }
    }
    
    public function listarUm(Request $request, Response $response, $args) {
        $id = $args['id'];
        if($id === null){
            $response->getBody()->write(json_encode(['error' => 'ID não informado']));
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST)->withHeader('Content-Type', 'application/json');
        }
        try{
            $categoria = $this->categoriaDao->listarUm($id);

            if($categoria === null){
                $response->getBody()->write(json_encode(['error' => 'Categoria não encontrada']));
                return $response->withStatus(HttpCodeStatus::NOT_FOUND)->withHeader('Content-Type', 'application/json');
            }
            
            $response->getBody()->write(json_encode($categoria));
            $response->withStatus(HttpCodeStatus::OK)->withHeader('Content-Type', 'application/json');

            return $response;
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['error' => 'Erro ao buscar categoria: ' . $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR)->withHeader('Content-Type', 'application/json');
        }
    }
    public function listarTodos(Request $request, Response $response, $args) {
        try{
            $categorias = $this->categoriaDao->listarTodos();

            if(empty($categorias)){
                $response->getBody()->write(json_encode(['error' => 'Nenhuma categoria encontrada']));
                return $response->withStatus(HttpCodeStatus::NOT_FOUND)->withHeader('Content-Type', 'application/json');
            }
            $response->getBody()->write(json_encode($categorias));
            $response->withStatus(HttpCodeStatus::OK)->withHeader('Content-Type', 'application/json');

            return $response;
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['error' => 'Erro ao buscar categorias: ' . $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR)->withHeader('Content-Type', 'application/json');
        }
    }
}