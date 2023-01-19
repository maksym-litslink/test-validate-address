FROM php:8.0-apache
RUN docker-php-ext-install pdo_mysql
RUN apt-get update
RUN apt-get install netcat -y
RUN apt-get clean
COPY . /var/www/html
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
