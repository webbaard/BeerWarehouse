@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../vendor/phpstan/phpstan/bin/phpstan
php "%BIN_TARGET%" %*
