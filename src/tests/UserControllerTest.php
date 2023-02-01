<?php

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\RequestFactory;
use Slim\Psr7\Factory\ResponseFactory;

class UserControllerTest extends TestCase
{
	private $controller;
	public function setUp(): void
	{
		$this->controller = new UserController();
	}

	public function testGetAllUsers()
	{
		$request = (new RequestFactory)->createRequest('GET', '/users');
		$response = (new ResponseFactory)->createResponse();

		$response = $this->controller->getAllUsers($request, $response);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertJson($response->getBody()->getContents());
	}

	public function testGetUser()
	{
		$request = (new RequestFactory)->createRequest('GET', '/users/1');
		$response = (new ResponseFactory)->createResponse();

		$response = $this->controller->getUser($request, $response, ['id' => 1]);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertJson($response->getBody()->getContents());
	}

	public function testAddUser()
	{
		$request = (new RequestFactory)->createRequest('POST', '/users');
		$request = $request->withParsedBody(['name' => 'John Doe', 'email' => 'johndoe@example.com']);
		$response = (new ResponseFactory)->createResponse();

		$response = $this->controller->addUser($request, $response);

		$this->assertEquals(201, $response->getStatusCode());
		$this->assertJson($response->getBody()->getContents());
	}

	public function testUpdateUser()
	{
		$request = (new RequestFactory)->createRequest('PUT', '/users/1');
		$request = $request->withParsedBody(['name' => 'Jane Doe', 'email' => 'janedoe@example.com']);
		$response = (new ResponseFactory)->createResponse();

		$response = $this->controller->updateUser($request, $response, ['id' => 1]);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertJson($response->getBody()->getContents());
	}

	public function testDeleteUser()
	{
		$request = (new RequestFactory)->createRequest('DELETE', '/users/1');
		$response = (new ResponseFactory)->createResponse();

		$response = $this->controller->deleteUser($request, $response, ['id' => 1]);

		$this->assertEquals(204, $response->getStatusCode());
	}
}
