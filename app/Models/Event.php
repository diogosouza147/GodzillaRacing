<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'event_date',
        'location',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class)
            ->withPivot(['payment_status', 'payment_value'])
            ->withTimestamps();
    }
}
