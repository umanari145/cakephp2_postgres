#!/bin/bash

/var/www/html/vendors/bin/phinx migrate

/usr/sbin/apache2ctl -D FOREGROUND