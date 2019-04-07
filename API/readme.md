# OSRS Player Stats API (hack) #


#### About ####

#### Usage ####

#### Installation ####

1. Clone repository 

In the Terminal (API Directory) run:

2. `Composer Install` to install dependencies
3. `php artisan migrate` to run DB migrations
4. `php artisan passport:install` to install Laravel Passport and generate a client 

#### Testing (phpunit) ####

- Run `vendor/bin/phpunit` in the Terminal

Alternatively to create an alias in the Terminal (API Directory):

1. Run `alias test="vendor/bin/phpunit"` to create an alias
2. Run `test` to run feature and unit tests