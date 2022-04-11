<?php

namespace App\Console\Commands\Transaction;

use App\Services\TransactionService;
use Illuminate\Console\Command;

class TransactionConfirmed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:confirmed';

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
        app('pubsub')->consume('queue_codepix_confirmed', [
            'transaction.confirmed'
        ], function ($data) use ($transactionService) {
            $obj = $transactionService->transactionConfirmed($data['external_id']);
            app('pubsub')->publish(['transaction.confirmed.' . $obj->account_from->bank->credential], $data);
        });
    }
}
