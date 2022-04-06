<?php

namespace Tests\Feature\Services;

use App\Models\{Account, PixKey};
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_transaction_with_account_different()
    {
        $objAccount = Account::factory()->create();
        $objPix = PixKey::factory()->create();

        $this->service()->newTransaction($objAccount, $objPix, 50, 'teste');

        $this->assertDatabaseHas('transactions', [
            'amount' => 50,
        ]);
    }

    public function test_new_transaction_same_account()
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('Você não pode transferir para a mesma conta bancária');

        $objAccount = Account::factory()->create();
        $objPix = PixKey::factory([
            'account_id' => $objAccount->id
        ])->create();

        $this->service()->newTransaction($objAccount, $objPix, 50, 'teste');
    }

    private function service(): TransactionService
    {
        return app(TransactionService::class);
    }
}
