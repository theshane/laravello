# Makefile

shell-php:
	docker exec -it php-apache bash

migrate:
	docker exec -it php-apache php artisan migrate

seed:
	docker exec -it php-apache php artisan db:seed

tinker:
	docker exec -it php-apache php artisan tinker

test:
	docker exec -it php-apache php artisan test

install:
	docker exec -it php-apache composer install
	docker exec -it php-apache npm install
	docker exec -it php-apache php artisan key:generate
	docker exec -it php-apache php artisan migrate --seed

.PHONY: shell-php