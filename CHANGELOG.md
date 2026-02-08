# Changelog

All notable changes to `mailbluster-laravel` will be documented in this file.


## 2.0.0 - 2026-02-08

### Breaking Changes
- Bump minimum PHP version from ^8.1 to ^8.2
- Drop Laravel 9 support (EOL)
- Drop PHPUnit 9 support

### Added
- Laravel 12 support
- Laravel 11 support
- Automated GitLab release stage on version tags
- PHPStan CI job with GitLab code quality reporting

### Changed
- Update `orchestra/testbench` to `^8.0 || ^9.0 || ^10.0`
- Update `phpunit/phpunit` to `^10.5 || ^11.0`
- Update `axazara/php-cs` to `^0.3`
- Update `larastan/larastan` to `^2.4 || ^3.0`
- Modernize PHPUnit config to PHPUnit 10+ format
- Switch CI to use pre-built Docker image (`laravel-docker:8.3`)
- Clean up `.gitignore`

### Removed
- `insolita/unused-scanner` dependency and CI job
- `nunomaduro/collision` dependency
- Deprecated PHPUnit 9 config attributes

## 1.0.1 - 2022-12-1
- Update README.md
- Update docs/Leads.md
- Update docs/Fields.md
- Update docs/Products.md

## 1.0.0 - 2022-11-10
- Initial release