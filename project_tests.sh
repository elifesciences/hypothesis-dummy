#!/usr/bin/env bash
set -e

proofreader src/ test/ web/
composer install
vendor/bin/phpunit --log-junit build/phpunit.xml

