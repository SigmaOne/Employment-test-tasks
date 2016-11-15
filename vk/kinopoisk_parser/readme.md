# About
Simple Kinopoisk parser written in Java with Spring framework

## How to run
```bash
# This howto is platform specific - for Arch Linux

# Setup MySQL on port 3306, with user root 
pacman -Suy mariadb
mysql_secure_installation
systemctl start mysql
systemctl enable mysql

# Setup java environment
pacman -Suy jdk8-openjdk gradle

# Run server
gradle bootRun
```
