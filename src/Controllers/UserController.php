<?php

namespace App\Controllers;

use App\Services\UserService;
use App\Controllers\AbstractController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class UserController extends AbstractController
{
	private UserService $service;

	// constructor receives container instance
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);
		$this->service = new UserService($container->get('db'));
	}
	public function findByRfid(Request $request, Response $response, array $args): Response
	{
		$user = $this->service->findByRfid($args['rfid']);
		$renderer = $this->container->get('renderer');
		return $user ? $renderer->render($response, $user->view()) : $renderer->error($response, 404);
	}
}
