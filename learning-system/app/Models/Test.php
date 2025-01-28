<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    
    protected $table='test';
    protected $primaryKey= 'id';
    protected $fillable = ['title','course_id','description','deadline','type','marks'];
    use HasFactory;

   


   public function courses(){
    return $this->belongsTo(Courses::class ,'course_id');
   }

   // في نموذج Homework
   public function testques()
   {
       return $this->hasMany(Testques::class, 'test_id');
   }
   
   public function results()
{
    return $this->morphMany(Result::class, 'activity');
}



   public function testanswer()
   {
       return $this->hasMany(Testanswer::class);
   }
}
