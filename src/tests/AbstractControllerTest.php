<?php
namespace Tests\Controllers;

use DI\Container;
use App\Renderers\JsonRenderer;
use PHPUnit\Framework\TestCase;

class AbstractControllerTest extends TestCase
{
	protected $controller;
	protected $container;
	protected function setUp(): void
	{
		$this->container = new Container();
		$this->container->set('db', function () {
			$pdo = new \PDO("sqlite:database.db");
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
			return $pdo;
		});
		$this->container->set('renderer', new JsonRenderer());
	}

	public function testNothing(): void // to suppress warnings
	{
		$this->assertTrue(true);
	}

}
