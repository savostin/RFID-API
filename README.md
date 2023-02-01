# RFID API

The Human Resource department of a large corporation has asked for the installation of a door entry system on each of the company's buildings. The door entry system aims to protect unauthorized access to a department building and greet the employee whenever he/she gains access. The company has 5 buildings in three different countries as described below. Each employee will receive only one RFID card. He/she must tap the RFID card on the reader next to the door in order to gain access to the building.
You are asked to:
* design and implement the database (using MySQL or similar) managing buildings, departments and
employees
* write an API using PHP that given the RFID card number will return a JSON record

## The database
* The RFID card number is unique and 32 chars long string
* An employee can work in one or more departments
* UK buildings:
    * The Isaac Newton building: development and accounting departments ○ The Oscar Wilde building: HR and sales departments
    * The Charles Darwin building: the company headquarters
* USAbuildings:
    * The Benjamin Franklin building: development and sales departments
* ITALYbuildings:
    * The Luciano Pavarotti building: development and sales departments

For an employee weneed to store at least the Full name

## The API
The specification you have been handed for a microservice associated with this security system is as follows:
```
curl -s ‘https://api.domain.com/some/endpoint?cn=not_found | jq {
"full_name": "",
"department": []
}
curl -s ‘https://api.domain.com/some/endpoint?cn=142594708f3a5a3ac2980914a0fc954f | jq {
"full_name": "Julius Caesar",
"department": ["director", "development"]
}
```
## Test data
| RFID card number | Employee | Departments |
| ---- | ---- | ---- |
| 142594708f3a5a3ac2980914a0fc954f | Julius Caesar | director, development |

## Solution
Required to develop and test this endpoint. When returning your solution please include:
* Database schema
* Source code
* Details of any apache or other config required
* List of test cases and data
