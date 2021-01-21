FROM rafaelmit/docker-php-8.0

LABEL maintainer="Rafael Meira <rafaelmeira@me.com>"

ARG ENV=example
ENV ENV=${ENV}

# COPY CRONTAB CONFIGS
COPY ./docker/crontabs/artisan /etc/cron.d/artisan
RUN chmod 0644 /etc/cron.d/artisan
RUN crontab /etc/cron.d/artisan

# COPY SUPERVISOR CONFIG
COPY ./docker/supervisor/supervisord.conf /etc/supervisord.conf

# COPY ALL APPLICATION TO CONTAINER
COPY ./ /var/www
RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/bootstrap/cache

RUN cp .env.${ENV} .env && composer install --prefer-dist --no-scripts && \
    composer dump-autoload --optimize && \
    php artisan clear-compiled && \
    php artisan optimize

# COPY SHELLSCRIPT
COPY docker/scripts/init.sh /scripts/init.sh
RUN chmod +x /scripts/init.sh

# FINAL POINT
ENTRYPOINT ["/scripts/init.sh"]
