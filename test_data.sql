INSERT INTO
	"buildings" ("id", "countryISO", "name")
VALUES
	(1, 'UK', 'Isaac Newton'),
	(2, 'UK', 'Oscar Wilde'),
	(3, 'UK', 'Charles Darwin'),
	(4, 'US', 'Benjamin Franklin'),
	(5, 'IT', 'Luciano Pavarotti');

INSERT INTO
	"departments" ("id", "name")
VALUES
	(1, 'development'),
	(2, 'accounting'),
	(3, 'HR'),
	(4, 'sales'),
	(5, 'headquarters'),
	(6, 'director');

INSERT INTO
	"building_departments" ("building", "department")
VALUES
	(1, 1),
	(1, 2),
	(2, 3),
	(2, 4),
	(3, 5),
	(4, 1),
	(4, 4),
	(5, 1),
	(5, 4);

INSERT INTO
	"employees" ("id", "first_name", "last_name", "rfid")
VALUES
	(
		1,
		'Julius',
		'Caesar',
		'142594708f3a5a3ac2980914a0fc954f'
	);

INSERT INTO
	"employee_departments" ("employee", "department")
VALUES
	(1, 1),
	(1, 6);