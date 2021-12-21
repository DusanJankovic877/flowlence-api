<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textarea extends Model
{
    use HasFactory;
    protected $fillable=[
        'text',
        'section_title_id'
    ];
     public function section_title(){
       return $this->belongsTo(SectionTitle::class);
     }

}
