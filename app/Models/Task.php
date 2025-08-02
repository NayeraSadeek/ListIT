<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
   use HasFactory;
   protected $fillable=[
    'user_id',
    'title',
    'description',
    'due_date',
    'completed_at',
    'category_id'

   ] ;
   protected $casts=[
    'due_date'=>'datetime',
    'completed_at'=>'datetime',
   ];
   public function user()
   {
    return $this->belongsTo(User::class);
   }

   public function category()
   {
    return $this->belongsTo(Category::class);
   }
}
