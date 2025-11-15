FROM php:8.4-bullseye

ENV DEBIAN_FRONTEND=noninteractive

RUN set -eux; \
    apt-get update && \
    apt-get install -y \
        git \
        unzip \
        zip \
        curl \
        wget \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        libpq-dev \
        libssl-dev \
        && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath opcache \
        && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

RUN composer global require laravel/installer

COPY . .

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
chown -R www-data:www-data /var/www/html && \
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html/
RUN composer install
RUN if [ ! -f .env ]; then cp .env.example .env; fi

CMD ["tail", "-f", "/dev/null"]

