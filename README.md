# How to create a custom Artisan command

This is an example custom Artisan command for Laravel.

Custom Artisan commands can make testing, development and administration tasks much easier.

In this example, the custom command will create a new user with the given name, email and password.

The code has been tested with Laravel 8. For the example to work, you must install a Laravel 8 app, connect it to a database and run the migrations.

To learn how to use Artisan, check the following link: https://laravel.com/docs/8.x/artisan

# How to use the example

Use Artisan to create a custom Artisan command.
		
> php artisan make:command CreateUser

Then go to the app/Console/Commands folder and replace the contents of CreateUser.php with this code.

Now you can use the following command to create new users from the console. Here is an example:

> php artisan create:user Joe joe@example.com userPassword

To learn more about the Command class, check https://laravel.com/api/8.x/Illuminate/Console/Command.html.