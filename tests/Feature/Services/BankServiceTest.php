<?php

namespace Tests\Feature\Services;

use App\Services\BankService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BankServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_bank()
    {
        $this->service()->newBank('033', 'Teste bancário', (string) $secret = str()->uuid());

        $this->assertDatabaseHas('banks', [
            'name' => 'Teste bancário',
            'code' => '033',
            'secret' => sha1($secret),
        ]);
    }

    private function service(): BankService
    {
        return app(BankService::class);
    }
}
