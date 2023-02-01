<?php

namespace App\Services;

class DbService
{
	protected \PDO $pdo;
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

}