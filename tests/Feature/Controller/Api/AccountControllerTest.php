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
            'Authorization' => "Bearer {$bank->credential}:5066195abbff72cd7d1c6d863140f51ca8ee3df7",
        ]);

        $this->assertDatabaseHas('accounts', [
            'uuid' => $response->json('data.id'),
            'name' => 'teste de conta',
            'number' => '123456789',
        ]);
    }
}
