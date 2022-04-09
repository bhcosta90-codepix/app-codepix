<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Bank;
use App\Models\PixKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $bank = Bank::factory([
            'uuid' => 'ab25989f-9486-4863-b657-aa1f8732620f',
            'credential' => 'a1abd599d3a367dbce524ad3af622429da632b19',
            'secret' => "153e62529a558a0d7cdadecabd0c4e799f32ad78",
        ])->create();

        $account = Account::factory([
            'uuid' => 'a1629637-c5e9-4a83-bd07-454b6c0a1e6b',
            'bank_id' => $bank->id,
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => 'e2989ccf-eb1b-4766-a5f7-697af0236595',
            'kind' => 'random',
            'key' => 'cba4da01-a262-425c-a2d2-457319e8a666'
        ]);

        $account = Account::factory([
            'uuid' => '58234d11-78f1-45c2-ad40-7c255390b818',
            'bank_id' => $bank->id,
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => '064df7c3-c86e-4d05-a630-fb732698209e',
            'kind' => 'random',
            'key' => 'e0ab5f25-34a6-4c2d-89d7-a0f0ba52c0f0'
        ]);
    }
}
