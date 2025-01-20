
<?php
use DI\ContainerBuilder;
use App\dao\VariacaoDao;
use App\dao\ProdutoDao;
use App\dao\CategoriaDao;
use App\dao\EnderecoDao;
use App\dao\ClienteDao;
use App\dao\PedidoDao;
use App\controllers\VariacaoController;
use App\controllers\ProdutoController;
use App\controllers\CategoriaController;
use App\controllers\EnderecoController;
use App\controllers\ClienteController;
use App\controllers\PedidoController;

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
