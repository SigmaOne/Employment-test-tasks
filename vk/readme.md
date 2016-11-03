# About
Simple, stable to high load system i designed to be accepted to the vk-dev team.  

## Key features
* Supports large - 1000000 items in db.
* System is pretty stable with 1000 requests per minute.
* Page load time is less then 500ms because of memcached additional tier before db access.

## Requirements
  * PHP7
  * MySQL
  * Memcached

## Project structure
  * pages/* - route handlers
  * lib/* - my main library with db access functions
  * util/* - util scripts which were used in my developing process
  * router.php - declares routing mechanics
  * layout.php - layout(wrapper) for all the site's HTML pages.
  * resources/* - .js, .css and other resource files

## How to run
```bash
# This howto is platform specific - for Arch Linux

# Setup MySQL on port 3306, with user root 
pacman -Suy mariadb
mysql_secure_installation
echo 'export MYSQL_ROOT_PASSWORD=mypass' >> ~/.bashrc 
systemctl start mysql
systemctl enable mysql

# Setup Memcached on port 11211
pacman -Suy memcached memcache
systemctl start memcached
systemctl enable memcached

# Setup php - uncomment mysql and memcache libraries
vim /etc/php/php.ini

# Setup and seed db
php util/setup_db.php
php util/seed_db.php

# Run server
php -S localhost:8000 router.php
```
