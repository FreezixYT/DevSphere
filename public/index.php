<?php
require_once __DIR__."/../vendor/autoload.php";

error_reporting(E_ERROR | E_PARSE | E_RECOVERABLE_ERROR);

use DI\Container;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\PhpRenderer;

// Create Container using PHP-DI
$container = new Container();

// Add custom response factory
$container->set(ResponseFactoryInterface::class, function (ContainerInterface $container) {
    return new ResponseFactory();
});
$container->set(PhpRenderer::class, function (ContainerInterface $container) {
    $renderer = new PhpRenderer(__DIR__."/../src/Views");
    $renderer->setLayout("layout.php");
    return $renderer;
});

// Configure the application via container
$app = AppFactory::createFromContainer($container);
//$app->addErrorMiddleware(true, false, false);

(require_once __DIR__."/../src/Config/routes.php")($app);

$app->run();