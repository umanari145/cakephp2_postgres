#!/bin/bash
# start.sh

pg_check=`php /var/www/html/pg_check.php`

until $pg_check; do
  >&2 echo "Postgres is unavailable - sleeping"
  sleep 1
done
/var/www/html/vendors/bin/phinx migrate

/usr/sbin/apache2ctl -D FOREGROUND