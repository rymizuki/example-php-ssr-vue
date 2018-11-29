FROM stesie/v8js

RUN apt-get update \
 && apt-get -y install curl

WORKDIR /usr/local/docker/app

COPY ./app.php /usr/local/docker/app/app.php

CMD [ "php", "-S",  "0.0.0.0:3000", "app.php" ]

EXPOSE 3000