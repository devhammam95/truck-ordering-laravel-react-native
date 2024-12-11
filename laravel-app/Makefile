setup:
	cp .env.example .env
	docker-compose up -d --build
	docker-compose exec app composer install
	docker-compose exec app php artisan key:generate
	@make seed
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:cache
	

start:
	docker-compose up -d

stop:
	docker-compose stop

bash:
	docker-compose exec app bash

seed:
	docker-compose exec app php artisan migrate:fresh
	@echo "Start Database seeding..";
	docker-compose exec app php artisan db:seed

run-tests:
	docker-compose exec app ./vendor/bin/phpunit