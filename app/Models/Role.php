<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory, Notifiable;

    /**
     * Get the users
     */
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
