<?php

use Slim\App;

return function (App $app) {
    $app->group('/api', function () use ($app) {

        $app->post('/categoria/adicionar', 'Maria\AcmeFitness\ControllersCategoriaController:adicionar');
        $app->post('/categoria/alterar', 'Maria\AcmeFitness\ControllersCategoriaController:alterar');
        $app->delete('/categoria/excluir/{id}', 'Maria\AcmeFitness\ControllersCategoriaController:excluir');
        $app->get('/categoria/listar/{id}', 'Maria\AcmeFitness\ControllersCategoriaController:listarUm');
        $app->get('/categoria/listar', 'Maria\AcmeFitness\ControllersCategoriaController:listarTodos');

        $app->post('/produto/adicionar', 'Maria\AcmeFitness\ControllersProdutoController:adicionar');
        $app->post('/produto/alterar', 'Maria\AcmeFitness\ControllersProdutoController:alterar');
        $app->delete('/produto/excluir/{id}', 'Maria\AcmeFitness\ControllersProdutoController:excluir');
        $app->get('/produto/listar/{id}', 'Maria\AcmeFitness\ControllersProdutoController:listarUm');
        $app->get('/produto/listar', 'Maria\AcmeFitness\ControllersProdutoController:listarTodos');

        $app->post('/variacao/adicionar', 'Maria\AcmeFitness\ControllersVariacaoController:adicionar');
        $app->post('/variacao/alterar', 'Maria\AcmeFitness\ControllersVariacaoController:alterar');
        $app->delete('/variacao/excluir/{id}', 'Maria\AcmeFitness\ControllersVariacaoController:excluir');
        $app->get('/variacao/listar/{id}', 'Maria\AcmeFitness\ControllersVariacaoController:listarUm');
        $app->get('/variacao/listar', 'Maria\AcmeFitness\ControllersVariacaoController:listarTodos');
        
        $app->post('/cliente/adicionar', 'Maria\AcmeFitness\ControllersClienteController:adicionar');
        $app->post('/cliente/alterar', 'Maria\AcmeFitness\ControllersClienteController:alterar');
        $app->delete('/cliente/excluir/{id}', 'Maria\AcmeFitness\ControllersClienteController:excluir');
        $app->get('/cliente/listar/{id}', 'Maria\AcmeFitness\ControllersClienteController:listarUm');
        $app->get('/cliente/listar', 'Maria\AcmeFitness\ControllersClienteController:listarTodos');

        $app->post('/endereco/adicionar', 'Maria\AcmeFitness\ControllersEnderecoController:adicionar');
        $app->post('/endereco/alterar', 'Maria\AcmeFitness\ControllersEnderecoController:alterar');
        $app->delete('/endereco/excluir/{id}', 'Maria\AcmeFitness\ControllersEnderecoController:excluir');
        $app->get('/endereco/listar/{id}', 'Maria\AcmeFitness\ControllersEnderecoController:listarUm');
        $app->get('/endereco/listar', 'Maria\AcmeFitness\ControllersEnderecoController:listarTodos');

        $app->post('/pedido/adicionar', 'Maria\AcmeFitness\ControllersPedidoController:adicionar');
    });
};
