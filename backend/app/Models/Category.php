<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
class Category extends Model
{
   use HasFactory;
   protected $fillable=[
    'name',
    'description',
    'image'
   ];


  public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
