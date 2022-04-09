<?php

namespace Tests\Feature\Services;

use App\Models\{Account, PixKey};
use App\Services\TransactionService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
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
            'account_from_id' => $objAccount->id,
            'pix_key_id' => $objPix->id,
            'status' => 'pending'
        ]);
    }

    public function test_generate_two_pix_and_transfer_between_theirs() {
        $objAccount = Account::factory()->create();
        $objPix = PixKey::factory()->create();

        $objAccount1 = Account::factory()->create();
        $objPix2 = PixKey::factory()->create();

        $this->service()->newTransaction($objAccount, $objPix2, 50, 'teste');
        $this->service()->newTransaction($objAccount1, $objPix, 30, 'teste');

        $this->assertDatabaseHas('transactions', [
            'amount' => 50,
            'account_from_id' => $objAccount->id,
            'pix_key_id' => $objPix2->id,
            'status' => 'pending'
        ]);

        $this->assertDatabaseHas('transactions', [
            'amount' => 30,
            'account_from_id' => $objAccount1->id,
            'pix_key_id' => $objPix->id,
            'status' => 'pending'
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

    private function uuid()
    {
        return (string) str()->uuid();
    }
}
