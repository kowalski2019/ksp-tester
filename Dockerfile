FROM php:7.2-apache

EXPOSE 80


CMD ["/usr/sbin/apache2ctl","-D","FOREGROUNG"]
