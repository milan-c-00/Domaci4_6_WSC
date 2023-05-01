<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friendsTo(){
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function friendsFrom(){
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    public function friendRequestsTo(){
        return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id');
    }

    public function friendRequestsFrom(){
        return $this->belongsToMany(User::class, 'friend_requests', 'receiver_id', 'sender_id');
    }

    public function sentMessages(User $friend){
        return $this->hasMany(Message::class, 'sender_id')->where('receiver_id', $friend->id)->get();
    }

    public function receivedMessages(User $friend){
        return $this->hasMany(Message::class, 'receiver_id')->where('sender_id', $friend->id)->get();
    }


}
