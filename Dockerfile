FROM php:8.3-cli-bookworm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    nodejs \
    npm \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        zip \
        mbstring

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install --optimize-autoloader

RUN npm install && npm run build

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000