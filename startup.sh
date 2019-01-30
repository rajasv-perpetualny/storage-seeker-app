#!/usr/bin/env bash
if [[ $DISABLE_OPCODE_CACHE = "true" || $DISABLE_OPCODE_CACHE = 1 ]]
then
	echo $'\nopcache.enable=0' >> /usr/local/etc/php/conf.d/php.ini
fi

php /opt/storageseeker/src/artisan optimize

php /opt/storageseeker/src/artisan storage:link
php /opt/storageseeker/src/artisan config:cache


# Apache gets grumpy about PID files pre-existing
rm -f /var/run/apache2/apache2.pid
rm -fr /opt/storageseeker/src/bootstrap/cache/*

apache2-foreground