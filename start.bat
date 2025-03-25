@echo off
start /B php -S 127.0.0.1:8000 -t public
start /B npm run dev
