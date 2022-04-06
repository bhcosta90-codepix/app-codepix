<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory, Traits\Uuid, Traits\ValidateEntity;

    public $fillable = [
        'code',
        'name',
    ];

    public static function rulesCreated(): ?array
    {
        return self::rulesUpdated();
    }

    public static function rulesUpdated(): ?array
    {
        return [
            'code' => 'required|min:3|max:3',
            'name' => 'required|min:3|max:150'
        ];
    }
}
