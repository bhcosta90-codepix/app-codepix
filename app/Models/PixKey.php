<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PixKey extends Model
{
    use HasFactory, Traits\Uuid, Traits\ValidateEntity;

    public static function rulesCreated(): ?array
    {
        return self::rulesUpdated();
    }

    public static function rulesUpdated(): ?array
    {
        return [
            'kind' => 'required|in:' . implode(',', PixKey::KINDS),
            'key' => 'required|min:3|max:150',
            'account_id' => 'required|exists:accounts,id'
        ];
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
