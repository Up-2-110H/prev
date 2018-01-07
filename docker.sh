#!/usr/bin/env sh

. ./.env

do_exec() {
    docker exec -i --user="$APACHE_RUN_USER:$APACHE_RUN_GROUP" "$CONTAINER_NAME" "$@"
}

do_cron() {
    docker exec -i "$CONTAINER_NAME" crontab -u "$APACHE_RUN_USER" "$@"
}

do_mysqldump() {
    while getopts c: option
    do
        case "${option}"
        in
            c) CONTAINER=${OPTARG};;
        esac
    done

    umask 177

    if [ -z "$CONTAINER" ]
    then
        echo "CONTAINER обязателен для заполнения!"
        exit 1
    fi

    DIRECTORY="docker/server/backup"
    if ! [ -d "$DIRECTORY" ]
    then
        mkdir --mode=0700 --parents "$DIRECTORY"
    fi

    DATE=$(date +"%Y-%m-%d %H:%M")

    docker exec "$CONTAINER" /usr/bin/mysqldump --single-transaction --no-create-db --verbose --user="$MYSQL_USER" --password="$MYSQL_PASSWORD" "$MYSQL_DATABASE" | gzip > "$DIRECTORY/$MYSQL_DATABASE-$DATE.sql.gz"

    find "$DIRECTORY" -type f -mtime +3 -exec rm {} \;

    echo "Created database backup!"
}

case "$1" in

    exec)
        shift;
        do_exec $@
        ;;

    cron)
        shift;
        do_cron $@
        ;;

    mysqldump)
        shift;
        do_mysqldump $@
        ;;

esac
