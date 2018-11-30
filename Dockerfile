FROM stesie/v8js

RUN apt-get update \
 && apt-get -y install curl \
 && apt-get -y install php7.0-curl

RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer

RUN mkdir -p /usr/local/docker/app

WORKDIR /usr/local/docker/app

RUN composer config -g repos.packagist composer https://packagist.jp \
 && composer global require hirak/prestissimo

COPY ./composer.json /usr/local/docker/app/composer.json
RUN composer install

COPY ./src /usr/local/docker/app/src
COPY ./app.php /usr/local/docker/app/app.php

CMD [ "php", "-S",  "0.0.0.0:3000", "app.php" ]

EXPOSE 3000