<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, Traits\Uuid, Traits\ValidateEntity;

    public $fillable = [
        'bank_id',
        'name',
        'number',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public static function rulesCreated(): ?array
    {
        return self::rulesUpdated();
    }

    public static function rulesUpdated(): ?array
    {
        return [
            'name' => 'required|min:3|max:120',
            'number' => 'required|min:6|max:50',
            'bank_id' => 'required|exists:banks,id'
        ];
    }

    public function pixKeys()
    {
        return $this->hasMany(PixKey::class);
    }
}
