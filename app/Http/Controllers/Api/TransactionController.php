<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PixKeyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function store(string $kind, string $key, Request $request, PixKeyService $pixKeyService)
    {
        $objPix = $pixKeyService->validateExistPixKey($kind, $key);

        if (empty($objPix)) {
            throw ValidationException::withMessages([
                'pix' => __('Pix not found'),
            ]);
        }
    }
}
