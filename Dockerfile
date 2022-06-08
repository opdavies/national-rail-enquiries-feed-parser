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

ENV PATH ${PATH}:/app/vendor/bin

COPY --chown=app:app composer.* ./

RUN composer install

COPY --chown=app:app . .

###

FROM dev AS test

RUN pest
