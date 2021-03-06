#!/bin/bash
# LAMP Ubuntu Server

sudo apt-get update -y 

#Install PHP5 MYSQL PHPMYADMIN

sudo apt-get install apache2 php5 php5-cli php5-fpm php5-gd libssh2-php libapache2-mod-php5 php5-mcrypt mysql-server php5-mysql git unzip zip php5-curl mailutils php5-json phpmyadmin -y 

sudo php5enmod mcrypt

# go to this folder to add this line 
cd /etc/apache2/sites-enabled/
sed -i -e '1i Include /etc/phpmyadmin/apache.conf \' 000-default.conf

cd /etc/apache2/mods-enabled
sudo echo "<IfModule mod_dir.c>" > dir.conf
sudo echo "DirectoryIndex index.php index.html index.cgi index.pl index.php index.xhtml index.htm" >> dir.conf
sudo echo "</IfModule>" >> dir.conf


# start apache
sudo service apache2 restart

cd /etc/phpmyadmin/
sed -i -e '102i $i++; \' config.inc.php
sed -i -e '103i $cfg['Servers'][$i]['host'] = 'tripangel.cjol2ukyqlys.us-east-1.rds.amazonaws.com'; \' config.inc.php
sed -i -e '104i $cfg['Servers'][$i]['port'] = '3306'; \' config.inc.php
sed -i -e '105i $cfg['Servers'][$i]['socket'] = ' '; \' config.inc.php
sed -i -e '106i $cfg['Servers'][$i]['connect_type'] = 'tcp'; \' config.inc.php
sed -i -e '107i $cfg['Servers'][$i]['extension'] = 'mysql'; \' config.inc.php
sed -i -e '108i $cfg['Servers'][$i]['compress'] = false; \' config.inc.php
sed -i -e '109i $cfg['Servers'][$i]['auth_type'] = 'config'; \' config.inc.php
sed -i -e '110i $cfg['Servers'][$i]['user'] = 'trip1ken2'; \' config.inc.php
sed -i -e '111i $cfg['Servers'][$i]['password'] = 'trip1ken2'; \' config.inc.php
cd /var/www/

# Download Latest Wordpress

sudo wget https://wordpress.org/latest.tar.gz

#Extarct tar 

sudo tar -xzf latest.tar.gz

#remove tar and html 
sudo rm latest.tar.gz
sudo rm -rf html

#rename wordpress into html folder
sudo mv wordpress html

# start apache
sudo service apache2 restart
#For the PHP setting, open the /etc/php5/apache2/php.ini and configure the sendmail_path.
#php.ini
#sendmail_path = "/usr/sbin/sendmail -t -i"
#sudo service apache2 restart

#How to connect /home/user_dir with /var/www folder so that ftp and webserver work with no error
sudo apt-get install vsftpd
#change uuser and group html web folder

sudo usermod -a -G www-data ubuntu
sudo chgrp www-data /var/www/html
sudo chmod -R g+rwxs /var/www/html

# Change Ownership and Permission of new Html Folder
sudo chown -R ubuntu:www-data /var/www/html/


#EOF
#Written by P.S (Linux System Admin &  Amazon Cloud Artitecture Associate)



