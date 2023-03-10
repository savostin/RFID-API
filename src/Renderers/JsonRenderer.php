<?php

namespace App\Renderers;

use Psr\Http\Message\ResponseInterface;
use App\Renderers\AbstractRenderer;

class JsonRenderer extends AbstractRenderer
{
	public function render(ResponseInterface $response, object $data = null, int $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR): ResponseInterface
	{
		$response = $response->withHeader('Content-Type', 'application/json');
		$data->timestamp = time();
		$response->getBody()->write((string)json_encode($data, $options));

		return $response;
	}

	public function error(ResponseInterface $response, int $code, string $message = ''): ResponseInterface
	{
		$data = (object)['error' => $code, 'message' => $message];
		return $this->render($response, $data)->withStatus($code);
	}
}
