<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'vat',
        'address',
        'city',
        'province',
        'is_active',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class);
    }
}
