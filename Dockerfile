FROM php:7.4-cli-bullseye AS base

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENTRYPOINT bash

WORKDIR /app

RUN useradd --create-home app \
  && chown app:app -R /app \
  && apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    unzip

###

FROM base AS dev

ENV PATH ${PATH}:/app/vendor/bin:/app/tools/php-cs-fixer/vendor/bin

COPY --chown=app:app composer.* ./
COPY --chown=app:app tools tools

RUN composer install
RUN composer install --working-dir=tools/php-cs-fixer

COPY --chown=app:app . .
