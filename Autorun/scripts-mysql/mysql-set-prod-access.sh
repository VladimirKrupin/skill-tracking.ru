#!/usr/bin/env bash
/etc/init.d/mysql start
passroot="YOU PASSWORD"
passuser="YOU PASSWORD"
user="YOU PASSWORD"
db="YOU DATABASE"
echo "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');" | mysql -uroot -p${passroot}
echo "create user '${user}'@'172.20.0.3' identified by '${passuser}';" | mysql -uroot -p${passroot}
echo "create user '${user}'@'172.20.0.5' identified by '${passuser}';" | mysql -uroot -p${passroot}
echo "grant all privileges on ${db} . * to '${user}'@'172.20.0.3';" | mysql -uroot -p${passroot}
echo "grant all privileges on ${db} . * to '${user}'@'172.20.0.5';" | mysql -uroot -p${passroot}
echo "FLUSH PRIVILEGES;" | mysql -uroot -p${passroot}
