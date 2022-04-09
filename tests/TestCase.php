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
            'secret' => "5066195abbff72cd7d1c6d863140f51ca8ee3df7",
        ])->create();
    }
}
