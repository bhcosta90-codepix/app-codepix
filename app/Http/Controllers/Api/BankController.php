<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BankResource;
use App\Services\BankService;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function store(Request $request, BankService $bankService) {
        $obj = $bankService->newBank($request->code, $request->name, $secret = sha1((string) str()->uuid()));
        return (new BankResource($obj))->additional(['data' => ['secret' => $secret]]);
    }
}
