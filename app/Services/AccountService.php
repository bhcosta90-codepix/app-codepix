<?php

namespace App\Services;

use App\Models\{Account, Bank};

final class AccountService
{
    use Traits\ValidateTrait;

    public function __construct(private Account $repository)
    {
        //
    }

    public function newAccount(Bank $bank, string $name, string $number)
    {
        $data = $this->validate([
            'name' => $name,
            'number' => $number,
            'bank_id' => $bank->id,
        ], Account::rulesCreated());

        return $this->repository->create($data);
    }

    public function find(string $uuid)
    {
        return $this->repository->where('uuid', $uuid)->first();
    }
}
