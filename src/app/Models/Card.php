<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    
    
    protected $fillable = [
        'title',
        'description',
        'status',
        'order',
        'board_id',
        'assigned_user_id',
    ];


    protected $casts = [
        'order' => 'integer',
    ];

    protected $dates  = [
        'due_date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_user_id', 'id');
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }
}


