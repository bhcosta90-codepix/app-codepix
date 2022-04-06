<?php

namespace Tests\Feature\Services;

use App\Models\Account;
use App\Services\PixKeyService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PixKeyServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_pixkey()
    {
        $objAccount = Account::factory()->create();
        $this->service()->newPixKey($objAccount, "cpf", "123456789");

        $this->assertDatabaseHas('pix_keys', [
            'kind' => 'cpf',
            'key' => '123456789',
            'account_id' => $objAccount->id,
        ]);
    }

    private function service(): PixKeyService
    {
        return app(PixKeyService::class);
    }
}
