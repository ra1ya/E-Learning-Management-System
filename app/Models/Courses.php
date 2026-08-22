<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table='courses';
    protected $primaryKey= 'id';
    protected $fillable = ['name','syllabus','duration', 'video_link', 'pdf_file'];
   
    use HasFactory;

    public function duration(){
        return $this->duration."Months";
       } 
      
       public function students()
    {
        return $this->belongsToMany(Students::class, 'student_course', 'course_id', 'student_id');
    }
       
       public function tests()
    {
        return $this->hasMany(Test::class, 'course_id');
    }

    public function homeworks()
    {
        return $this->hasMany(Homework::class, 'course_id');
    }
    public function results()
    {
        return $this->hasMany(Result::class, 'course_id');
    }

}
