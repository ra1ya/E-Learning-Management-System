<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $table='studentanswer';
    protected $primaryKey= 'id';
    protected $fillable = ['homework_id', 'student_id', 'question_id', 'answer', 'is_correct','total_marks'];

    public function homework()
    {
        return $this->belongsTo(Homework::class, 'homework_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class,'question_id')->withDefault([
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
        return $this->hasMany(Result::class, 'studentanswer_id');
    }
}

