# OSRS Player Stats API (hack) #

#### About ####

#### Usage ####

#### Installation ####
1. Clone repository 
2. In the terminal, run `Composer Install` to install dependencies
3. Set up DB, configure DB mysql settings in .env (Host, Username, Password)
4. In the terminal, run `php artisan migrate` to run DB migrations
5. In the terminal, run `php artisan passport:install` to install Laravel Passport and generate a client 

#### Testing (phpunit) ####
1. Run `vendor/bin/phpunit` in the Terminal
Alternatively to create an alias in the Terminal (API Directory):
2. Run `alias test="vendor/bin/phpunit"` to create an alias
3. Run `test` to run feature and unit tests