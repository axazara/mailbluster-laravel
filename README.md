# MailBluster Laravel Package

[![Pipeline Status](https://gitlab.com/axazara/package/mailbluster-laravel/badges/main/pipeline.svg)](https://gitlab.com/axazara/package/mailbluster-laravel)
[![Coverage](https://gitlab.com/axazara/package/mailbluster-laravel/badges/main/coverage.svg)](https://gitlab.com/axazara/package/mailbluster-laravel)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/axazara/mailbluster-laravel.svg?style=flat-square)](https://packagist.org/packages/axazara/mailbluster-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/axazara/mailbluster-laravel.svg?style=flat-square)](https://packagist.org/packages/axazara/mailbluster-laravel)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This is simple laravel package to interact with Mailbluster API.

```php
MailBluster::createLead('lead@exemple.com') // To create a lead
```

## Installation

You can install the package via composer:

```bash
composer require axazara/mailbluster-laravel
```

You must publish the config file with:

```bash
php artisan mailbluster:install
```

This is the contents of the published config file:

```php
return [
    'api_url' => env('MAILBLUSTER_API_URL'),
    'api_key' => env('MAILBLUSTER_API_KEY'),
];
```

## Setup
To use the MailBluster API, you need to set the `MAILBLUSTER_API_KEY`  environment variables in your `.env` file.

```dotenv
MAILBLUSTER_API_KEY=MAILBLUSTER_API_KEY_HERE
```
- `MAILBLUSTER_API_URL` you can get this from MailBluster API  doc.
- `MAILBLUSTER_API_KEY` you can get this from your MailBluster account dashboard.

> **IMPORTANT**
> - Save your API key as an environment variable in your `.env` file. Do not hardcode it in your code.
> - You must not share your API key with anyone.
> - You must not commit your API key to version control.

## Usage
This package provides a facade to interact with MailBluster API.

### Lead
Read leads docs [docs](docs/Leads.md)

### Fields
Read fields docs [docs](docs/Fields.md)

### Products
Read products docs [docs](docs/Products.md)

## Contribution
You can contribute to this package by forking the repository and submitting a pull request to the `dev-main` branch.

## Credits
- [Axa Zara](https://axazara.com)
- [Elias Elimah](https://gitlab.com/EliasElimah)

## Copyright
[MailBluster](https://mailbluster.com) is not affiliated with [Axa Zara](https://axazara.com).
All rights reserved.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
