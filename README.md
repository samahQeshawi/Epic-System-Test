 You’ll start by clone the project then install it .. learn how to install.

1. git clone -b master https://github.com/samahQeshawi/Epic-System-Test.git
2. go to the project folder.
3. update .env file with database connection info
4. run this command to create database tables php artisan migrate
5. run this command to create new admin with all permissions php artisan db:seed
6. Generate Application Key:php artisan key:generate
7. Serve the Application: php artisan serve
8. Go back to the localhost:8000/admin page. email : admin@epic.com password : 1-6
