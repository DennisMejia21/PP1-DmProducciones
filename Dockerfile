FROM php:8.2-apache-bookworm

# La CA opcional permite compilar en entornos con proxy manteniendo TLS activo.
RUN --mount=type=secret,id=proxy_ca \
    set -eux; \
    if [ -s /run/secrets/proxy_ca ]; then \
        printf 'Acquire::https::CaInfo "/run/secrets/proxy_ca";\n' > /etc/apt/apt.conf.d/99-build-proxy-ca; \
    fi; \
    apt-get update; \
    apt-get install -y --no-install-recommends libjpeg62-turbo-dev libpng-dev libwebp-dev; \
    docker-php-ext-configure gd --with-jpeg --with-webp; \
    docker-php-ext-install -j2 mysqli gd; \
    rm -f /etc/apt/apt.conf.d/99-build-proxy-ca; \
    rm -rf /var/lib/apt/lists/*

COPY docker/php.ini /usr/local/etc/php/conf.d/dmproducciones.ini
COPY docker/healthcheck.php /usr/local/bin/dm-healthcheck.php
COPY --chown=www-data:www-data proyectodm/ /var/www/html/

EXPOSE 80
