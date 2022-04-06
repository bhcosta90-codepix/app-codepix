<?php

namespace App\Services;

use App\Models\{Account, PixKey, Transaction};

final class TransactionService
{
    use Traits\ValidateTrait;

    const TRANSACTION_PENDING = 'pending';

    public function __construct(private Transaction $repository)
    {
        //
    }

    public function newTransaction(Account $account, PixKey $pixKey, float $amount, string $description = null)
    {
        $data = $this->validate([
            'amount' => $amount,
            'description' => $description,
            'account_from_id' => $account->id,
            'pix_key_id' => $pixKey->id,
            'description' => $description,
        ], Transaction::rulesCreated());

        return $this->repository->create($data);
    }
}
