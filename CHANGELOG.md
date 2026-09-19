# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed

- Minimum PHP version raised from 7.0 to 8.1; supported Laravel versions are now 10 through 13.
- Requires `x-adam/tr-citizen-number-validation` 5, which fixes the checksum bug for numbers
  with a negative intermediate sum.
- The rule class is renamed from `Rules\TrCitizenNumberRule` to `Rules\TrCitizenNumber` and
  implements `Illuminate\Contracts\Validation\ValidationRule` instead of the deprecated `Rule`.
- The service provider is renamed from `Providers\ValidationTrCitizenNumberExtendServiceProvider` to
  `TrCitizenNumberServiceProvider` at the package root.
- Translations move from `resources/lang` to `lang`, use the `tr-citizen-number` namespace and the
  `validation.tr_citizen_number` key.

### Fixed

- Non-scalar input (arrays, booleans, floats) now fails validation instead of throwing a `TypeError`.

### Added

- English translation alongside the Turkish one.
- Language files are publishable with `php artisan vendor:publish --tag=tr-citizen-number-translations`.
- Orchestra Testbench test suite and a GitHub Actions matrix across PHP 8.1–8.5 and Laravel 10–13,
  plus PHPStan (Larastan) at level max.
- MIT license file.

[Unreleased]: https://github.com/X-Laravel/validation-tr-citizen-number-extend/compare/1.x...2.x
