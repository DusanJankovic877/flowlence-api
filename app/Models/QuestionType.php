<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type'
    ];
    public function question(){
        return $this->hasMany(Question::class);
    }
    public function questionType(){
        return $this->hasMany(QuestionType::class);
    }
}
