### What is this repository for? ###

* This is the Beer Warehouse which purpose is to keep track of all your beer.

### How do I set up it locally? ###

* composer install
* change your local DB settings in .env file
* php bin/console doctrine:database:create
* php bin/console doctrine:migrations:migrate
* php bin/console event-store:event-stream:create
* php bin/console app:projections-reset

* yarn install
* yarn encore dev
* php bin/console server:run

### working on frontend and want to keep track of changes in the code?
You can start this process to make yarn watch for changes
* yarn run encore dev --watch

### I want my data to be live updated when I add, edit and remove beer, locations or styles
You can start these processes on the background to keep track of changes
* bin/console event-store:projection:run beer_projection
* bin/console event-store:projection:run style_projection
* bin/console event-store:projection:run location_projection


### What do I have to know about the structure? ###

* App is for all you code that is rendering stuff for the user
* Domain is all business logic, no use of outside stuff. keep it clean
* Infra is the link to outside stuff, like database, api's and cache.

### How do I run tests locally? ###

* php bin/console doctrine:database:create --env=test
* php bin/console doctrine:migrations:migrate --env=test
* ./bin/phpunit

### How can I check my code quality? ###

* ./bin/phpcs --standard=PSR2 --extensions=php src/
* ./bin/phpcpd --exclude Tests src/
* ./bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode --exclude *Test.php
