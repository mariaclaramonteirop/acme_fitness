<?php

namespace Maria\AcmeFitness\Controllers;


use Maria\AcmeFitness\Dao\CategoriaDao;
use Maria\AcmeFitness\Dao\ProdutoDao;
use Maria\AcmeFitness\Models\Produto;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use http\HttpCodeStatus;

class ProdutoController{

    private $produtoDao;
    private $categoriaDao;

    public function __construct(ProdutoDao $produtoDao, CategoriaDao $categoriaDao)
    {
        $this->produtoDao = $produtoDao;
        $this->categoriaDao = $categoriaDao;
    }
    
    public function adicionar(Request $request, Response $response, $args){
        try{
            $data = $request->getParsedBody();

            $categoria = $this->categoriaDao->listarUm($data['id_categoria']);
            $dataCadastro = date('Y-m-d');
            
            $produto = new Produto($data['codigo'],$data['nome'], $data['descricao'], $data['preco'], $data['peso'], $dataCadastro, $categoria);
            $this->produtoDao->adicionar($produto);

            $categoria = $this->categoriaDao->listarUm($data['id_categoria']);
            $dataCadastro = date('Y-m-d');
            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Produto adicionado com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::CREATED);
        }catch(Exception $e){
            $response->getBody()->write('Erro ao adicionar produto');
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function alterar(Request $request, Response $response, $args){
        try{
            $data = $request->getParsedBody();
            $categoria = $this->categoriaDao->listarUm($data['id_categoria']);
            $dataCadastro = date('Y-m-d');

            $produto = new Produto($data['codigo'], $data['nome'], $data['descricao'], $data['preco'], $data['peso'], $dataCadastro, $categoria);

            $produto->setId($data['id']);

            $this->produtoDao->alterar($produto);

            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Produto alterado com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write('Erro ao alterar produto');
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function excluir(Request $request, Response $response, $args){
        $id = $args['id'];
        if($id == null){
            $response->getBody()->write('Id não informado');
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST);
        }

        try{
            $this->produtoDao->excluir($id);

            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['message' => 'Produto excluído com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write('Erro ao excluir produto');
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function listarTodos(Request $request, Response $response, $args){
        try{
            $produtos = $this->produtoDao->listarTodos();
            if(count($produtos) == 0){
                $response->getBody()->write('Nenhum produto encontrado');
                return $response->withStatus(HttpCodeStatus::NOT_FOUND);
            }

            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode($produtos);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write('Erro ao listar produtos');
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function listarUm(Request $request, Response $response, $args){
        $id = $args['id'];
        if($id == null){
            $response->getBody()->write('Id não informado');
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST);
        }

        try{
            $produto = $this->produtoDao->listarUm($id);
            if($produto == null){
                $response->getBody()->write('Produto não encontrado');
                return $response->withStatus(HttpCodeStatus::NOT_FOUND);
            }

            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode($produto);
            $response->getBody()->write($jsonResponse);
            
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write('Erro ao listar produto');
            return $response->withStatus(HttpCodeStatus::INTERNAL_SERVER_ERROR);
        }
    }
}