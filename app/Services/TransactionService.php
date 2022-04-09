<?php

namespace App\Services;

use App\Models\{Account, PixKey, Transaction};

final class TransactionService
{
    use Traits\ValidateTrait;

    const TRANSACTION_PENDING = 'pending';
    const TRANSACTION_CONFIRMED = 'confirmed';
    const TRANSACTION_APPROVED = 'approved';

    public function __construct(private Transaction $repository)
    {
        //
    }

    public function newTransaction(Account $account = null, PixKey $pixKey = null, float $amount = null, string $description = null)
    {
        $data = [
            'amount' => $amount,
            'description' => $description,
            'account_from_id' => $account->id,
            'pix_key_id' => $pixKey->id,
            'description' => $description,
        ];

        $ret = $this->repository->create($data);
        $ret->refresh();

        $data = $ret->toArray();

        $data['pix_key'] += [
            'account' => $ret->account_from->toArray(),
        ];

        app('pubsub')->publish(['new_transaction.' . $pixKey->account->bank->credential . '.confirmed'], [
            'status' => TransactionService::TRANSACTION_CONFIRMED,
            'moviment' => 'credit',
        ] + $data);

        return $ret;
    }

    public function transactionConfirmed(string $uuid)
    {
        $obj = $this->find($uuid);
        $obj->status = self::TRANSACTION_CONFIRMED;
        $obj->save();

        $data = [
            'uuid' => $uuid
        ];

        app('pubsub')->publish(['confirm_transaction.' . $obj->account_from->bank->credential . '.confirmed'], $data);
    }

    public function transactionApprroved(string $uuid)
    {
        $obj = $this->find($uuid);
        $obj->status = self::TRANSACTION_APPROVED;
        $obj->save();

        $data = [
            'uuid' => $uuid
        ];

        app('pubsub')->publish(['approved_transaction'], $data);
    }

    public function find(string $uuid)
    {
        return $this->repository->where('uuid', $uuid)->firstOrFail();
    }
}
