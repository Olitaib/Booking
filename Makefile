start:
	cp .env.example .env
	composer install
	./vendor/bin/sail up -d
	npm install
	npm run build

migration:
	./vendor/bin/sail artisan migrate

seed:
	./vendor/bin/sail artisan db:seed

up:
	./vendor/bin/sail up -d

stop:
	./vendor/bin/sail down

restart:
	./vendor/bin/sail down
	./vendor/bin/sail up -d

