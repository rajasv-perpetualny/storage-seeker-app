#!/bin/sh
#
# Restarts docker container and removes cache
#

docker-compose down
rm -fr ./src/bootstrap/cache/*
echo cache removed!
docker-compose up