#!/usr/bin/env bash

## set not interactive, or mysql server install will be skipped since we're not entering a password for root
export DEBIAN_FRONTEND=noninteractive

apt-get update

### install software
## install all packages using mysql as the db
apt-get install -yf apache2 php5-dev libapache2-mod-php5 mysql-server-5.5 php5-json git php5-mysql php5-xcache php5-cli php5-curl

## install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
mkdir /home/ubuntu/.composer
chown -R ubuntu:ubuntu /home/ubuntu/.composer

## install phpunit
wget https://phar.phpunit.de/phpunit-old.phar
chmod +x phpunit-old.phar
mv phpunit-old.phar /usr/local/bin/phpunit

## setup DB
mysql -u root -e "CREATE DATABASE IF NOT EXISTS philipswebapp DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;"
mysql -u root -e "GRANT ALL PRIVILEGES ON philipswebapp.* TO 'philipswebapp'@'localhost' IDENTIFIED BY 'philipswebapp';"
service mysql restart
sleep 5

## install db tables & type data
cd /vagrant/
composer install
php app/console doctrine:schema:create --no-interaction
## install assets
sudo -u www-data php app/console --env=dev assets:install --no-interaction
sudo -u www-data php app/console --env=dev assetic:dump --no-interaction


## setup apache
rm -rf /var/www
ln -fs /vagrant/web /var/www
cp /vagrant/apache24.conf /etc/apache2/sites-available/apache24.conf
a2enmod headers
a2enmod rewrite
a2dissite 000-default.conf
a2ensite apache24.conf

service apache2 restart