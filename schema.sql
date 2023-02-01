-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS "employees";
CREATE TABLE "employees" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "first_name" TEXT NOT NULL,
  "last_name" TEXT NOT NULL DEFAULT NULL,
	"full_name" TEXT GENERATED ALWAYS AS ("first_name" || " " || "last_name"),
  "rfid" text(32)
);


-- ----------------------------
-- Indexes structure for table employees
-- ----------------------------
CREATE UNIQUE INDEX "main"."i_rfid"
ON "employees" (
  "rfid" ASC
);


-- ----------------------------
-- Table structure for buildings
-- ----------------------------
DROP TABLE IF EXISTS "buildings";
CREATE TABLE "buildings" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "countryISO" TEXT(2) NOT NULL,
  "name" TEXT NOT NULL
);

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS "departments";
CREATE TABLE "departments" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" TEXT NOT NULL
);

-- ----------------------------
-- Table structure for building_departments
-- ----------------------------
DROP TABLE IF EXISTS "building_departments";
CREATE TABLE "building_departments" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "building" integer NOT NULL,
  "department" integer NOT NULL,
   FOREIGN KEY("building") REFERENCES "buildings" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY("department") REFERENCES "departments" ("id") ON DELETE CASCADE ON UPDATE CASCADE
);


-- ----------------------------
-- Table structure for employee_departments
-- ----------------------------
DROP TABLE IF EXISTS "employee_departments";
CREATE TABLE "employee_departments" (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "employee" integer NOT NULL,
  "department" integer NOT NULL,
  FOREIGN KEY ("employee") REFERENCES "employees" ("id") ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY ("department") REFERENCES "departments" ("id") ON DELETE CASCADE ON UPDATE CASCADE
);


-- ----------------------------
-- Indexes structure for table building_departments
-- ----------------------------
CREATE UNIQUE INDEX "main"."building_department"
ON "building_departments" (
  "building" ASC,
  "department" ASC
);

-- ----------------------------
-- Indexes structure for table employee_departments
-- ----------------------------
CREATE UNIQUE INDEX "main"."ui_employee_department"
ON "employee_departments" (
  "employee" ASC,
  "department" ASC
);
