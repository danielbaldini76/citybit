<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'code',
        'zone',
        'location',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}
