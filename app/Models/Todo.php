<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable =[
        'title_id',
        'description',
        'is_completed',
        'created_by'
    ];

    //naming convention in laravel get{properties}Attribute this is not a normal function it is just accessor for the is_completed
    //column
    public function getStatusAttribute()
    {
        return $this->is_completed ? 'Complete' : 'Incomplete';
    }

    public function reportTitle(){
        return $this->belongsTo(ReportTitle::class,'title_id');
    }
}
