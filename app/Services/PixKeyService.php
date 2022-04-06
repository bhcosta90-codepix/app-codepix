<?php

namespace App\Services;

use App\Models\{Account, PixKey};

final class PixKeyService
{
    use Traits\ValidateTrait;

    public function __construct(private PixKey $repository)
    {
        //
    }

    public function newPixKey(Account $account, string $kind, string $key)
    {
        $data = $this->validate([
            'kind' => $kind,
            'key' => $key,
            'account_id' => $account->id,
        ], PixKey::rulesCreated());

        return $this->repository->create($data);
    }

    public function get($id)
    {
        return $this->repository->where('id', $id)->first();
    }
}
