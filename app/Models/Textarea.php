<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textarea extends Model
{
    use HasFactory;
    protected $fillable=[
        'text'
    ];
     public function sectionTitle(){
         $this->belongsTo(SectionTitle::class);
     }

}
