Requirements


Redis

Php 5.5.x

Mysql



Databases:

unotelly_portal

unotelly_billing

unotelly_radius


Environment


Read this http://laravel.com/docs/configuration#environment-configuration

We have custom ENV setup.

Setup your own dev env files in app/config/development/

e.g. app/config/development/database.php , app/config/development/app.php

Do not modify app/config/database.php or app/config/app.php





5-8-2014

Login failure record table added. Please run php artisan migrate to create new table


5-5-2014

The application now requires Redis for RateLimit feature.

Please make sure you have Redis server installed on your dev machine.




4-15-2014

Please import these database dump:

unotelly_portal: https://www.dropbox.com/s/dhv2mkbbh0uhxii/unotelly_portal.sql

unotelly_billing: https://www.dropbox.com/s/kqypc4ofoi2h9zi/unotelly_billing.sql

unotelly_radius: https://www.dropbox.com/s/lme903zabvtqcjy/unotelly_radius.sql


list_devices data dump: https://www.dropbox.com/s/v8omop68pfurb7q/list_devices%20%282%29.sql

How to run tests:

1. start selenium: ./start_selenium.sh | might have to add executable right
2. start local serve: ./start_app.sh
3. start tests: ./codecept run


Where to setup your local configs:

app/config/development 

Refer to this: http://laravel.com/docs/configuration#environment-configuration
