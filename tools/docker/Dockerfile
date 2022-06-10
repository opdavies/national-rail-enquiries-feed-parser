ARG PHP_VERSION=${PHP_VERSION}

FROM php:${PHP_VERSION}-cli-bullseye AS base

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENTRYPOINT ["bash"]

WORKDIR /app

RUN useradd --create-home app \
  && chown app:app -R /app \
  && apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    unzip \
  && rm -fr /var/lib/apt/lists/*

###

FROM base AS dev

ENV PATH ${PATH}:/app/vendor/bin:/app/tools/php-cs-fixer/vendor/bin

COPY --chown=app:app composer.* ./
COPY --chown=app:app tools tools

USER app

RUN composer install \
  && composer install --working-dir=tools/php-cs-fixer

COPY --chown=app:app . .
