#!/usr/bin/env sh

. ./.env

CONTAINER_APP="app";
CONTAINER_MYSQL="mysql";

do_exec() {
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" "$@"
}

do_mysql_backup() {

    DIRECTORY="docker/server/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    if [ -z "$1" ]
    then
        DATE=$(date +"%Y-%m-%d %H:%M")
        COMMAND="$DIRECTORY/$MYSQL_DATABASE-$DATE.sql.gz"
    else
        COMMAND="$1"
    fi

    docker-compose exec -T --env="MYSQL_PWD=$MYSQL_PASSWORD" "$CONTAINER_MYSQL" mysqldump --single-transaction --no-create-db --verbose --user="$MYSQL_USER" "$MYSQL_DATABASE" | gzip > "$COMMAND"

    find "$DIRECTORY" -type f -mtime +3 -exec rm {} \;

    echo "Done!"
}

do_mysql_restore() {

    DIRECTORY="docker/server/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    if [ -z "$1" ]
    then
        FILE=$(ls "$DIRECTORY" -t | head -1)
        COMMAND="$DIRECTORY/$FILE"
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

do_tests() {
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/vendor/bin/codecept run --config=framework/codeception.yml
}

do_install() {
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" composer install --working-dir=framework
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/yii migrate/up
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/yii access/install
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/yii cache/flush-all
}

do_update() {
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" composer update --working-dir=framework
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/yii migrate/up
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/yii access/install
    docker-compose exec --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_APP" framework/yii cache/flush-all
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
    *)
    echo "Usage: docker.sh [exec|mysql-backup|mysql-restore|mysql-drop-table|mysql-truncate-database|tests|install|update]"
    ;;

esac
