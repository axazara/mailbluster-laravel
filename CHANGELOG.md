# Changelog

All notable changes to `mailbluster-laravel` will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org). Version
headings match the Git tags published on GitHub and Packagist.

## v2.0.1 - 2026-06-06

### Changed
- Migrate CI from GitLab CI to GitHub Actions
- Add contributor guidance for AI agents (`CLAUDE.md`)
- Restructure this changelog so version headings match the published release tags

### Removed
- Release stage from the CI pipeline

## v2.0.0 - 2026-02-08

### Breaking Changes
- Bump minimum PHP version from `^8.1` to `^8.2`
- Drop Laravel 9 support (EOL)
- Drop PHPUnit 9 support

### Added
- Laravel 12 support
- Laravel 11 support

### Changed
- Update `orchestra/testbench` to `^8.0 || ^9.0 || ^10.0`
- Update `phpunit/phpunit` to `^10.5 || ^11.0`
- Update `axazara/php-cs` to `^0.3`
- Update `larastan/larastan` to `^2.4 || ^3.0`
- Modernize PHPUnit configuration to the PHPUnit 10+ format
- Clean up `.gitignore`

### Removed
- `insolita/unused-scanner` dependency and its CI job
- `nunomaduro/collision` dependency
- Deprecated PHPUnit 9 configuration attributes

## v0.3 - 2026-02-08

### Added
- Laravel 12 support

## v0.2 - 2024-07-14

### Added
- Laravel 11 support

### Changed
- Run the CI test matrix in parallel across PHP 8.1, 8.2 and 8.3

## v0.1 - 2023-11-06

Initial public release of the AxaZara MailBluster Laravel package.

### Added
- Fluent `MailBluster` facade with Laravel package auto-discovery
- Leads API: create, read, update, delete (leads addressed by `md5($email)`)
- Custom Fields API: create, list, update, delete
- Products API: create, list, get, update, delete
- Laravel 9 and 10 support (PHP 8.1+)
- Test mode via `MAILBLUSTER_API_URL=test` to suppress real HTTP calls
- Typed exceptions: `ApiKeyIsMissing`, `InvalidApiUrl`, `InvalidEmail`, `RequestError`

---

## Legacy entries

The two entries below predate the `v0.1` GitHub tag and do not map to any
published GitHub/Packagist tag. They are kept for historical reference.

### 1.0.1 - 2022-12-01
- Update README.md
- Update docs/Leads.md
- Update docs/Fields.md
- Update docs/Products.md

### 1.0.0 - 2022-11-10
- Initial release
