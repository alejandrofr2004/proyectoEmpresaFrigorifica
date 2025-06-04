FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod -R 777 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/html
RUN rm /etc/apache2/sites-available/000-default.conf
RUN echo "<VirtualHost *:80>">/etc/apache2/sites-available/000-default.conf
RUN echo     "ServerAdmin webmaster@localhost">>/etc/apache2/sites-available/000-default.conf
RUN echo     "DocumentRoot /var/www/html/public">>/etc/apache2/sites-available/000-default.conf

RUN echo     "<Directory /var/www/html>">>/etc/apache2/sites-available/000-default.conf
RUN echo         "Options Indexes FollowSymLinks">>/etc/apache2/sites-available/000-default.conf
RUN echo         "AllowOverride All">>/etc/apache2/sites-available/000-default.conf
RUN echo         "Require all granted">>/etc/apache2/sites-available/000-default.conf
RUN echo     "</Directory>">>/etc/apache2/sites-available/000-default.conf

RUN echo     "ErrorLog ${APACHE_LOG_DIR}/error.log">>/etc/apache2/sites-available/000-default.conf
RUN echo     "CustomLog ${APACHE_LOG_DIR}/access.log combined">>/etc/apache2/sites-available/000-default.conf
RUN echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf
RUN service apache2 restart
