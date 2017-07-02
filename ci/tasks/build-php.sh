#!/bin/sh

#Install dependencies
#composer install --prefer-dist --no-dev --no-interaction --no-progress --no-scripts
#composer dumpautoload -o

cd ..
cp -r ${PROJECT_SRC}/* built-project-php