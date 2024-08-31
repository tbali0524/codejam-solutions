call parallel-lint --version
call parallel-lint --exclude .git --exclude .tools .
call phpcs --version
call phpcs
call php-cs-fixer fix --dry-run --show-progress=dots --ansi --diff -vv
call phpstan --version
call phpstan --ansi --verbose
