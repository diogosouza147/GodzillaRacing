<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'model',
        'brand',
        'color',
        'owner_name',
        'owner_phone',
        'discord_id',
        'payment_status',
        'payment_value',
        'notes',
    ];

    protected $casts = [
        'payment_value' => 'decimal:2',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withPivot(['payment_status', 'payment_value'])
            ->withTimestamps();
    }

    public function isPago(): bool
    {
        return $this->payment_status === 'pago';
    }
}
