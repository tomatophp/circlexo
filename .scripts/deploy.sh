#!/bin/bash
set -e

echo "Deployment started ..."

# Pull the latest version of the app
git reset --hard
git pull origin master

# Install composer dependencies
composer install

# Clear the old cache
php8.2 artisan clear-compiled

# Recreate cache
php8.2  artisan optimize

# Compile npm assets
yarn
yarn build

# Run database migrations
php8.2  artisan migrate --force


echo "Deployment finished!"
