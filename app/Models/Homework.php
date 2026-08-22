<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
  
    protected $table='homeworks';
    protected $primaryKey= 'id';
    protected $fillable = ['title','course_id','description','deadline'];
    use HasFactory;

    

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id')->withDefault([
            'name' => 'No Course Assigned',
        ]);
    }
    

  
   public function question()
   {
       return $this->hasMany(Question::class, 'homework_id');
   }
   


   public function studentAnswer()
   {
       return $this->hasMany(StudentAnswer::class);
   }
   
   public function results()
   {
       return $this->morphMany(Result::class, 'activity');
   }
   
}
