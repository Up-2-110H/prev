#!/usr/bin/env sh

. ../../.env

/usr/bin/mysqldump --single-transaction --verbose --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE" | gzip > latest.sql.gz
