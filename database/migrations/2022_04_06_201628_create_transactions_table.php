<?php

use App\Services\TransactionService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('account_from_id')->constrained('accounts');
            $table->foreignId('pix_key_id')->constrained('pix_keys');
            $table->unsignedDouble('amount');
            $table->string('status')->default(TransactionService::TRANSACTION_PENDING);
            $table->string('description')->nullable();
            $table->string('cancel_description')->nullable();
            $table->tinyInteger('total_sync')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
