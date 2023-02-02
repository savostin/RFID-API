<?php

namespace Tests\Controllers;

use App\Controllers\UserController;
use Slim\Psr7\Factory\RequestFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Tests\Controllers\AbstractControllerTest;

final class UserControllerTest extends AbstractControllerTest
{
	public function setUp(): void
	{
		parent::setUp();
		$this->controller = new UserController($this->container);
	}

	public function testFindByRfid()
	{
		$request = (new RequestFactory)->createRequest('GET', '/user/rfid/142594708f3a5a3ac2980914a0fc954f');
		$response = (new ResponseFactory)->createResponse();

		$response = $this->controller->findByRfid($request, $response, ['rfid' => '142594708f3a5a3ac2980914a0fc954f']);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertJson((string)$response->getBody());
	}


}
