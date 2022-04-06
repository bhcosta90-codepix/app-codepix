<?php

namespace App\Services;

use App\Models\Bank;

final class BankService
{
    use Traits\ValidateTrait;

    public function __construct(private Bank $repository)
    {
        //
    }

    public function newBank(string $code, string $name)
    {
        $data = $this->validate([
            'code' => $code,
            'name' => $name,
        ], Bank::rulesCreated());

        return $this->repository->create($data);
    }
}
