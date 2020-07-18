FROM php:5.6-apache

RUN apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    zip \
    unzip \
    libpq-dev \
  && rm -rf /var/lib/apt/lists
 
# Enable PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli  pdo pdo_pgsql
 
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
 
# Add cake and composer command to system path
ENV PATH="${PATH}:/var/www/html/lib/Cake/Console"
ENV PATH="${PATH}:/var/www/html/app/Vendor/bin"
 
# COPY apache site.conf file
COPY site.conf /etc/apache2/sites-available/000-default.conf
 
 
# Set default working directory
WORKDIR ./app
 
# Create tmp directory and make it writable by the web server
RUN mkdir -p \
    tmp/cache/models \
    tmp/cache/persistent \
  && chown -R :www-data \
    tmp \
  && chmod -R 770 \
    tmp
 
# Enable Apache modules and restart
RUN a2enmod rewrite \
  && service apache2 restart

WORKDIR /var/www/html

CMD ./wait-for-it.sh postgres:5432 --timeout=30 --strict -- ./start.sh

EXPOSE 80