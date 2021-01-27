<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = [
      'hotel_id',
      'name',
      'numberBeds',
      'description'
    ];

    public function hotel()
    {
      return $this->belongsTo(Hotel::class);
    }

    public function userRoom()
    {
      return $this->hasMany(UserRoom::class);
    }
}
