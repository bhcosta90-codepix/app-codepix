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

    public function newBank(string $code = null, string $name = null, string $secret = null)
    {
        $data = [
            'code' => $code,
            'name' => $name,
            'secret' => $secret,
        ];

        return $this->repository->create($data);
    }
}
