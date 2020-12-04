FROM php:7.4-cli

ENV TESTER_HOME /usr/tester

COPY . $TESTER_HOME/

WORKDIR $TESTER_HOME
ENTRYPOINT ["sh","-c"]
CMD ["exec php -S localhost:4000 -t /usr/tester"]
