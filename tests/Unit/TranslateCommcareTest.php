<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TranslateCommcareTest extends TestCase
{

    public function test_it_test_translation_options()
    {
        config(['app.locale' => 'en']);

        $this->assertEquals('optionEn', trans_commcare([
            'en' => 'optionEn',
            'ar' => 'optionAr'
        ]));
    }

    public function test_it_test_translation_has_default()
    {
        config(['app.locale' => 'en']);

        $this->assertEquals('DefaultTrans', trans_commcare([
            'ar' => 'optionAr'
        ],'DefaultTrans'));
    }

    public function test_it_test_locale_has_alias()
    {
        config(['app.locale' => 'ar']);

        config([
            'laravellocalization.supportedLocales.ar.alias' => 'ara'
        ]);

        $this->assertEquals('optionAra', trans_commcare([
            'ara' => 'optionAra'
        ],'DefaultTrans'));
    }

    public function test_it_supports_fallback_locale()
    {
        config(['app.locale' => 'ar']);

        $this->assertEquals('optionFallback', trans_commcare([
            'en' => 'optionFallback'
        ],'DefaultTrans'));
    }
}
