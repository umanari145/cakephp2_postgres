#!/bin/bash

sed -i -e "s/__DB_HOST__/$DB_HOST/" /var/www/html/phinx.yml
sed -i -e "s/__DB_USER__/$DB_USER/" /var/www/html/phinx.yml
sed -i -e "s/__DB_NAME__/$DB_NAME/" /var/www/html/phinx.yml
sed -i -e "s/__DB_PASSWORD__/$DB_PASSWORD/" /var/www/html/phinx.yml

/var/www/html/vendors/bin/phinx migrate

/usr/sbin/apache2ctl -D FOREGROUND