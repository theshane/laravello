<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'is_blocked' => 'boolean'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
