#!/usr/bin/env bash
/etc/init.d/mysql start
printf "$mysql is starting? [y|n]\n"
read -r -p "" response
case "$response" in
        "y")
            ;;
        *)
            exit 1
            ;;
    esac
passroot='root'
passuser='user'
user='user'
db='skill'
echo "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');" | mysql -uroot -p${passroot}
echo "create user '${user}'@'172.30.0.3' identified by '${passuser}';" | mysql -uroot -p${passroot}
echo "create user '${user}'@'172.30.0.5' identified by '${passuser}';" | mysql -uroot -p${passroot}
echo "grant all privileges on ${db} . * to '${user}'@'172.30.0.3';" | mysql -uroot -p${passroot}
echo "grant all privileges on ${db} . * to '${user}'@'172.30.0.5';" | mysql -uroot -p${passroot}
echo "FLUSH PRIVILEGES;" | mysql -uroot -p${passroot}
