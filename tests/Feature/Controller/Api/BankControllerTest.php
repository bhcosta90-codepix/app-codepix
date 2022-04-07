<?php

namespace Tests\Feature\Controller\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BankControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_bank()
    {
        $response = $this->json('POST', '/api/bank', [
            'code' => '033',
            'name' => 'santander'
        ]);

        $this->assertDatabaseHas('banks', [
            'uuid' => $response->json('data.id'),
            'credential' => $response->json('data.credential'),
            'secret' => sha1($response->json('data.secret')),
        ]);
    }
}
