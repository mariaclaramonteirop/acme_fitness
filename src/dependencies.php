
<?php
use DI\ContainerBuilder;
use Maria\AcmeFitness\Dao\VariacaoDao;
use Maria\AcmeFitness\Dao\ProdutoDao;
use Maria\AcmeFitness\Dao\CategoriaDao;
use Maria\AcmeFitness\Dao\EnderecoDao;
use Maria\AcmeFitness\Dao\ClienteDao;
use Maria\AcmeFitness\Dao\PedidoDao;
use Maria\AcmeFitness\Controllers\VariacaoController;
use Maria\AcmeFitness\Controllers\ProdutoController;
use Maria\AcmeFitness\Controllers\CategoriaController;
use Maria\AcmeFitness\Controllers\ClienteController;
use Maria\AcmeFitness\Controllers\EnderecoController;
use Maria\AcmeFitness\Controllers\PedidoController;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    CategoriaController::class => function ($container) {
        $categoriaDao = $container->get(CategoriaDao::class);
        return new CategoriaController($categoriaDao);
    },
    ProdutoController::class => function ($container) {
        $produtoDao = $container->get(ProdutoDao::class);
        $categoriaDao = $container->get(CategoriaDao::class);
        return new ProdutoController($produtoDao, $categoriaDao);
    },
    VariacaoController::class => function ($container) {
        $variacaoDao = $container->get(VariacaoDao::class);
        $produtoDao = $container->get(ProdutoDao::class);
        return new VariacaoController($variacaoDao, $produtoDao);
    },
    ClienteController::class => function ($container) {
        $clienteDao = $container->get(ClienteDao::class);
        return new ClienteController($clienteDao);
    },
    EnderecoController::class => function ($container) {
        $enderecoDao = $container->get(EnderecoDao::class);
        $clienteDao = $container->get(ClienteDao::class);
        return new EnderecoController($enderecoDao, $clienteDao);
    },
    PedidoController::class => function ($container) {
        $pedidoDao = $container->get(PedidoDao::class);
        $clienteDao = $container->get(ClienteDao::class);
        $enderecoDao = $container->get(EnderecoDao::class);
        $variacaoDao = $container->get(VariacaoDao::class);
        return new PedidoController($pedidoDao, $clienteDao, $enderecoDao, $variacaoDao);
    }
]);

return $containerBuilder->build();
