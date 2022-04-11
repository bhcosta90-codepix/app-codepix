<?php

namespace App\Console\Commands\Transaction;

use App\Services\TransactionService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TransactionCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:completed';

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
        app('pubsub')->consume('queue_codepix_completed', [
            'transaction_completed'
        ], function ($data) use ($transactionService) {
            DB::beginTransaction();
            try {
                $obj = $transactionService->transactionCompleted($data['transaction_id']);
                $obj->increment('total_sync', 1);
                $obj->save();

                if ($obj->total_sync == 2) {
                    app('pubsub')->publish(['transaction.completed.' . $obj->account_from->bank->credential], ['uuid' => $data['external_id']] + $data);
                    app('pubsub')->publish(['transaction.completed.' . $obj->pixKey->account->bank->credential], ['uuid' => $data['internal_id']] + $data);
                }

                DB::commit();
                sleep(1);
            } catch(Exception $e) {
                DB::rollBack();
                throw $e;
            }
        });
    }
}
