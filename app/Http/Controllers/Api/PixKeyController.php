<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PixKeyResource;
use App\Http\Resources\PixKeyValidatedResource;
use App\Services\AccountService;
use App\Services\PixKeyService;
use Illuminate\Http\Request;

class PixKeyController extends Controller
{
    public function store(Request $request, PixKeyService $pixKeyService, AccountService $accountService, string $account)
    {
        $objAccount = $accountService->find($account);
        $obj = $pixKeyService->newPixKey($objAccount, $request->kind, $request->key);

        return new PixKeyResource($obj);
    }

    public function exists($kind, $key, PixKeyService $pixKeyService)
    {
        $rs = $pixKeyService->validateExistPixKey($kind, $key);
        return new PixKeyValidatedResource($rs);
    }
}
