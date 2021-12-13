#!/bin/sh

php artisan key:generate

php artisan migrate:fresh

php artisan db:seed

ln -s /efs/nrna-ui/assets /assets

/usr/sbin/apache2ctl -D FOREGROUND;