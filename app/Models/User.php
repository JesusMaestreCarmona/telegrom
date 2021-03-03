<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'address',
        'phone_number',
        'img',
        'gender_id',
        'blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the written messages.
     */
    public function writtenMessages()
    {
        return $this->hasMany(Message::class, 'writer')->orderBy('created_at', 'desc');
    }

    /**
     * Get the received messages.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient')->orderBy('created_at', 'desc');
    }

    /**
     * Get the contacts.
     */
    public function contacts()
    {
        return $this->belongsToMany(User::class, 'contacts', 'user', 'contact')->whereConfirmed(true)->orderBy('last_name');
    }

    /**
     * Get the contacts.
     */
    public function contactRequests()
    {
        return $this->belongsToMany(User::class, 'contacts', 'contact', 'user')->whereConfirmed(false)->orderBy('last_name');
    }

    /**
     * Get the gender.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Get the roles.
     */
    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Get the reports from an user.
     */
    public function receivedReports() {
        return $this->belongsToMany(User::class, 'reports', 'reported', 'user');
    }

    /**
     * Get the reports from an user.
     */
    public function sentReports() {
        return $this->belongsToMany(User::class, 'reports', 'user', 'reported');
    }

}
