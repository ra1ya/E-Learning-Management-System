<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testanswer extends Model
{
    protected $table='testanswer';
    protected $primaryKey= 'id';
    protected $fillable = ['test_id', 'student_id', 'testques_id', 'answer', 'is_correct','total_marks','type'];

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function testques()
    {
        return $this->belongsTo(Testques::class,'testques_id')->withDefault([
            'marks' => 0,
            'text' => 'غير معروف',
        ]);;
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student_id');
    }
    public function results()
    {
        return $this->hasMany(Result::class, 'testanswer_id');
    }
    public function question()
    {
        return $this->belongsTo(Question::class,'question_id')->withDefault([
            'marks' => 0,
            'text' => 'غير معروف',
        ]);;
    }
    
    public function courses()
{
    return $this->belongsTo(Courses::class, 'course_id');
}
}
