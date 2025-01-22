<?php

use Maria\AcmeFitness\Controllers\CategoriaController;
use Maria\AcmeFitness\Controllers\ClienteController;
use Maria\AcmeFitness\Controllers\EnderecoController;
use Maria\AcmeFitness\Controllers\PedidoController;
use Maria\AcmeFitness\Controllers\VariacaoController;
use Maria\AcmeFitness\Controllers\ProdutoController;
use Slim\App;

return function (App $app) {
    $app->group('/api', function () use ($app) {
        // Categoria Routes
        $app->post('/categorias', [CategoriaController::class, 'adicionar']);
        $app->put('/categorias', [CategoriaController::class, 'alterar']);
        $app->delete('/categorias/{id}', [CategoriaController::class, 'excluir']);
        $app->get('/categorias/{id}', [CategoriaController::class, 'listarUm']);
        $app->get('/categorias', [CategoriaController::class, 'listarTodos']);

        // Produto Routes
        $app->post('/produtos', [ProdutoController::class, 'adicionar']);
        $app->put('/produtos', [ProdutoController::class, 'alterar']);
        $app->delete('/produtos/{id}', [ProdutoController::class, 'excluir']);
        $app->get('/produtos/{id}', [ProdutoController::class, 'listarUm']);
        $app->get('/produtos', [ProdutoController::class, 'listarTodos']);

        // Variação Routes
        $app->post('/variacoes', [VariacaoController::class, 'adicionar']);
        $app->put('/variacoes', [VariacaoController::class, 'alterar']);
        $app->delete('/variacoes/{id}', [VariacaoController::class, 'excluir']);
        $app->get('/variacoes/{id}', [VariacaoController::class, 'listarUm']);
        $app->get('/variacoes', [VariacaoController::class, 'listarTodos']);

        // Cliente Routes
        $app->post('/clientes', [ClienteController::class, 'adicionar']);
        $app->put('/clientes', [ClienteController::class, 'alterar']);
        $app->delete('/clientes/{id}', [ClienteController::class, 'excluir']);
        $app->get('/clientes/{id}', [ClienteController::class, 'listarUm']);
        $app->get('/clientes', [ClienteController::class, 'listarTodos']);

        // Endereço Routes
        $app->post('/enderecos', [EnderecoController::class, 'adicionar']);
        $app->put('/enderecos', [EnderecoController::class, 'alterar']);
        $app->delete('/enderecos/{id}', [EnderecoController::class, 'excluir']);
        $app->get('/enderecos/{id}', [EnderecoController::class, 'listarUm']);
        $app->get('/enderecos', [EnderecoController::class, 'listarTodos']);

        // Pedido Routes
        $app->post('/pedidos', [PedidoController::class, 'adicionar']);
    });
};
