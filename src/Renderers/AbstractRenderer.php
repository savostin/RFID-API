<?php

namespace App\Renderers;

use Psr\Http\Message\ResponseInterface;

class AbstractRenderer
{
	public function render(ResponseInterface $response, object $data = null, int $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR): ResponseInterface
	{
		return $response;
	}

	public function error(ResponseInterface $response, int $code, string $message = ''): ResponseInterface
	{
		return $this->render($response)->withStatus($code);
	}
}
