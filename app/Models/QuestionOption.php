<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'option_text',
        'question_id_fk',
        'price'
    ];
    public function questionType(){
        return $this->belongsTo(QuestionType::class);
    }
}
