<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Batches extends Model
{
    protected $table='batches';
    protected $primaryKey= 'id';
    protected $fillable = ['name','course_id','start_date'];
    use HasFactory;
  
   public function course(){
    return $this->belongsTo(Courses::class);
   } 
   
   
}
