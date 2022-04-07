<?php

namespace Tests;

use App\Models\Bank;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getBankLogin()
    {
        return Bank::factory([
            'secret' => "4484cd7b070bd7a6fbeb1306adef31c004a98aff",
        ])->create();
    }
}
