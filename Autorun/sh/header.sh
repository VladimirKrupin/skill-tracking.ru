#!/bin/bash
#Color console constant
PURPLE='\033[0;35m'
BLUE='\033[1;34m'
YELLOW='\033[0;33m'
GREEN='\033[0;32m'
CYAN='\033[0;36m'
NC='\033[0m' # No PURPLE
N='\n\n';
LINE="${GREEN}-------------------------------------${NC}";
RED='\033[0;31m';
printf "${LINE}\n\n"
printf "${GREEN}       START SKILL TRACKING PROJECT${NC}\n\n\n\n"
printf "${GREEN}       Made by Vladimir Krupin \033[1mhttps://vk.com/vladimir_krupin_ru\033[m\n\n\n\n${NC}"
printf "${LINE}\n\n"

file="Backend/.env"
env="";
user_permissions="false";
docker_compose_file="docker-compose-prod.yml"
docker_compose_dev_file="docker-compose-dev.yml"
mysql_dev_file="Autorun/scripts-mysql/mysql-set-dev-access.sh"
mysql_prod_file="Autorun/scripts-mysql/mysql-set-prod-access.sh"
user_settings="Autorun/sh/user-settings.sh"