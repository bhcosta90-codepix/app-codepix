<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PixKey extends Model
{
    use HasFactory, Traits\Uuid, Traits\ValidateEntity;

    public static function rulesCreated(array $data = []): ?array
    {
        return self::rulesUpdated($data);
    }

    public static function rulesUpdated(array $data = []): ?array
    {
        if (!empty($data['kind']) && !empty($data['key'])) {
            if (DB::table('pix_keys')->select()->where('kind', $data['kind'])->where('key', $data['key'])->count()) {
                throw ValidationException::withMessages([
                    'key' => _('This key cannot be registered'),
                ]);
            }
        }

        $ret = [
            'kind' => 'required|in:' . implode(',', PixKey::KINDS),
            'key' => ['required', 'min:3', 'max:150'],
            'account_id' => 'required|exists:accounts,id'
        ];

        match($data['kind'] ?? null) {
            'random' => $ret['key'][] = 'uuid',
            'cpf' => $ret['key'][] = 'cpf',
            'email' => $ret['key'][] = 'email',
            default => null,
        };

        return $ret;
    }

    const KINDS = ['email', 'cpf', 'random'];

    public $fillable = [
        'account_id',
        'kind',
        'key'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
