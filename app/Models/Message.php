<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'rt', 'rw', 'email', 'message', 'attachments', 'raw',
        'answered_at', 'user_id', 'answer', 'answer_attachments'
    ];

    protected $casts = [
        'answered_at' => 'datetime',
        'answer_attachments' => 'array',
        'attachments' => 'array',
        'raw' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answered() : bool
    {
        return !is_null($this->answered_at);
    }
}
