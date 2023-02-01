<?php
require 'vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use App\Renderers\JsonRenderer;
use Psr\Http\Message\ServerRequestInterface;

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
	$payload = (object)['error' => $exception->getMessage()];
	$response = $app->getResponseFactory()->createResponse();
	$container->get('renderer')->json($response, $payload);
	return $response;
};

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

$app->add(function ($request, $handler) {
	$response = $handler->handle($request);
	return $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
		->withHeader('Access-Control-Allow-Methods', 'GET');
});

(require_once('./src/routes.php'))($app);

$app->run();
