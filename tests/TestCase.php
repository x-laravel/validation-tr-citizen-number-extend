<?php

namespace XLaravel\ValidationTrCitizenNumberExtend\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use XLaravel\ValidationTrCitizenNumberExtend\Providers\ValidationTrCitizenNumberExtendServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [ValidationTrCitizenNumberExtendServiceProvider::class];
    }
}
