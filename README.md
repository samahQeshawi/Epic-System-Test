You’ll start by clone the project then install it .. learn how to install.

install
git clone -b master https://github.com/samahQeshawi/Epic-System-Test.git
go to the project folder.
update .env file with database connection info
run this command to create database tables php artisan migrate
run this command to create new admin with all permissions php artisan db:seed
Generate Application Key:php artisan key:generate
Serve the Application: php artisan serve
Go back to the localhost:8000/admin page. email : admin@epic.com password : 1-6
