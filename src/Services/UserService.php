<?php

namespace App\Services;

use App\Models\User;
use App\Services\DbService;


final class UserService extends DbService
{

	public function findByRfid(string $rfid): User | bool
	{
		$sth = $this->pdo->prepare('select id, full_name, rfid from employees where rfid = ? limit 1');
		if ($sth && $sth->execute([$rfid])) {
			if ($r = $sth->fetch(\PDO::FETCH_OBJ)) {
				$user = new User($r->id);
				$user->setName($r->full_name);
				$user->setRfid($r->rfid);
				$sth2 = $this->pdo->prepare('select name from departments inner join employee_departments on department = departments.id where employee = ?');
				if ($sth2 && $sth2->execute([$r->id])) {
					if ($r2 = $sth2->fetchAll(\PDO::FETCH_COLUMN, 0)) {
						$user->setDepartments(array_values($r2));
					}
				}
				return $user;
			}
		}
		return false;
	}

}
