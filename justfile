default:
  @just --list

test *args:
  ./vendor/bin/pest {{ args }}
