FROM php:8.1-apache

RUN apt-get update && apt-get install -y zip unzip librdkafka-dev librdkafka1 && \
    pecl install rdkafka && \
    docker-php-ext-enable rdkafka

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
