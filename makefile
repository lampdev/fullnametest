.PHONY: tests
tests: vendor
	composer run-script tests
vendor: composer.json composer.lock
	composer validate
	composer install
