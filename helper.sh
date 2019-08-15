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

file="backend/.env"
env="";
user_permissions="false";
if [ -f "$file" ]
then
    while read LINE; do
        if [ "$LINE" = "APP_ENV=production" ]
        then
            env='skilltrackingru';
        fi
        if [ "$LINE" = "APP_ENV=developer" ]
        then
            env='devskilltrackingru_dev';
        fi
        if [ "$LINE" = "APP_MODE=server" ]
        then
            user_permissions='';
        fi
        if [ "$LINE" = "APP_MODE=local" ]
        then
            user_permissions='sudo';
        fi
    done < $file

    if [ "$env" = "" ]
        then
            echo "${RED} WARNING! not fund correct APP_ENV in backend/.env this must be [ APP_ENV=production or APP_ENV=developer ] ${NC}"
            echo "${RED} ВНИМАНИЕ! не удалось определить APP_ENV, она должна иметь значение [ APP_ENV=production or APP_ENV=developer ] ${NC}"
            exit 1
    fi

    if [ "$user_permissions" = "false" ]
        then
            echo "${RED} WARNING! not fund correct APP_MODE in backend/.env this must be [ APP_MODE=server or APP_MODE=local ] ${NC}"
            echo "${RED} ВНИМАНИЕ! не удалось определить APP_MODE, она должна иметь значение [ APP_MODE=server or APP_MODE=local ] ${NC}"
            exit 1
    fi

#    ---
    migrate="docker exec -it ${env}_docker_php_1 php artisan migrate";
    passport_install="docker exec -it ${env}_docker_php_1 php artisan passport:install";
    storage_chmod="docker exec -it ${env}_docker_php_1 chmod 777 -R storage/";
    passport_rights="docker exec -it ${env}_docker_php_1 sh script-rights.sh";
    cache_clear="docker exec -it ${env}_docker_php_1 php artisan cache:clear";
    rollback="docker exec -it ${env}_docker_php_1 php artisan migrate:rollback";
#    ---

    start_tests="sh run-tests.sh";
    run_code_coverage="sh run-code-coverage.sh";
    start_project="sh start-project.sh";
    hard_restart_project="sh hard-restart-project.sh";

    composer_install="${user_permissions} docker exec -it ${env}_docker_composer_1 composer install";
    migrate_with_passport="${migrate} ${passport_install} ${storage_chmod} ${passport_rights} ${cache_clear}"

    backend_node_modules_install="${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh backend-app-install.sh";
    backend_vue_build="${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh backend-app-build.sh";

    frontend_node_modules_install="${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-install.sh";
    frontend_vue_build="${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-build.sh";

    rollback_with_migrate="${rollback} ${migrate} ${passport_install} ${storage_chmod} ${passport_rights} ${cache_clear}";

    printf "${BLUE}# START${NC} ${N}";
    printf "'start project' start-project.sh${N}";
    printf "    ${start_project} ${N}";
    printf "'hard restart project' hard-restart-project.sh${N}";
    printf "    ${hard_restart_project} ${N}";
    printf "'test' Запуск тестов (только для проекта в режиме разработки)${N}";
    printf "    ${start_tests} ${N}";
    printf "'coverage' Запуск code coverage (только для проекта в режиме разработки)${N}";
    printf "    ${run_code_coverage} ${N}";

    printf "${YELLOW}#1 COMMON${NC} ${N}";
    printf "1.1 Установка пакетов в папке backend/${N}";
    printf "    ${composer_install} ${N}";
    printf "1.2 Миграция ДБ с установкой паспорта${N}";
    printf "    ${migrate_with_passport} ${N}";

    printf "${GREEN}#2 CHAT${NC} ${N}";
    printf "2.1 Установка зависимостей node_modules в папке Backend/${N}";
    printf "   ${backend_node_modules_install}${N}";
    printf "2.2 Сборка vue приложения в папке Backend/${N}";
    printf "   ${backend_vue_build}${N}";

    printf "${GREEN}#3 FRONTEND${NC} ${N}";
    printf "3.1. Установка зависимостей node_modules в папке Frontend/${N}";
    printf "   ${frontend_node_modules_install}${N}";
    printf "3.2 Сборка vue приложения в папке Frontend/${N}";
    printf "   ${frontend_vue_build}${N}";

    printf "${RED}# DANGEROUS COMMANDS${NC} ${N}";
    printf "'rollback' Роллбэк базы данных (только для проекта в режиме разработки)${N}";
    printf "   ${rollback_with_migrate}${N}";

    printf "${CYAN}ENTER COMMAND NUMBER OR COMMAND NAME${NC}\n"
    printf "${CYAN}ВВЕДИТЕ НОМЕР КОМАНДЫ ИЛИ ЕЁ НАЗВАНИЕ, которую необходимо выполнить${NC}\n"
    read -r -p "" response

    case "$response" in
        "start project")
                $start_project
            ;;
        "hard restart project")
                $hard_restart_project
            ;;
        "test")
                printf "${CYAN}ВВЕДИТЕ ПУТЬ ДО ТЕСТА ИЛИ НАЖМИТЕ ENTER, ЧТОБЫ ЗАПУСТИТЬ ВСЕ ТЕСТЫ${NC}\n"
                read -r -p "" path
                $start_tests $path
            ;;
        "coverage")
                $run_code_coverage
            ;;
        "1.1")
                $composer_install
            ;;
        "1.2")
                $migrate
                $passport_install
                $storage_chmod
                $passport_rights
                $cache_clear
            ;;
        "2.1")
                $backend_node_modules_install
            ;;
        "2.2")
                $backend_vue_build
            ;;
        "3.1")
                $frontend_node_modules_install
            ;;
        "3.2")
                $frontend_vue_build
            ;;
        "rollback")
                $rollback
                $migrate
                $passport_install
                $storage_chmod
                $passport_rights
                $cache_clear
            ;;
        *)
            exit 1
            ;;
    esac

else
	echo "${RED} WARNING! $file not found! Put file with tests environments ${NC}"
	echo "${RED} ВНИМАНИЕ! $file не найден! Положите файл .env в папку backend/ ${NC}"
	exit 1
fi