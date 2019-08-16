#!/usr/bin/env bash
/etc/init.d/mysql start
printf "mysql is starting? [y|n]${NC}\n"
read -r -p "" response
case "$response" in
        "y")
            ;;
        *)
            exit 1
            ;;
    esac
passroot='test'
passtest='test'
db='skill_test'
echo "create database test;" | mysql -uroot -p${passroot}
echo "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');" | mysql -uroot -p${passroot}
echo "create user 'test'@'172.30.0.3' identified by '${passtest}';" | mysql -uroot -p${passroot}
echo "create user 'test'@'172.30.0.5' identified by '${passtest}';" | mysql -uroot -p${passroot}
echo "create user 'root'@'172.30.0.5' identified by '${passroot}';" | mysql -uroot -p${passroot}
echo "grant all privileges on * . * to 'root'@'172.30.0.5';" | mysql -uroot -p${passroot}
echo "grant all privileges on ${db} . * to 'test'@'172.30.0.3';" | mysql -uroot -p${passroot}
echo "grant all privileges on ${db} . * to 'test'@'172.30.0.5';" | mysql -uroot -p${passroot}
echo "grant all privileges on test . * to 'test'@'172.30.0.3';" | mysql -uroot -p${passroot}
echo "grant all privileges on test . * to 'test'@'172.30.0.5';" | mysql -uroot -p${passroot}
echo "FLUSH PRIVILEGES;" | mysql -uroot -p${passroot}
