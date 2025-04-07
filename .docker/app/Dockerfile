FROM php:8.3-fpm-alpine

ARG SERVER_ENVIRONMENT
ENV APP_ENV=${SERVER_ENVIRONMENT}

RUN apk update && apk add --no-cache \
    nano \
    linux-headers \
    libzip-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    bzip2-dev \
    libwebp-dev \
    zip \
    jpegoptim \
    pngquant \
    optipng \
    icu-dev \
    freetype-dev \
    zlib-dev \
    curl-dev \
    imap-dev \
    git \
    vim \
    bash \
    oniguruma-dev \
    autoconf \
    g++ \
    make \
    nodejs \
    npm

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-configure imap && \
    docker-php-ext-install -j$(nproc) \
        opcache \
        pdo \
        pdo_mysql \
        zip \
        imap \
        gd \
        intl \
        bcmath \
        sockets \
        pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Optional: Add non-root user for Laravel
RUN addgroup -g 1000 www && adduser -u 1000 -G www -s /bin/sh -D www
USER www

WORKDIR /var/www
