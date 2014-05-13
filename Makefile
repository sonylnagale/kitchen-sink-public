install:
	curl -sS https://getcomposer.org/installer | php
	php composer.phar require firebase/php-jwt dev-master
	php composer.phar install