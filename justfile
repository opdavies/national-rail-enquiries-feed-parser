default:
  @just --list

alias s := static-analysis
alias t := test

static-analysis *args:
  ./vendor/bin/phpstan --no-progress {{ args }}

test *args:
  ./vendor/bin/pest {{ args }}

# Run and re-run a recipe when there are changes.
watch command="test" *args="":
  nodemon \
    --exec "just {{ command }} {{ args }} || exit 1" \
    --ext "php" \
    --ignore vendor \
    --watch "."
