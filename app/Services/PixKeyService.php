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
        $data = $this->validate($d = [
            'kind' => $kind,
            'key' => $key,
            'account_id' => $account->id,
        ], PixKey::rulesCreated($d));

        return $this->repository->create($data);
    }

    public function validateExistPixKey(string $kind, string $key)
    {
        return Cache::remember(self::CACHE_PIX_KEY . "{$kind}{$key}", 30, fn() => $this->repository->where('kind', $kind)->where('key', $key)->firstOrFail());
    }

    public function get($id)
    {
        return $this->repository->where('id', $id)->firstOrFail();
    }
}
