<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Services\AccountService;
use App\Services\PixKeyService;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function store(
        string $kind,
        string $key,
        Request $request,
        PixKeyService $pixKeyService,
        TransactionService $transactionService,
        AccountService $accountService
    ) {
        $objPix = $pixKeyService->validateExistPixKey($kind, $key);

        if (empty($objPix)) {
            throw ValidationException::withMessages([
                'pix' => __('Pix not found'),
            ]);
        }

        $objAccount = $accountService->find($request->account);

        $obj = $transactionService->newTransaction($objAccount, $objPix, $request->amount, $request->description);

        return new TransactionResource($obj);
    }
}
