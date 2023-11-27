install:
	php ./install.php -o composer-setup.php
	php ./composer-setup.php && rm composer-setup.php
	php ./composer.phar install
test:
	php ./composer.phar test
