FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    cron \
    supervisor \
    sqlite3 \
    libsqlite3-dev \
    iputils-ping \
    && docker-php-ext-install pdo pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

COPY app/ /var/www/html/

RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod 777 /var/www/html/uploads

RUN php /var/www/html/init_db.php \
    && chown www-data:www-data /var/www/html/database.sqlite \
    && chmod 664 /var/www/html/database.sqlite \
    && rm /var/www/html/init_db.php

RUN echo "flag3{nucleo_de_las_noches_expuesto}" > /var/www/flag3.txt \
    && chown www-data:www-data /var/www/flag3.txt \
    && chmod 640 /var/www/flag3.txt

RUN echo "flag4{las_noches_caida_root_obtenido}" > /root/flag4.txt \
    && chmod 600 /root/flag4.txt

COPY cron/cleanup.sh /opt/scripts/cleanup.sh
RUN chmod 777 /opt/scripts/cleanup.sh

COPY cron/cleanup-cron /etc/cron.d/cleanup-cron
RUN chmod 0644 /etc/cron.d/cleanup-cron

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
