<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'body',
        'writer',
        'recipient',
    ];

    /**
     * Get the writer associated with the message.
     */
    public function getWriter()
    {
        return $this->belongsTo(User::class, 'writer');
    }

    /**
     * Get the recipient associated with the message.
     */
    public function getRecipient()
    {
        return $this->belongsTo(User::class, 'recipient');
    }

}
