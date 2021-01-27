<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = [
      'name'
    ];

    public function rooms()
    {
      return $this->hasMany(Room::class);
    }
}
