<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'image',
    'provider',
    'provider_id',
    'password',
    'role_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'deleted_at',
    'created_at',
    'updated_at'
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
  }

  public function role()
  {
    return $this->belongsTo(Role::class, 'role_id');
  }

  public function assignedRoom()
  {
    return $this->hasOne(UserRoom::class, 'user_id');
  }
}
