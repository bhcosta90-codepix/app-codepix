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
        $this->service()->newPixKey($objAccount, "random", $k = str()->uuid());

        $this->assertDatabaseHas('pix_keys', [
            'kind' => 'random',
            'key' => $k,
            'account_id' => $objAccount->id,
        ]);
    }

    private function service(): PixKeyService
    {
        return app(PixKeyService::class);
    }
}
