<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    protected $hidden = [
        "created_by",
    ];

    public function cards() {
        return $this->hasMany(Card::class);
    }

    public function created_by() {
        return $this->belongsTo(User::class, "created_by","id");
    }
}
