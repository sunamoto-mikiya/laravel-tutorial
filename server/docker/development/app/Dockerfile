FROM php:8.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV TZ=Asia/Tokyo \
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  COMPOSER_ALLOW_SUPERUSER=1

ARG WWW_USER_ID=${WWW_USER_ID}
ARG WWW_GROUP_ID=${WWW_GROUP_ID}

RUN usermod -u $WWW_USER_ID -o www-data
RUN groupmod -g $WWW_GROUP_ID -o www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git libicu-dev libonig-dev libzip-dev unzip locales libpq-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  locale-gen en_US.UTF-8 && \
  localedef -f UTF-8 -i en_US en_US.UTF-8 && \
  mkdir /var/run/php-fpm && \
  docker-php-ext-install -j$(nproc) intl pdo_pgsql zip bcmath && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org

# node16.14.12 npm8.5.0
# OSで叩くURLが違うので注意（本番環境作業時 （↓はdebian
# https://github.com/nodesource/distributions#installation-instructions
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs
# /root/.npmのパーミッションエラーで止まるので、ローカルではnを入れる
# => nodeで入れたやつとマイナーバージョンが若干違う場合がある
RUN npm install -g n && n 16.14

COPY ./zzz-www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html
