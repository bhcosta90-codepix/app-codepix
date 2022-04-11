<?php

namespace App\Console\Commands\Transaction;

use App\Services\TransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TransactionApproved extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:approved';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TransactionService $transactionService)
    {
        app('pubsub')->consume('queue_transaction_approved', [
            'transaction_approved'
        ], function ($data) use ($transactionService) {
            $obj = $transactionService->transactionApprroved($data['transaction_id']);

            app('pubsub')->publish(['transaction.approved.' . $obj->account_from->bank->credential], ['uuid' => $data['external_id']]);
            app('pubsub')->publish(['transaction.approved.' . $obj->pixKey->account->bank->credential], ['uuid' => $data['internal_id']]);
        });
    }
}
