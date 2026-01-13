############################################
# Stage 1: Composer Dependencies
############################################
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-scripts \
    --no-interaction \
    --optimize-autoloader

############################################
# Stage 2: PHP-FPM Runtime
############################################
FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    sqlite sqlite-dev \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    mariadb-client \
    zip \
    unzip \
    $PHPIZE_DEPS \
    && docker-php-ext-install \
        pdo_mysql \
        pdo_sqlite \
        mbstring \
        bcmath \
        intl \
        gd \
        zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del $PHPIZE_DEPS \
    && rm -rf /tmp/*

# Set working directory
WORKDIR /var/www

# Copy app source
COPY . .

# Copy vendor from builder stage
COPY --from=vendor /app/vendor ./vendor

# 🔹 Set permissions only for folders Laravel needs to write
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Switch to www-data user
USER www-data

EXPOSE 9000
CMD ["php-fpm"]
