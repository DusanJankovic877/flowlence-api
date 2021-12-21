<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'path',
        'section_title_id'
    ];
    public function section_title(){
        return $this->belongsTo(SectionTitle::class);
    }
}
