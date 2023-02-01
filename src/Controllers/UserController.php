<?php

namespace App\Controllers;

use App\Services\UserService;
use \App\Renderers\JsonRenderer;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class UserController
{
	private ContainerInterface $container;
	private UserService $service;
	private JsonRenderer $renderer;

	// constructor receives container instance
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->service = new UserService($container->get('db'));
		$this->renderer = $this->container->get('renderer');
	}
	public function findByRfid(Request $request, Response $response, array $args): Response
	{
		$user = $this->service->findByRfid($args['rfid']);
		return $user ? $this->renderer->json($response, $user->view()) : $this->renderer->error($response, 404);
	}
}
