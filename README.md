# Mailify Laravel Package

[![Pipeline Status](https://gitlab.com/axazara/mailbluster-laravel/badges/main/pipeline.svg)](https://gitlab.com/axazara/mailbluster-laravel)
[![Coverage](https://gitlab.com/axazara/mailbluster-laravel/badges/main/coverage.svg)](https://gitlab.com/axazara/mailbluster-laravel)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/axazara/mailbluster-laravel.svg?style=flat-square)](https://packagist.org/packages/axazara/mailbluster-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/axazara/mailbluster-laravel.svg?style=flat-square)](https://packagist.org/packages/axazara/mailbluster-laravel)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This is simple laravel package to interact with Mailbluster API.

```php
Mailify::createLead('lead@exemple.com') // To create a lead
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
- `MAILIFY_API_URL` you can get this from your Mailify dashboard.
- `MAILBLUSTER_API_KEY` you can get this from your MailBluster dashboard.

> **IMPORTANT**
> - Save your API key as an environment variable in your `.env` file. Do not hardcode it in your code.
> - You must not share your API key with anyone.
> - You must not commit your API key to version control.

## Usage
To send an Email, simply use the following syntax:

```php
Mailify::send("welcome_template")->to("john@getmailbluster.com")->now();
```
- `send()` is take the Mailify template ID
- `to()` is take the recipient email address
- `now()` if you want to send the email immediately

You can also pass another parameter though the below method :

> **Note:**
> All parameters must be passed before the `now()` or `later()` method.

###### - Template parameters : (optional)

This is an array of parameters that will be passed to the template. The parameters will be available in the template as variables.

```php
 ->with([
    'name' => 'John Doe',
    'order_id' => 1234,
])
```

###### - **Reply to** : (optional)

The reply to address is the address that will be used when the recipient replies to the email. If not specified, the replyTo address will be the address specified in the Mailify dashboard.
You can also set default replyTo address in the config file or use `MAILIFY_REPLY_TO` environment variable in `.env` file.

```php
 ->replyTo("team@exemple.com")
```

###### - **Priority** : (optional)

The priority of email.
Mailify supports 2 priority level : `0` (default) and `1` (high);
You can also set default priority in the config file or use the `MAILIFY_PRIORITY` environment variable in `.env` file.
Default priority is `0`.

```php
 ->priority(1)
```

## Example Usage with full parameters

```php
Mailify::send("welcome_template")
    ->to("john@example.com")
    ->with([
        'name' => 'John Doe',
        'order_id' => 1234,
    ])
    ->replyTo("help@company.com")
    ->priority(1)
    ->now();
```

## Sending an email later
You may also choose to queue the email sending with `later()` or `afterResponse()` method.

- `later()` method is send the email via queue
Mailify use the Laravel queue system to send email though `default` queue.
This is useful if you don't want to wait for the email to be sent before returning a response to the user or if you want to send the email in the background.
> **Note:** 
> - You must have a queue worker running in order to send the email. You can read more about queue workers in the [Laravel documentation](https://laravel.com/docs/master/queues#running-the-queue-worker).
> - If you want to use a custom queue, you need to set the MAILIFY_QUEUE environment variable to the name of the queue you wish to use. Be sure to have a queue worker running to process the queued messages, otherwise they will not be sent.

- `afterResponse()` method is used to send email after the response is sent to the browser.
This method do not require queue driver to be configured.
> **Note:**
> This method only work if your web server is using **FastCGI** or run with **Laravel Octane** (Swoole, RoadRunner).


## Local Development
If you are using Mailify in a local development environment, you don't want to send real emails. 
Instead, you can use the Mailify with [Mailtrap](https://mailtrap.io) SMTP integration to view emails in your browser instead of sending them.

To avoid error in local development or testing environment you can set the `MAILIFY_API_URL` environment variable to `null` in your `.env` file, this will disable the Mailify API, your app environment must be set to `local` or `testing`.

## Error & Exceptions
If an error occurs while sending the email, an exception will be thrown. You can catch the exception and handle it accordingly.
```php
try {
    Mailify::send("welcome_template")->to("test@test.com")->now();
} catch (Exception $exception) {
    // Handle the exception
}
```
Possible exceptions are :
- `Axazara\Mailify\Exceptions\ApiKeyIsMissing`
- `Axazara\Mailify\Exceptions\PriorityIsInvalid`
- `Axazara\Mailify\Exceptions\ReplyToIsInvalid`
- `Axazara\Mailify\Exceptions\SendingError`
- `Axazara\Mailify\Exceptions\ToIsInvalid`

All error is logged in the `laravel.log` file, you can find the log file in the `storage/logs` directory.
Exceptions is thrown only if the `APP_DEBUG` environment variable is set to `true`.

## Helpful links
- Read the [Mailify documentation](https://getmailbluster.io/docs) to learn more about Mailify.
- Read the [Laravel documentation](https://laravel.com/docs) to learn more about Laravel.
- Read the [Laravel Queue documentation](https://laravel.com/docs/queues) to learn more about Laravel Queue.
- Read the [Laravel Octane documentation](https://laravel.com/docs/octane) to learn more about Laravel Octane.
- Read the [Mailtrap documentation](https://mailtrap.io/docs) to learn more about Mailtrap.

## Next features (TODO) :
- [ ] Add `->attach()` method to attach file to email
- [ ] Add `->bcc()` method to send email to BCC
- [ ] Add `->cc()` method to send email to CC
- [ ] Add `->from()` method to set email sender

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Security Vulnerabilities

If you've found a bug regarding security please mail [hello@axazara.com](mailto:hello@axazara.com) instead of using the issue tracker..


## Credits

- [Axazara](https://gitlab.com/axazara)
- [Elias Elimah](https://gitlab.com/EliasElimah)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
