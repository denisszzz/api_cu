FROM php:8.1-fpm

WORKDIR /var/www/html

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update -y \
    && apt-get install -y nginx

ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"

RUN docker-php-ext-install opcache \
    && apt-get install libicu-dev -y \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apt-get remove libicu-dev icu-devtools -y

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongo.ini \
    && echo "extension=redis.so" >> /usr/local/etc/php/conf.d/mongo.ini


RUN apt-get update -y \
    && apt-get install -y \
            curl wget zip unzip libonig-dev \
            libzip-dev \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            wget \
            openssl \
            libssl-dev \
            libcurl4-openssl-dev \
    && pecl install mongodb redis \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-install -j$(nproc) iconv gd pdo zip opcache \
    && wget https://github.com/elastic/apm-agent-php/releases/download/v1.5.1/apm-agent-php_1.5.1_all.deb && dpkg -i apm-agent-php_1.5.1_all.deb


RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/php-opocache-cfg.ini

RUN { \
        echo 'memory_limit = 2048M'; \
        echo 'post_max_size = 40M'; \
        echo 'upload_max_filesize = 50M'; \
        echo 'elastic_apm.secret_token = '; \
        echo 'elastic_apm.service_name = prod-cuprum'; \
        echo 'display_errors = On'; \
        echo 'error_reporting = E_ALL'; \
    } > /usr/local/etc/php/conf.d/custom.ini

RUN { \
        echo 'pm.max_children = 30' ; \
        echo 'pm.start_servers = 10' ; \
        echo 'pm.min_spare_servers = 10' ; \
        echo 'pm.max_spare_servers = 20' ; \
    } >> /usr/local/etc/php-fpm.d/www.conf

COPY nginx.conf /etc/nginx/sites-enabled/default
COPY www.conf /usr/local/etc/php-fpm.d/www.conf
COPY entrypoint.sh /etc/entrypoint.sh

RUN chmod +x /etc/entrypoint.sh

COPY --chown=www-data:www-data . .

ENTRYPOINT ["/etc/entrypoint.sh"]
