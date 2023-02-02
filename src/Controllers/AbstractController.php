<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

class AbstractController
{
	protected ContainerInterface $container;

	// constructor receives container instance
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
}