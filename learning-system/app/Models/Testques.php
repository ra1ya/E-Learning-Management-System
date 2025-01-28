<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testques extends Model
{
    protected $table='testques';
    protected $primaryKey= 'id';
    protected $fillable = ['test_id', 'text', 'type', 'options','correct_answers','marks'];
    use HasFactory;
    public function test()
    {
        return $this->belongsTo(Test::class,'test_id');
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
