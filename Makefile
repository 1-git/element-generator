# --- Run example
init: setup test info generate

# --- Container initiation
setup:
	docker-compose build
	docker-compose run app composer install

# --- Run phpUnit tests
test:
	docker-compose run app php ./vendor/bin/phpunit

# --- Get command description
info:
	docker-compose run app php ./application.php -h

# --- File generation
generate:
	docker-compose run app php ./application.php input.csv
