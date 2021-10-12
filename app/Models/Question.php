<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'question_text',
        'qusetion_type'
    ];
    public function question_type(){
        return $this->belongsTo(QuestionType::class);
    }
    public function question_options(){
        return $this->hasMany(QuestionOption::class);
    }
}
