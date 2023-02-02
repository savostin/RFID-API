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
	{ {
			// not found
			$request = (new RequestFactory)->createRequest('GET', '/user/rfid/notfound');
			$response = (new ResponseFactory)->createResponse();
			$response = $this->controller->findByRfid($request, $response, ['rfid' => 'notfound']);
			$this->assertEquals(404, $response->getStatusCode());
			$body = (string) $response->getBody();
			$this->assertJson($body);
			$json = json_decode($body);
			$this->assertEquals($json->error, 404);
		} {
			// correct value
			$request = (new RequestFactory)->createRequest('GET', '/user/rfid/142594708f3a5a3ac2980914a0fc954f');
			$response = (new ResponseFactory)->createResponse();
			$response = $this->controller->findByRfid($request, $response, ['rfid' => '142594708f3a5a3ac2980914a0fc954f']);
			$this->assertEquals(200, $response->getStatusCode());
			$body = (string) $response->getBody();
			$this->assertJson($body);
			$json = json_decode($body);
			$this->assertEquals($json->id, 1);
			$this->assertEquals($json->full_name, 'Julius Caesar');
			asort($json->departments);
			$this->assertEquals(['development', 'director'], $json->departments);
		}
	}
}
