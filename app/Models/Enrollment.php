<?php

namespace App\Models;

use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table='enrollment';
    protected $primaryKey= 'id';
    protected $fillable = ['enroll_no','batch_id','student_id','join_date','fee'];
    use HasFactory;




    public function student(){
        return $this->belongsTo(Students::class);
       } 
       public function batch(){
        return $this->belongsTo(Batches::class);
       } 
}
