<?php

namespace App\Models;


class User
{
	protected int $id = 0;
	protected string $name = '';
	protected string $rfid = '';
	protected array $departments = [];

	public function __construct(int $id)
	{
		$this->id = $id;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function view(): object
	{
		return (object)[
			'id' => $this->id,
			'full_name' => $this->name,
			'departments' => $this->departments,
			'rfid' => $this->rfid
		];
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getDepartments(): array
	{
		return $this->departments;
	}

	public function setDepartments(array $value): void
	{
		$this->departments = $value;
	}

	public function getRFID(): string
	{
		return $this->rfid;
	}

	public function setRfid(string $rfid): void
	{
		$this->rfid = $rfid;
	}

}
