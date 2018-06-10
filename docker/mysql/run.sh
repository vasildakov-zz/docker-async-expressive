#!/bin/bash
set -e
LOG="/var/log/mysqld.log"
MYCNF="/etc/my.cnf"

# if command starts with an option, prepend mysqld_safe
if [ "${1:0:1}" = '-' ]; then
    set -- mysqld_safe "$@"
fi

set -- "$@" --defaults-file="$MYCNF"

# read DATADIR from the MySQL config
DATADIR="$(grep datadir $MYCNF | head -n 1 | awk -F= '{print $2}')"
set -- "$@" --user=mysql
set -- "$@" --datadir="$DATADIR"


if [ "$1" = 'mysqld_safe' ]; then

    if [ ! -d "$DATADIR/mysql" ]; then

        echo "===> An empty or uninitialized MySQL volume has been detected in the Data Directory '$DATADIR'"

        if [ -z "$MYSQL_ROOT_PASS" -a -z "$MYSQL_ALLOW_EMPTY_PASSWORD" ]; then
            echo >&2 'error: database is uninitialized and MYSQL_ROOT_PASS not set'
            echo >&2 '  Did you forget to add -e MYSQL_ROOT_PASS=... ?'
            exit 1
        fi

        echo '===> Running mysql_install_db ...'
        mysql_install_db --defaults-file="$MYCNF" --user=mysql --datadir="$DATADIR" > /dev/null 2>&1
        echo '===> Finished mysql_install_db'

        # Create a tempSqlFile to initialise mysql with

        tempSqlFile='/tmp/mysql-first-time.sql'
        echo "SET @@SESSION.SQL_LOG_BIN=0;" >> "$tempSqlFile"

        echo "DELETE FROM mysql.user ;" >> "$tempSqlFile"
        echo "CREATE USER '${MYSQL_ROOT_USER}'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASS}' ;" >> "$tempSqlFile"
        echo "GRANT ALL ON *.* TO '${MYSQL_ROOT_USER}'@'%' WITH GRANT OPTION ;" >> "$tempSqlFile"
        echo "DROP DATABASE IF EXISTS test ;" >> "$tempSqlFile"

        echo "===> Created Admin User: -u $MYSQL_ROOT_USER -p $MYSQL_ROOT_PASS"

        if [ "$MYSQL_DATABASE" ]; then
            echo "CREATE DATABASE IF NOT EXISTS \`$MYSQL_DATABASE\` ;" >> "$tempSqlFile"
            echo "===> Created Database $MYSQL_DATABASE"
        fi

        if [ "$MYSQL_USER" -a "$MYSQL_PASSWORD" ]; then
            echo "CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD' ;" >> "$tempSqlFile"

            if [ "$MYSQL_DATABASE" ]; then
                echo "GRANT ALL ON \`$MYSQL_DATABASE\`.* TO '$MYSQL_USER'@'%' ;" >> "$tempSqlFile"
                echo "===> Created User '$MYSQL_USER' with access to '$MYSQL_DATABASE' db only"
            else
                echo "GRANT ALL ON *.* TO '$MYSQL_USER'@'%' ;" >> "$tempSqlFile"
                echo "===> Created User '$MYSQL_USER' with access to all databases"
            fi
        fi

        # Insert replication specific config if required
        if [ ! -z "$SERVER_ID" ]; then
            # inserts myha contents inside tags in my.cnf
            sed -i '/## BEGIN HA ##/ r /etc/myha.cnf' $MYCNF
            # replace the server-id variables
            sed -i 's/server-id=N/server-id='$SERVER_ID'/' $MYCNF
            echo "===> Appended HA config and server id to '$MYCNF'"

            # Create fabric user if the server is an HA server
            # This will need to be improved to set specific to a database and with a password
            echo "GRANT ALL ON *.* TO fabric@'%' ;" >> "$tempSqlFile"
            echo "===> Created User 'fabric' (no pw) with access to all databases"
        fi

        echo 'FLUSH PRIVILEGES ;' >> "$tempSqlFile"

        set -- "$@" --init-file="$tempSqlFile"
    fi

    chown -R mysql:mysql "$DATADIR"
fi

exec "$@"