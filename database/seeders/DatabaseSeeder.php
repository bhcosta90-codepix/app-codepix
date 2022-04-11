<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Bank;
use App\Models\PixKey;
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
            'number' => str_pad('1', 6, '0', STR_PAD_LEFT),
            'bank_id' => $bank->id,
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => 'e2989ccf-eb1b-4766-a5f7-697af0236595',
            'kind' => 'random',
            'key' => 'cba4da01-a262-425c-a2d2-457319e8a666'
        ])->create();

        $account = Account::factory([
            'uuid' => '58234d11-78f1-45c2-ad40-7c255390b818',
            'number' => str_pad('2', 6, '0', STR_PAD_LEFT),
            'bank_id' => $bank->id,
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => '064df7c3-c86e-4d05-a630-fb732698209e',
            'kind' => 'random',
            'key' => 'e0ab5f25-34a6-4c2d-89d7-a0f0ba52c0f0'
        ])->create();

        /** Novo dados bancários */
        $bank = Bank::factory([
            'uuid' => '17a21b59-5a83-498b-8256-219693099a38',
            'credential' => 'ef8e3bfa3d4e2af40c519487f19451f19d09f0a3',
            'secret' => "3ec00ea2de51076baf306b5e45168fdf9497eb96",
        ])->create();

        $account = Account::factory([
            'uuid' => '013903b5-a12c-4981-8fe0-60d37758b359',
            'bank_id' => $bank->id,
            'number' => str_pad('1', 6, '0', STR_PAD_LEFT),
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => 'db4af86e-35e8-4a07-9072-037b5717aa08',
            'kind' => 'random',
            'key' => 'bd07b339-a05f-408f-9640-c461c29cb243'
        ])->create();

        $account = Account::factory([
            'uuid' => '50809e5f-22dc-41e7-b95e-25e764bae71a',
            'bank_id' => $bank->id,
            'number' => str_pad('2', 6, '0', STR_PAD_LEFT),
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => 'ca0c47d4-5d54-4889-ad54-5bd34ab65327',
            'kind' => 'random',
            'key' => '33047865-fbb2-4a3e-a14d-4287f7abfd37'
        ])->create();

        /** Novo dados bancários */
        $bank = Bank::factory([
            'uuid' => '924048b6-72a5-4ae9-89d3-31fe9f08eee0',
            'credential' => '317a4c568c2d5eb5290195dcf5ceffcb8850bf5b',
            'secret' => "3832470a3e77c259dff01b455a3f3d918ae9d487",
        ])->create();

        $account = Account::factory([
            'uuid' => 'f3db6eb0-0983-472e-911d-714b0b7d03db',
            'bank_id' => $bank->id,
            'number' => str_pad('1', 6, '0', STR_PAD_LEFT),
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => '147e0759-4b99-4bd8-a941-d0b5d1ce2a45',
            'kind' => 'random',
            'key' => '49806ffe-c8c0-4a73-9083-18b6e94a408e'
        ])->create();

        $account = Account::factory([
            'uuid' => 'becb8df8-d12c-49d1-ba29-acc2e66ba372',
            'bank_id' => $bank->id,
            'number' => str_pad('2', 6, '0', STR_PAD_LEFT),
        ])->create();

        PixKey::factory([
            'account_id' => $account->id,
            'uuid' => '7dc0789d-c0ab-465a-b281-0f01cf858ce7',
            'kind' => 'random',
            'key' => '60bcbdfa-03ce-406a-9686-6a3d018a692c'
        ])->create();
    }
}
