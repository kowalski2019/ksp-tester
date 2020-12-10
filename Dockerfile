FROM php:7.2-apache

ENV TESTER_HOME /usr/tester

COPY . $TESTER_HOME/

EXPOSE 80

#WORKDIR $TESTER_HOME

CMD ["/usr/sbin/apache2ctl","-D","FOREGROUNG"]

