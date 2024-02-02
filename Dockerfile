FROM php-fpm
# INSTALL PHP EXTENSIONS
RUN docker-php-ext-install pdo_mysql
# ANABLE APACHE MOD REWRITE
RUN a2enmod rewrite
# ANABLE APACHE MOD HEADER
RUN a2enmod headers
# UPDATE APT-GET AND INSTALL LIBS
RUN apt-get update -y
RUN apt-get install -y openssl zip unzip git libnss3 libpng-dev
# INSTALL COMPOSER
RUN apt-get install -y openssl zip unzip git libnss3
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer require vlucas/phpdotenv
# Change www-data user to match the host system UID and GID and chown www directory
# Defines that the image will have port 80 to expose
EXPOSE 8000
WORKDIR /app