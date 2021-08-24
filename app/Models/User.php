<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id','department',
    ];

    protected $appends = [
        'post_count'
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

    public function posts(){                             // create post
        return $this->hasMany(Post::class,'user_id');
    }

    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function postcomments(){
        return $this->belongsToMany(Post::class,'post_user')->withPivot(['comment'])->withTimestamps();
    }

    public function getPostCountAttribute(){
        return $this->posts()->count();
    }
}
