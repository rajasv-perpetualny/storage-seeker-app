#!/bin/sh
#
# entrypoint for unit/integration tests inside the docker container
# this script should be ADDed as /test.sh in your Dockerfile.  Resulting
# junit.xml and mocha.json files should be saved in the root / directory.
#

cd /opt/storageseeker/src

# Enable Xdebug extension for code coverage
# docker-php-ext-enable xdebug

# Run tests
#vendor/bin/paratest
vendor/bin/phpunit --configuration phpunit.xml
