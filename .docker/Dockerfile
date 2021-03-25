FROM php:7.4-fpm-alpine
LABEL maintainer="carlos.clayton@gmail.com"

ARG LOCAL_USER=root
ARG USER_ID=0
ARG GROUP_ID=0

ENV LANG=pt_BR.UTF-8 \
    LANGUAGE=pt_BR.UTF-8

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    freetype-dev \
    curl-dev \
    imagemagick-dev \
    libtool \
    libxml2-dev \
    postgresql-dev \
    sqlite-dev \
    oniguruma-dev \
    libjpeg-turbo-dev \
    libpng-dev

# Installing dependencies
RUN apk add --no-cache \
    bash \
    curl \
    g++ \
    gcc \
    git \
    imagemagick \
    libc-dev \
    libpng-dev \
    make \
    mysql-client \
    nodejs \
    nodejs-npm \
    yarn \
    openssh-client \
    postgresql-libs \
    rsync \
    zlib-dev \
    libzip-dev \
    jpegoptim \
    optipng \
    pngquant \
    icu-dev \
    --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted gnu-libiconv

ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

# Install PECL and PEAR extensions
RUN pecl install -o -f \
    imagick \
    redis \
    && rm -rf /tmp/pear

# Install and enable php extensions
RUN docker-php-ext-enable \
        imagick \
        redis \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure zip \
    && docker-php-ext-install \
        intl \
        curl \
        iconv \
        mbstring \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        pcntl \
        tokenizer \
        xml \
        gd \
        zip \
        bcmath

# Install and enable xDebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Prevent error in nginx error.log
RUN touch /var/log/xdebug_remote.log
RUN chmod 777 /var/log/xdebug_remote.log

# Cleanup dev dependencies
RUN apk del -f .build-deps

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require laravel/envoy --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts \
    && if [ ! "$LOCAL_USER" = "root" ]; \
    then addgroup -g ${GROUP_ID} ${LOCAL_USER} \
    &&  adduser -u ${USER_ID} -S ${LOCAL_USER} -G ${LOCAL_USER}; \
    else echo "No user to add."; fi

USER ${LOCAL_USER}

WORKDIR /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
