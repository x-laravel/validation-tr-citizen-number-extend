<?php

namespace XLaravel\ValidationTrCitizenNumberExtend\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use XLaravel\ValidationTrCitizenNumberExtend\Rules\TrCitizenNumber;

class ValidationTrCitizenNumberExtendServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'tr-citizen-number');

        $this->publishes([
            __DIR__ . '/../../lang' => $this->app->langPath('vendor/tr-citizen-number'),
        ], 'tr-citizen-number-lang');

        Validator::extend('tr_citizen_number', fn (string $attribute, mixed $value) => TrCitizenNumber::passes($value));
    }
}
