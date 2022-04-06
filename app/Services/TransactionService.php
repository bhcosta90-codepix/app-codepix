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

    public function newTransaction(string $uuid, Account $account, PixKey $pixKey, float $amount, string $description = null)
    {
        $data = $this->validate([
            'uuid' => $uuid,
            'amount' => $amount,
            'description' => $description,
            'account_from_id' => $account->id,
            'pix_key_id' => $pixKey->id,
            'description' => $description,
        ], Transaction::rulesCreated());

        $ret = $this->repository->create($data);

        $data = [
            'uuid' => $ret->uuid
        ];

        app('pubsub')->publish(['new_transaction.' . $account->bank->uuid . '.confirmed'], $data);
        app('pubsub')->publish(['new_transaction.' . $pixKey->account->bank->uuid . '.confirmed'], $data);
    }
}
