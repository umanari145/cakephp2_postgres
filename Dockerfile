FROM php:5.6-apache

RUN apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    zip \
    unzip \
    libpq-dev \
  && rm -rf /var/lib/apt/lists
 
# Enable PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql
 
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
 
# Add cake and composer command to system path
ENV PATH="${PATH}:/var/www/html/lib/Cake/Console"
ENV PATH="${PATH}:/var/www/html/app/Vendor/bin"
 
# COPY apache site.conf file
COPY site.conf /etc/apache2/sites-available/000-default.conf
 
 
# Enable Apache modules and restart
RUN a2enmod rewrite \
  && service apache2 restart

WORKDIR /var/www/html

RUN mkdir ./app
RUN mkdir ./lib
RUN mkdir ./db

COPY app/ /var/www/html/app/
COPY lib/ /var/www/html/lib/
COPY db/ /var/www/html/db/

COPY index.php /var/www/html/
COPY phinx.yml /var/www/html/
COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/
COPY wait-for-it.sh /var/www/html/
COPY start.sh /var/www/html/

RUN composer install

WORKDIR /var/www/html/app

# Create tmp directory and make it writable by the web server
RUN mkdir -p \
    tmp/cache/models \
    tmp/cache/persistent \
  && chown -R :www-data \
    tmp \
  && chmod -R 770 \
    tmp

WORKDIR /var/www/html

CMD ./wait-for-it.sh ${DB_HOST}:5432 --timeout=30 --strict -- ./start.sh

EXPOSE 80