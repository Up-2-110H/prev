#!/usr/bin/env sh

. ./.env

CONTAINER_APPLICATION="application";
CONTAINER_MYSQL="mysql";

do_exec() {
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" "$@"
}

do_mysql_backup() {

    DIRECTORY="docker/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    if [ -z "$1" ]
    then
        DATE=$(date +"%Y-%m-%d-%H:%M")
        FOLDER="$DIRECTORY/$DATE"

        if ! [ -d "$FOLDER" ]
        then
            mkdir --mode=0700 --parents "$FOLDER"
        fi

        COMMAND="$FOLDER/latest.sql.gz"
    else
        COMMAND="$1"
    fi

    docker-compose exec -T --env="MYSQL_PWD=$MYSQL_PASSWORD" "$CONTAINER_MYSQL" mysqldump --single-transaction --no-create-db --verbose --user="$MYSQL_USER" "$MYSQL_DATABASE" | gzip > "$COMMAND"

    find "$DIRECTORY" -type d -mtime +3 -exec rm -r {} +

    echo "Done!"
}

do_mysql_restore() {

    DIRECTORY="docker/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    if [ -z "$1" ]
    then
        FILE=$(find "$DIRECTORY" -type f -name *.sql.gz -exec ls -t "{}" + | head -1)
        COMMAND="$FILE"
    else
        COMMAND="$1"
    fi

    gunzip < "$COMMAND" | docker-compose exec -T --env="MYSQL_PWD=$MYSQL_PASSWORD" "$CONTAINER_MYSQL" mysql --verbose --user="$MYSQL_USER" "$MYSQL_DATABASE"

    echo "Done!"
}

do_mysql_drop_table() {

    if [ -z "$1" ]
    then
        echo "Usage: docker.sh mysql-drop-table TABLE_NAME"
        exit 1;
    else
        TABLE="$1"
    fi

    docker-compose exec -T --env="MYSQL_PWD=$MYSQL_PASSWORD" "$CONTAINER_MYSQL" mysql --user="$MYSQL_USER" "$MYSQL_DATABASE" -e "SET FOREIGN_KEY_CHECKS=0; DROP TABLE $TABLE;"

    echo "DROP TABLE: $TABLE"
}

do_mysql_truncate_database() {

    TABLES=$(docker-compose exec -T --env="MYSQL_PWD=$MYSQL_PASSWORD" "$CONTAINER_MYSQL" mysql --user="$MYSQL_USER" "$MYSQL_DATABASE" -Nse "SHOW TABLES;")

    for TABLE in $TABLES
    do
        do_mysql_drop_table "$TABLE"
    done
}

do_mysql_wait() {
    until [ "`docker-compose exec -T --env="MYSQL_PWD=$MYSQL_ROOT_PASSWORD" "$CONTAINER_MYSQL" mysqladmin --user=root --wait ping | grep -o \"is\salive\"`"=='is alive' ]; do
        sleep 1
    done;

    sleep 10
}

do_tests() {
    DB="codeception"

    do_mysql_wait

    docker-compose exec -T --env="MYSQL_PWD=$MYSQL_ROOT_PASSWORD" "$CONTAINER_MYSQL" mysql --user=root -e "CREATE DATABASE $DB;"

    docker-compose exec -T --env="YII_ENV=test" --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii migrate/up --appconfig=framework/tests/config/console.php
    docker-compose exec -T --env="YII_ENV=test" --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii access/install --appconfig=framework/tests/config/console.php

    docker-compose exec -T --env="YII_ENV=test" --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/vendor/bin/codecept run --config=framework/codeception.yml

    docker-compose exec -T --env="MYSQL_PWD=$MYSQL_ROOT_PASSWORD" "$CONTAINER_MYSQL" mysql --user=root -e "DROP DATABASE $DB;"
}

do_install() {
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" composer install --working-dir=framework

    do_mysql_wait

    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii migrate/up
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii access/install
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii cache/flush-all
}

do_update() {
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" composer update --working-dir=framework
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii migrate/up
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii access/install
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/yii cache/flush-all
}

do_make_cest() {
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/vendor/bin/codecept g:cest functional "$@" --config=framework/codeception.yml
}

do_make_test() {
    docker-compose exec -T --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APPLICATION" framework/vendor/bin/codecept g:test unit "$@" --config=framework/codeception.yml
}

case "$1" in

    exec)
        shift
        do_exec $@
        ;;

    mysql-backup)
        shift
        do_mysql_backup $@
        ;;

    mysql-restore)
        shift
        do_mysql_restore $@
        ;;

    mysql-drop-table)
        shift
        do_mysql_drop_table $@
        ;;

    mysql-truncate-database)
        shift
        do_mysql_truncate_database
        ;;
    tests)
        shift
        do_tests
        ;;
    install)
        shift
        do_install
        ;;
    update)
        shift
        do_update
        ;;
    g:cest)
        shift
        do_make_cest $@
        ;;
    g:test)
        shift
        do_make_test $@
        ;;
    *)
    echo "Usage: docker.sh [exec|mysql-backup|mysql-restore|mysql-drop-table|mysql-truncate-database|tests|install|update|g:cest|g:test]"
    ;;

esac
