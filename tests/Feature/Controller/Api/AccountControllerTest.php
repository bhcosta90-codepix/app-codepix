<?php

namespace Tests\Feature\Controller\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_account()
    {
        $bank = $this->getBankLogin();

        $response = $this->json('POST', '/api/account', [
            'name' => 'teste de conta',
            'number' => '123456789',
        ], [
            'Authorization' => "{$bank->credential}:{$bank->secret}",
        ]);

        $this->assertDatabaseHas('accounts', [
            'uuid' => $response->json('data.id'),
            'name' => 'teste de conta',
            'number' => '123456789',
        ]);
    }
}
