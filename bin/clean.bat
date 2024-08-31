@echo off
if exist .tools\\.phpcs.cache          del .tools\\.phpcs.cache
if exist .tools\\.php-cs-fixer.cache   del .tools\\.php-cs-fixer.cache
if exist .tools\\phpstan\\              rmdir /S /Q .tools\\phpstan
del output\output*.txt
