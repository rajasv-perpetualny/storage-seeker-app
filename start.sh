#!/bin/sh
#
# Starts up the docker container and installs dependencies post volume mounting

# Forcing write permissions to writeable folders
chmod a+w src/bootstrap/cache
chmod a+w src/storage/framework/**

# Building and starting the storageseeker container
docker-compose build
docker-compose up -d

# Installing dependencies withing the container
docker exec -it storageseeker composer install
docker exec -it storageseeker npm install
docker exec -it storageseeker ln -sfn /opt/storageseeker/src/storage/app/public /opt/storageseeker/src/public/storage
docker exec -it storageseeker npm run watch

# Log output
docker-compose logs -f
