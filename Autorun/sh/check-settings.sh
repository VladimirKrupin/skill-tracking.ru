#!/bin/bash
folder_notice="Put name you folder where starting project. Remember! Remove all symbols '.' For example 'dev.folder-one.ru' must be devfoleder-oneru. Put you folder name in ${user_settings}"
while read LINE; do
        if [ "$LINE" = "folder_dev_name=" ]
        then
            printf "${RED}Put your folder dev name in ${user_settings}${NC}\n"
            printf "${BLUE}${folder_notice}${NC}\n"
            exit 1
        fi
        if [ "$LINE" = "folder_prod_name=" ]
        then
            printf "${RED}Put your folder prod name in ${user_settings}${NC}\n"
            printf "${RED}${folder_notice}${NC}\n"
            exit 1
        fi
    done < $user_settings

while read LINE; do
        if [ "$LINE" = "APP_ENV=production" ]
        then
            env=${folder_dev_name};
        fi
        if [ "$LINE" = "APP_ENV=developer" ]
        then
            env=${folder_prod_name};
        fi
        if [ "$LINE" = "APP_MODE=server" ]
        then
            user_permissions='';
        fi
        if [ "$LINE" = "APP_MODE=local" ]
        then
            user_permissions='sudo';
        fi
        if [ "$LINE" = "DB_DATABASE=" ]
        then
            printf "${RED}Put your database in ${file}${NC}\n"
            exit 1
        fi
        if [ "$LINE" = "DB_USERNAME=" ]
        then
            printf "${RED}Put your username in ${file}${NC}\n"
            exit 1
        fi
        if [ "$LINE" = "DB_PASSWORD=" ]
        then
            printf "${RED}Put your password in ${file}${NC}\n"
            exit 1
        fi
    done < $file

while read LINE; do
        if [ "$LINE" = "- MYSQL_ROOT_PASSWORD=YOU PASSWORD" ]
        then
            printf "${RED}Change your password in ${docker_compose_file}${NC}\n"
        fi
        if [ "$LINE" = "- MYSQL_DATABASE=YOU DATABASE" ]
        then
            printf "${RED}Change your database in ${docker_compose_file}${NC}\n"
            exit 1
        fi
    done < ${docker_compose_file}

while read LINE; do
    if [ "$LINE" = "- MYSQL_ROOT_PASSWORD=YOU PASSWORD" ]
    then
        printf "${RED}Change your password in ${docker_compose_dev_file}${NC}\n"
    fi
    if [ "$LINE" = "- MYSQL_DATABASE=YOU DATABASE" ]
    then
        printf "${RED}Change your database in ${docker_compose_dev_file}${NC}\n"
        exit 1
    fi
done < ${docker_compose_dev_file}

while read LINE; do
    if [ "$LINE" = "passroot='YOU PASSWORD'" ]
    then
        printf "${RED}Change your dev password in ${mysql_dev_file} put password at in ${docker_compose_dev_file}${NC}\n"
    fi
    if [ "$LINE" = "passtest='YOU PASSWORD'" ]
    then
        printf "${RED}Change your test user password in ${mysql_dev_file}, this will be use for Unit test and developer table.${NC}\n"
    fi
    if [ "$LINE" = "db='YOU DATABASE'" ]
    then
        printf "${RED}Put you developer database in ${mysql_dev_file}. For example im use name 'skill_test', you must write any name, but not forget it database must be name at ${docker_compose_dev_file} file where line DB_DATABASE${NC}\n"
        exit 1
    fi
done < ${mysql_dev_file}

while read LINE; do
    if [ "$LINE" = "passroot='YOU PASSWORD'" ]
    then
        printf "${RED}Change your dev password in ${mysql_prod_file} put password at in ${docker_compose_file}${NC}\n"
    fi
    if [ "$LINE" = "passuser='YOU PASSWORD'" ]
    then
        printf "${RED}Change your user password in ${mysql_prod_file}, this will be use in production version you project.${NC}\n"
    fi
    if [ "$LINE" = "user='YOU USER'" ]
    then
        printf "${RED}Change your user at in ${docker_compose_file}, this will be use in production version you project.${NC}\n"
    fi
    if [ "$LINE" = "db='YOU DATABASE'" ]
    then
        printf "${RED}Put you production database in ${mysql_prod_file}. For example im use name 'skill', you must write any name, but not forget it database must be name at ${docker_compose_file} file where line DB_DATABASE${NC}\n"
        exit 1
    fi
done < ${mysql_prod_file}