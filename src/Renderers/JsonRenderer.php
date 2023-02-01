<?php

namespace App\Renderers;

use Psr\Http\Message\ResponseInterface;

final class JsonRenderer
{
	public function json(ResponseInterface $response, object $data = null, int $options = JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR): ResponseInterface
	{
		$response = $response->withHeader('Content-Type', 'application/json');
		$data->timestamp = time();
		$response->getBody()->write((string)json_encode($data, $options));

		return $response;
	}

	public function error(ResponseInterface $response, int $code): ResponseInterface
	{
		$data = (object)['error' => $code];
		return $this->json($response, $data)->withStatus($code);
	}
}
