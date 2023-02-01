<?php

namespace App\Controllers;

use \App\Renderers\JsonRenderer;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AbstractController
{
	protected ContainerInterface $container;
	protected JsonRenderer $renderer;

	// constructor receives container instance
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->renderer = $this->container->get('renderer');
	}
}