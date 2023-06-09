#!/bin/bash

# Composer
/usr/local/bin/composer install -n --prefer-dist -d /code

# NodeJS
apk add --no-cache nodejs npm

# NPM
npm install
npm run build

# Symfony migration
php bin/console doctrine:migrations:migrate

php bin/console app:create-user example@mail.com example@mail.com

php-fpm
