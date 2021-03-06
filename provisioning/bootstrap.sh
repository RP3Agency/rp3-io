#!/usr/bin/env bash

echo "Installing php7..."
add-apt-repository ppa:ondrej/php -y
apt-get update
apt-get install php7.0 php7.0-cli -y

echo "Installing curl..."
apt-get install -y curl >/dev/null 2>&1

echo "Installing Subversion"
apt-get install -y subversion >/dev/null 2>&1

echo "Installing nginx..."
apt-get update
apt-get install -y nginx php7.0-gd php7.0-curl php-memcached php7.0-fpm >/dev/null 2>&1
rm -rf /var/www
ln -fs /vagrant /var/www
cp /vagrant/provisioning/default /etc/nginx/sites-available/default
sed -i 's/www-data/vagrant/' /etc/nginx/nginx.conf
sed -i 's/www-data/vagrant/' /etc/php/7.0/fpm/pool.d/www.conf

echo "Installing MariaDB..."
sudo apt-get -y install software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db
sudo add-apt-repository 'deb http://ftp.cc.uoc.gr/mirrors/mariadb/repo/5.5/ubuntu trusty main'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
sudo apt-get update
sudo apt-get -y install mariadb-server
sudo sed -i.bak 's/^bind-address/#bind-address/g' /etc/mysql/my.cnf
mysql --user=root --password=password -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'password' WITH GRANT OPTION; FLUSH PRIVILEGES;"
mysqladmin --user=root --password=password create rp3agency
mysql --user=root --password=password rp3agency < /vagrant/provisioning/database.sql

echo "Getting php7 & mysql to talk to each other..."
apt-get install -y php7.0-mysql >/dev/null 2>&1

echo "Installing vim..."
apt-get install -y vim >/dev/null 2>&1

echo "Installing wp-cli..."
curl -L https://raw.github.com/wp-cli/builds/gh-pages/phar/wp-cli.phar > wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/bin/wp

echo "Restarting nginx"
service nginx restart
