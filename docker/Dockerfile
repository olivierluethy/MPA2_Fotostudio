# Fotostudio Web-App – PHP/Apache Image
# Basis: offizielles PHP mit Apache. Enthält genau die Extensions,
# die die App braucht (PDO/MySQL für die Models, mysqli für config.php,
# GD nur für das Generieren der Mock-Bilder beim Seeding).
FROM php:8.2-apache

# Systembibliotheken + PHP-Extensions installieren
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mysqli gd \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Apache: .htaccess (mod_rewrite) im DocumentRoot erlauben
COPY docker/apache-fotostudio.conf /etc/apache2/conf-available/zz-fotostudio.conf
RUN a2enconf zz-fotostudio

# Grössere Uploads erlauben, damit Bild-Uploads nicht abgeschnitten werden
COPY docker/php-uploads.ini /usr/local/etc/php/conf.d/zz-uploads.ini

# Entrypoint (wartet auf DB + seedet Mock-Daten) und Seeder ins Image legen
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/seed.php /usr/local/bin/seed.php
RUN chmod +x /usr/local/bin/entrypoint.sh

# Anwendungscode ins Image kopieren (im Compose-Setup zusätzlich als Volume
# gemountet, damit Codeänderungen sofort sichtbar sind).
COPY . /var/www/html

WORKDIR /var/www/html

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
