<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function tasks()
  {
    return $this->hasMany(Task::class);
  }

  public function getImagePathAttribute()
  {
    return !is_null($this->image)
      ? asset('storage/' . $this->image)
      : null;
  }
}
