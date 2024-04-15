FROM alpine:3.19

ARG WWWGROUP
ARG WWWUSER

# Install packages and remove default server definition
RUN apk update && apk --no-cache add \
    bash \
    curl \
    nginx \
    nodejs \
    npm \
    php82 \
    php82-ctype \
    php82-curl \
    php82-dom \
    php82-fpm \
    php82-gd \
    php82-intl \
    php82-json \
    php82-mbstring \
    php82-pdo_pgsql \
    php82-pdo_sqlite \
    php82-pgsql \
    php82-opcache \
    php82-openssl \
    php82-phar \
    php82-session \
    php82-xml \
    php82-xmlreader \
    php82-pecl-xdebug \
    php82-zlib \
    php82-tokenizer \
    php82-fileinfo \
    php82-xmlwriter \
    php82-redis \
    ca-certificates \
    supervisor \
    libcap \
    composer \
&& setcap cap_setgid=ep /bin/busybox \
&& update-ca-certificates --fresh

RUN addgroup -g ${WWWGROUP:-1000} laravel
RUN adduser -u ${WWWUSER:-1337} -s /bin/bash -G laravel -D laravel

# Setup Laravel cron
COPY docker/cron.txt /cron.txt
RUN mkdir /var/log/cron \
    && touch /var/log/cron/cron.log \
    && touch /etc/crontabs/laravel \
    && cat /cron.txt >> /etc/crontabs/laravel

COPY --chown=laravel docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Configure nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY docker/fpm-pool.conf /etc/php82/php-fpm.d/www.conf
COPY docker/php.ini /etc/php82/conf.d/custom.ini

# Configure x-debug
COPY docker/xdebug.ini /etc/php82/conf.d/xdebug.ini

# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /var/www/html

# Make sure files/folders needed by the processes are accessable when they run under the laravel user
RUN chown -R laravel.laravel /var/www/html && \
  chown -R laravel.laravel /run && \
  chown -R laravel.laravel /var/lib/nginx && \
  chown -R laravel.laravel /var/log/nginx && \
  chown -R laravel.laravel /var/log/cron

# Switch to use a non-root user from here on
USER laravel

# Add application
WORKDIR /var/www/html
COPY --chown=laravel . /var/www/html/

## Install php app-level dependencies
#RUN composer install
#
## Install node app-level dependencies
#RUN npm install

# Expose the port nginx is reachable on
EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
