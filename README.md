# MLTest
Distinguish Circle and Square with Machine Learning

## Installation
In order to satisfy the requirements, execute the following commands:

    $ aptitude -y install apache2 php php-cgi libapache2-mod-php php-common php-pear php-mbstring php-gd
    $ pip3 install tensorflow pillow
    
After that, you need to move the MLTest directory to root directory of Apache (`/var/www/html` by default), and execute the following command:

    $ chmod -R a+rw MLTest/data
