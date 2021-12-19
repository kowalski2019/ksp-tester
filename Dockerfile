FROM php:7.4-apache

WORKDIR /var/www/html/src/

CMD mkdir -p $WORKDIR
CMD mkdir -p "/var/www/html/resources"
CMD mkdir -p "/var/www/html/uploads"

COPY pagesForDocker $WORKDIR
COPY ["src/homepage.php", "src/style.css", "src/upload.php", "src/upload1.php", "src/upload2.php","src/script.js", "src/api.php", "/var/www/html/src/"]
COPY resources /var/www/html/resources
COPY uploads /var/www/html/uploads

RUN ln -s /var/www/html/resources /var/www/html/src/resources
RUN chown -R www-data:www-data "/var/www/html/"
RUN chmod -R 777 "/var/www/html/"

EXPOSE 80
CMD ["apache2-foreground"]
