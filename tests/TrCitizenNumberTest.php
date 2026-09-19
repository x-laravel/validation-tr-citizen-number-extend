<?php

namespace XLaravel\ValidationTrCitizenNumberExtend\Tests;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use XLaravel\ValidationTrCitizenNumberExtend\Rules\TrCitizenNumber;

class TrCitizenNumberTest extends TestCase
{
    #[DataProvider('validValues')]
    public function testRuleObjectAcceptsValidNumbers(int|string $value): void
    {
        $validator = Validator::make(['citizen_no' => $value], ['citizen_no' => new TrCitizenNumber]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidValues')]
    public function testRuleObjectRejectsInvalidValues(mixed $value): void
    {
        $validator = Validator::make(['citizen_no' => $value], ['citizen_no' => new TrCitizenNumber]);

        $this->assertTrue($validator->fails());
    }

    public function testRuleObjectMessageIsTranslatedInEnglish(): void
    {
        $validator = Validator::make(['citizen_no' => '12345678901'], ['citizen_no' => new TrCitizenNumber]);

        $this->assertSame(
            'The citizen no field must be a valid Turkish citizen number.',
            $validator->errors()->first('citizen_no'),
        );
    }

    public function testRuleObjectMessageIsTranslatedInTurkish(): void
    {
        App::setLocale('tr');

        $validator = Validator::make(['citizen_no' => '12345678901'], ['citizen_no' => new TrCitizenNumber]);

        $this->assertSame(
            'citizen no geçerli bir T.C. kimlik numarası olmalıdır.',
            $validator->errors()->first('citizen_no'),
        );
    }

    #[DataProvider('validValues')]
    public function testStringAliasAcceptsValidNumbers(int|string $value): void
    {
        $validator = Validator::make(['citizen_no' => $value], ['citizen_no' => 'tr_citizen_number']);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidValues')]
    public function testStringAliasRejectsInvalidValues(mixed $value): void
    {
        $validator = Validator::make(['citizen_no' => $value], ['citizen_no' => 'tr_citizen_number']);

        $this->assertTrue($validator->fails());
    }

    public function testStringAliasUsesInlineMessage(): void
    {
        $validator = Validator::make(
            ['citizen_no' => '12345678901'],
            ['citizen_no' => 'tr_citizen_number'],
            ['citizen_no.tr_citizen_number' => 'Custom message for :attribute'],
        );

        $this->assertSame('Custom message for citizen no', $validator->errors()->first('citizen_no'));
    }

    public function testStringAliasFallsBackToTranslationKeyWithoutAppMessage(): void
    {
        $validator = Validator::make(['citizen_no' => '12345678901'], ['citizen_no' => 'tr_citizen_number']);

        $this->assertSame('validation.tr_citizen_number', $validator->errors()->first('citizen_no'));
    }

    public function testStringAliasSkipsNullableEmptyValues(): void
    {
        $validator = Validator::make(['citizen_no' => null], ['citizen_no' => ['nullable', 'tr_citizen_number']]);

        $this->assertTrue($validator->passes());
    }

    /** @return array<string, array{int|string}> */
    public static function validValues(): array
    {
        return [
            'string' => ['10000000146'],
            'integer' => [10000000146],
            'negative intermediate checksum' => ['17092819052'],
        ];
    }

    /** @return array<string, array{mixed}> */
    public static function invalidValues(): array
    {
        return [
            'wrong checksum' => ['12345678901'],
            'too short' => ['1000000014'],
            'letters' => ['abcdefghijk'],
            'array' => [['10000000146']],
            'boolean' => [true],
            'float' => [10000000146.0],
        ];
    }
}
