<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = [
      'room_id',
      'user_id'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function room()
    {
      return $this->belongsTo(Room::class);
    }
}
