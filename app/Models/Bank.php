<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Bank extends Authenticatable
{
    use HasFactory, Traits\Uuid, Traits\ValidateEntity;

    public static function booted(): void
    {
        static::creating(function ($obj) {
            $obj->credential = $obj->credential ?: sha1(str()->uuid());
            $obj->secret = sha1($obj->secret);
        });
    }

    public $fillable = [
        'code',
        'name',
        'secret',
    ];

    public static function rulesCreated(): ?array
    {
        return self::rulesUpdated();
    }

    public static function rulesUpdated(): ?array
    {
        return [
            'code' => 'required|min:3|max:3',
            'name' => 'required|min:3|max:150',
            'secret' => 'required|between:36,40',
        ];
    }
}
