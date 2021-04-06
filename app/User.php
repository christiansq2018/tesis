<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'nombre',
    'tipo_documento',
    'num_documento',
    'direccion',
    'telefono',
    'email',
    'usuario',
    'password',
    'condicion',
    'role_id',
    'imagen'
  ];

  protected $appends = [
    'avatar'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function rol()
  {

    return $this->belongsTo('App\Rol');
  }

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function getAvatarAttribute()
  {
    return $this->imagen ? asset("storage/img/usuario/$this->imagen") : asset('img/avatars/7.jpg');
  }

  public function getFrontendNotificationsAttribute(){
    $notifications = auth()->user()->notifications()->where('created_at', '>', now()->startOfMonth() )->get();
    return [
      'data'  => $notifications,
      'total' => $notifications->count(),
      'total_unread' => $notifications->where('read_at', null)->count()
    ];
  }
}
