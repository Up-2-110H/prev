#!/usr/bin/env sh

. ../../.env

gunzip < latest.sql.gz | /usr/bin/mysql --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE"
