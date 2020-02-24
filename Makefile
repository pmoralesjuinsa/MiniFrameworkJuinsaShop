default:
	@printf "$$HELP"

# Docker commands
docker-build:
	docker-compose -f Docker/docker-compose.yml build
	@docker exec -it juinsa_shop_web bash -c "composer install --prefer-source --no-interaction"

docker-down:
	docker-compose down

docker-start:
	docker-compose up -d

docker-tests:
	@docker exec -it juinsa_shop_web bash -c "./vendor/bin/phpunit"

docker-coverage:
	@docker exec -it juinsa_shop_web bash -c "./vendor/bin/phpunit --coverage-text"

docker-ssh:
	@docker exec -it juinsa_shop_web bash

define HELP
# Docker
	- default:
	- docker-build:
	- docker-stop
	- docker-down:
	- docker-start:
	- docker-tests:
	- docker-coverage:
	- docker-ssh:
endef

export HELP