#!/bin/bash
until nc -z -v -w30 $MYSQL_HOST 3306
do
  echo "Waiting a second until the database is receiving connections..."
  # wait for a second before checking again
  sleep 1
done
echo "Database is up and running, starting the application..."
php /var/www/html/init.php

exec "$@"
