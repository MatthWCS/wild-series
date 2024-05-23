SYMFONY COMMANDS :

#######################################################################################

Command to create a database:

symfony console doctrine:database:create

#######################################################################################

Command to create a table:

symfony console make:entity

 => follow the instructions

#######################################################################################

Command to initialize the update of a database:

symfony console make:migration

#######################################################################################

Command to update a database:

symfony console doctrine:migrations:migrate

#######################################################################################

Command to detect entities

symfony console doctrine:mapping:info

#######################################################################################

Command to validate entities

symfony console doctrine:schema:validate

#######################################################################################

Command to control migrations

symfony console doctrine:migrations:status

#######################################################################################
