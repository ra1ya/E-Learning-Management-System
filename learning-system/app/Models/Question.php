<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='question';
    protected $primaryKey= 'id';
    protected $fillable = ['homework_id', 'text', 'type', 'options','correct_answers','marks'];
    use HasFactory;
    public function homework()
    {
        return $this->belongsTo(Homework::class,'homework_id');
    }
    public function studentAnswer()
{
    return $this->hasMany(StudentAnswer::class);
}
public function marks()
{
    return $this->marks;
}

}
