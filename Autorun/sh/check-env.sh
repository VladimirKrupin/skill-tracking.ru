#!/bin/bash
printf "${RED}start project in production or developer mode? [prod/dev]${NC}\n"
    printf "${RED}Проект запускается в режиме разработчика или в режиме продакшен? [prod/dev]${NC}\n"
    read -r -p "" response
    case "$response" in
        "prod")
                docker_file='docker-compose-prod.yml';
                env=${folder_prod_name};
            ;;
        "dev")
                docker_file='docker-compose-dev.yml';
                env=${folder_dev_name};
            ;;
        *)
            exit 1
            ;;
    esac