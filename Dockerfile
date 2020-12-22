FROM php:7.2-fpm

# Copy composer.lock and composer.json
COPY ./composer.lock ./composer.json /var/www/
COPY docker-entry.sh /
RUN chmod +x /docker-entry.sh

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    libpng-dev \
    libpq-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    vim \
    zip libzip-dev zlib1g-dev\
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql zip exif pcntl opcache
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-configure mbstring --enable-mbstring
RUN docker-php-ext-install gd mbstring

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# install this to make composer download faster
# RUN composer global require hirak/prestissimo

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory
COPY ./ /var/www/
RUN ls /var/www

COPY ./server-config/nginx/conf.d/ /etc/nginx/conf.d/
RUN ls /etc/nginx/conf.d

COPY ./server-config/php/local.ini /usr/local/etc/php/conf.d/local.ini
RUN ls /usr/local/etc/php/conf.d
RUN cat /usr/local/etc/php/conf.d/local.ini

RUN rm -rf /etc/nginx/sites-enabled
RUN mkdir -p /etc/nginx/sites-enabled

RUN chmod -R 777 /var/www/storage/
RUN composer install
RUN composer dump-autoload

# workaround for mpdf error, it's trying to write to this folder by dafault and I can't change it using laravel-mpdf
# RUN chmod -R 777 /var/www/vendor/mpdf/mpdf/tmp

RUN php artisan cache:clear

# Expose port 80 and start php-fpm server
EXPOSE 80
CMD ["/docker-entry.sh"]
