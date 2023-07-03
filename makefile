## color output
COLOR_NORMAL=$(shell printf '\033[0m')
COLOR_RED=$(shell printf '\033[1;31m')
COLOR_GREEN=$(shell printf '\033[1;32m')
COLOR_YELLOW=$(shell printf '\033[1;33m')

HOME_DIR=$(shell pwd)

DONE="${COLOR_GREEN}Done${COLOR_NORMAL}"

.PHONY: all clean release update update-dev update-main init migrate php nginx restart
.IGNORE: all

all:

init:
	@echo "${COLOR_GREEN}Init ...${COLOR_NORMAL}"
	@(cd logs;rm -rf laravel-logs;ln -sf ../app/logs laravel-logs)
	@chmod 0600 ./config/php-fpm/ssh/id_rsa
	@echo $(DONE)

start-api:
	@(cd $(HOME_DIR)/api-gateway;php bin/hyperf.php server:watch;)

start-file:
	@(cd $(HOME_DIR)/file-srv;php bin/hyperf.php server:watch;)

start-order:
	@(cd $(HOME_DIR)/order-srv;php bin/hyperf.php server:watch;)

start-task:
	@(cd $(HOME_DIR)/task-srv;php bin/hyperf.php server:watch;)

start-user:
	@(cd $(HOME_DIR)/user-srv;php bin/hyperf.php server:watch;)

compose:
	@docker-compose -f docker-compose.yaml up;

migrate:
	@docker-compose exec php bash -c "cd current;make migrate";

nacos:
	@docker-compose exec nacos env LANG=C.UTF-8 bash;

rabbit:
	@docker-compose exec rabbitmq env LANG=C.UTF-8 bash;

rabbit-web:
	@docker-compose exec rabbitmq bash -c "rabbitmq-plugins enable rabbitmq_management";

nginx:
	@docker-compose exec nginx env LANG=C.UTF-8 bash;

update-nginx:
	@docker-compose exec nginx bash -c "nginx -s reload";

restart:
	@docker-compose restart;
