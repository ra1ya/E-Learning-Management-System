<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{   
    protected $table = 'result'; 
    protected $primaryKey = 'id';
    protected $fillable = ['student_id', 'course_id', 'MonthlyTestone','MonthlyTestwo','final','homeworkone','homeworktwo','total_marks'];

    
    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id'); 
    }

    
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
