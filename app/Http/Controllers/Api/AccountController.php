<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Models\Bank;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function store(Request $request, AccountService $accountService)
    {
        /** @var Bank */
        $bank = auth()->user();

        $obj = $accountService->newAccount($bank, $request->name, $request->number);
        return (new AccountResource($obj));
    }
}
