FROM php:7.2-apache-stretch

COPY . /var/www/html
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/start.sh /usr/local/bin/start

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod +x /usr/local/bin/start \
    && docker-php-ext-install pdo_mysql \
    && a2enmod rewrite 

CMD ["/usr/local/bin/start"]