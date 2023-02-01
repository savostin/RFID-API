<?php
require 'vendor/autoload.php';

use Slim\Factory\AppFactory;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface;
use App\Renderers\JsonRenderer;

$container = new Container();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$container->set('db', function () {
	$pdo = new PDO("sqlite:" . __DIR__ . "/database.db");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $pdo;
});
$container->set('renderer', new JsonRenderer());

$customErrorHandler = function (ServerRequestInterface $request, 	Throwable $exception, 	bool $displayErrorDetails, 	bool $logErrors, 	bool $logErrorDetails) use ($app, $container) {
	$response = $app->getResponseFactory()->createResponse();
	$container->get('renderer')->error($response, 404, $exception->getMessage());
	return $response;
};

$errorMiddleware = $app->addErrorMiddleware(false, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

$app->add(function ($request, $handler) {
	$response = $handler->handle($request);
	return $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
		->withHeader('Access-Control-Allow-Methods', 'GET');
});

(require_once('routes.php'))($app);

$app->run();
