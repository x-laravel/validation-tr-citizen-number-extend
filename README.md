# Turkish Citizen Number Validation for Laravel

<p align="center">
<a href="https://github.com/X-Laravel/validation-tr-citizen-number-extend/actions/workflows/tests.yml"><img src="https://github.com/X-Laravel/validation-tr-citizen-number-extend/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-citizen-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/v/x-laravel/validation-tr-citizen-number-extend" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-citizen-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/php-v/x-laravel/validation-tr-citizen-number-extend" alt="PHP Version"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-citizen-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/dt/x-laravel/validation-tr-citizen-number-extend" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-citizen-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/l/x-laravel/validation-tr-citizen-number-extend" alt="License"></a>
</p>

A Laravel validation rule for Turkish citizen numbers (T.C. Kimlik No). It wraps
[x-adam/tr-citizen-number-validation](https://github.com/X-Adam/tr-citizen-number-validation), which
checks the number offline against the official checksum rules — no network access, no dependencies
beyond Laravel itself.

## Requirements

| Package version | PHP | Laravel |
|-----------------|-----|---------|
| 2.x | 8.1+ | 10, 11, 12, 13 |
| 1.x | 7.0+ | 5.5+ |

## Installation

```bash
composer require x-laravel/validation-tr-citizen-number-extend
```

The service provider is registered through package discovery.

## Usage

### Rule object

```php
use XLaravel\ValidationTrCitizenNumberExtend\Rules\TrCitizenNumber;

$request->validate([
    'citizen_no' => ['required', new TrCitizenNumber],
]);
```

The rule object comes with Turkish and English error messages and picks the one matching the
application locale.

### String alias

```php
$request->validate([
    'citizen_no' => ['required', 'tr_citizen_number'],
]);
```

For the string alias Laravel resolves the error message the way it does for any extended rule, so
add a line to your application's `lang/xx/validation.php`:

```php
'tr_citizen_number' => ':attribute geçerli bir T.C. kimlik numarası olmalıdır.',
```

Without it Laravel falls back to the raw key `validation.tr_citizen_number`. You can also pass an
inline message through the validator's `messages` argument or a form request's `messages()` method.

Either form accepts `int` and `string` values; anything else — arrays, booleans, floats — fails
validation instead of throwing.

## Customising the messages

To change the rule object's messages, publish the language files and edit them:

```bash
php artisan vendor:publish --tag=tr-citizen-number-lang
```

They land in `lang/vendor/tr-citizen-number/{tr,en}/validation.php`.

## What it checks

The rule answers **"is this a well-formed citizen number?"** — length, leading digit and both check
digits. It does not verify that the number belongs to a particular person; that requires the KPS
service of the Turkish Directorate of Population and Citizenship Affairs, which is only available to
institutions with a membership.

## Testing

```bash
composer install
composer test
composer analyse
```

The suite runs on Orchestra Testbench against every supported Laravel and PHP combination in CI,
along with PHPStan (Larastan) at its highest level.

## License

Open source software licensed under the [MIT license](LICENSE).
