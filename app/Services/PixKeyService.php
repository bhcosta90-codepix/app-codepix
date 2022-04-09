<?php

namespace App\Services;

use App\Models\{Account, PixKey};
use Illuminate\Support\Facades\Cache;

final class PixKeyService
{
    use Traits\ValidateTrait;

    const CACHE_PIX_KEY = 'v1';

    public function __construct(private PixKey $repository)
    {
        //
    }

    public function newPixKey(Account $account, string $kind = null, string $key = null)
    {
        $data = [
            'kind' => $kind,
            'key' => $key,
            'account_id' => $account->id,
        ];

        return $this->repository->create($data);
    }

    public function validateExistPixKey(string $kind, string $key)
    {
        return $this->repository->where('kind', $kind)->where('key', $key)->first();
    }

    public function get($id)
    {
        return $this->repository->where('id', $id)->firstOrFail();
    }
}
