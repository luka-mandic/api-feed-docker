#!/bin/bash

set -e

/var/www/html/artisan migrate
/var/www/html/artisan db:seed

exec apache2-foreground