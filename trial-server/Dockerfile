FROM php:8.4-bullseye

ENV DEBIAN_FRONTEND=noninteractive

# Instala dependências básicas
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

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Diretório de trabalho
#WORKDIR /var/www/html/trial-server
WORKDIR /var/www/html

# Copiar dependências e instalar
#COPY composer.json composer.lock ./
COPY . .
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || true

RUN composer global require laravel/installer

# Copiar o restante do projeto
COPY . .

# Ajustar permissões
#RUN chown -R www-data:www-data /var/www/html \
 #   && chmod -R 775 /var/www/html/storage /var/www/html/boot

WORKDIR /var/www/html/trial-server


RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
chown -R www-data:www-data /var/www/html && \
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install

#CMD ["/bin/bash"]
CMD ["tail", "-f", "/dev/null"]

