<?php

namespace Maria\AcmeFitness\Controllers;

use App\dao\ProdutoDao;
use App\dao\VariacaoDao;
use App\models\Variacao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;
use http\HttpCodeStatus;

class VariacaoController{
    private $variacaoDao;
    private $produtoDao;

    public function __construct(VariacaoDao $variacaoDao, ProdutoDao $produtoDao){
        $this->variacaoDao = $variacaoDao;
        $this->produtoDao = $produtoDao;
    }

    public function adicionar(Request $request, Response $response, array $args): Response{
        try{
            $data = $request->getParsedBody();
            $produto = $this->produtoDao->listarUm($data['produto_id']);
            if($produto == null){
                throw new Exception('Produto não encontrado');
            }
            $variacao = new Variacao($data['cor'], $data['imagem'], $data['tamanho'], $data['quantidade'], $produto);
            $this->variacaoDao->adicionar($variacao);
            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['mensagem' => 'Variacao adicionada com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::CREATED);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST);
        }
    }

    public function alterar(Request $request, Response $response, array $args): Response{
        try{
            $data = $request->getParsedBody();
            $produto = $this->produtoDao->listarUm($data['id_produto']);
            $variacao = new Variacao($data['cor'], $data['imagem'], $data['tamanho'], $data['quantidade'], $produto);

            $variacao->setId($data['id']);
            $this->variacaoDao->alterar($variacao);

            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['mensagem' => 'Variacao alterada com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST);
        }
    }

    public function excluir(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        if($id == null){
            $response->withStatus(HttpCodeStatus::BAD_REQUEST)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['erro' => 'ID não informado']));
            return $response;
        }

        try{
            $this->variacaoDao->excluir($id);
            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode(['mensagem' => 'Variacao excluída com sucesso']);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::BAD_REQUEST);
        }
    }

    public function listarUm(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        if($id == null){
            $response->withStatus(HttpCodeStatus::BAD_REQUEST)->withHeader('Content-Type', 'application/json')->getBody()->write(json_encode(['erro' => 'ID não informado']));
            return $response;
        }

        try{
            $variacao = $this->variacaoDao->listarUm($id);
            if($variacao == null){
                throw new Exception('Variacao não encontrada');
                return $response->withStatus(HttpCodeStatus::NOT_FOUND)->withHeader('Content-Type', 'application/json');
            }
            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode($variacao);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::NOT_FOUND);
        }
    }

    public function listarTodos(Request $request, Response $response, array $args): Response{
        try{
            $variacao = $this->variacaoDao->listarTodos();

            if(empty($variacao)){
                throw new Exception('Nenhuma variacao encontrada');
                return $response->withStatus(HttpCodeStatus::NOT_FOUND)->withHeader('Content-Type', 'application/json');
            }
            $response = $response->withHeader('Content-type', 'application/json');
            $jsonResponse = json_encode($variacao);
            $response->getBody()->write($jsonResponse);
            return $response->withStatus(HttpCodeStatus::OK);
        }catch(Exception $e){
            $response->getBody()->write(json_encode(['erro' => $e->getMessage()]));
            return $response->withStatus(HttpCodeStatus::NOT_FOUND);
        }
    }
}
