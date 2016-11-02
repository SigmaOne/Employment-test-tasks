# About
Simple, stable to high load system i designed to be accepted to the vk-dev team.  

## Key features
* Supports large - 1000000 items in db.
* System is pretty stable with 1000 requests per minute.
* Page load time is less then 500ms because of memcached additional tier.

## Requirements
  * PHP7
  * MySQL
  * Memcached

## Project structure
  * router.php - declares routing mechanics
  * layout.php - layout(wrapper) for all the site's HTML pages.
  * pages/* - route handlers
  * util/* - util functions and scripts which were used in my developing process
  * resources/* - .js, .css and image files

## How to run
```bash
# Setup MySQL
# Setup Memcached
php -S localhost:8000 router.php
```
