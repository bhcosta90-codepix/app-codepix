<?php

namespace Tests\Feature\Services;

use App\Models\Bank;
use App\Services\AccountService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AccountServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_account()
    {
        $objBank = Bank::factory()->create();
        $this->service()->newAccount($objBank, "teste de conta", "123456789");

        $this->assertDatabaseHas('accounts', [
            'bank_id' => $objBank->id,
            'name' => 'teste de conta',
            'number' => '123456789',
        ]);
    }

    private function service(): AccountService
    {
        return app(AccountService::class);
    }
}
