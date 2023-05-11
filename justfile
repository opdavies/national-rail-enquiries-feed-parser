default:
  @just --list

test *args:
  ./vendor/bin/pest {{ args }}

test-watch *args:
  nodemon --ext "php" --watch "." --exec "just test {{ args }} || exit 1"
