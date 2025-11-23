<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTitle extends Model
{
    protected $fillable = [
        'title'
    ];

    public function todos(){
        return $this->hasMany(Todo::class,'title_id');
    }
}
