# Changelog

All Notable changes to `laravel-artisan` will be documented in this file.

## 2.0.1 - 2025/02/22

- Fix: Show default success message when command output is empty (e.g. `optimize`)
- Fix: Preserve request URL (including port) when generating links via `$_SERVER` in View Composer
- Fix: Update maintenance mode exception patterns for Laravel 11+ (`artisan`, `artisan/*`)
- Fix: Typo in unknown command translation

## 2.0.0 - 2025/02/22

- **BREAKING**: Require Laravel 12.x and PHP 8.2+
- Update `illuminate/support` to ^12.0
- Update `orchestra/testbench` to ^10.0
- Update `phpunit/phpunit` to ^11.0
- Add Dependabot configuration for automatic dependency updates
- Update README with Laravel 11+ configuration instructions

## 1.0.1 - 2023/01/20

- [Add key:generate command](https://github.com/LeBarbuCodeur/laravel-artisan/issues/6)
- [Add Github templates](https://github.com/LeBarbuCodeur/laravel-artisan/issues/4)
- [Improve readme file with configuration, contributing and credits parts added](https://github.com/LeBarbuCodeur/laravel-artisan/issues/1)

## 1.0.0 - 2023/01/11

- Initial release
