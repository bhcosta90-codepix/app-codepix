<?php

namespace Tests\Feature\Controller\Api;

use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PixKeyControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_pixkey()
    {
        $bank = $this->getBankLogin();
        $account = Account::factory([
            'bank_id' => $bank->id,
        ])->create();

        $response = $this->json('POST', '/api/pixkey/' . $account->uuid, [
            'kind' => 'random',
            'key' => $key = (string) str()->uuid(),
        ], [
            'Authorization' => "{$bank->credential}:{$bank->secret}",
        ]);

        $this->assertDatabaseHas('pix_keys', [
            'uuid' => $response->json('data.id'),
            'kind' => 'random',
            'key' => $key,
        ]);
    }
}
