#!/usr/bin/env sh

. ../../.env

/usr/bin/mysql -Nse 'show tables' --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE" | while read table;
do /usr/bin/mysql -e "SET FOREIGN_KEY_CHECKS=0; DROP TABLE $table" --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE"; done
