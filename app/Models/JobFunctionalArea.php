<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobFunctionalArea extends Model
{
   protected $fillable = [
       'job_id', 'functional_area_id'
   ];

   protected $with = [
       'details'
   ];

   public function details(){
       return $this->belongsTo(FunctionalArea::class, 'functional_area_id', 'id');
   }
}
