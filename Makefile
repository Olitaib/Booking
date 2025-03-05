start:
	cp .env.example .env
	docker compose run --rm booking composer install
	docker compose up -d
	docker compose run --rm booking npm install
	docker compose run --rm booking npm run build
	docker compose run booking php artisan migrate
	docker compose run booking php artisan db:seed
	docker compose run --rm booking php artisan key:generate
	docker compose run --rm booking php artisan optimize

up:
	docker compose up -d

stop:
	docker compose down

restart:
	docker compose down
	docker compose up -d

