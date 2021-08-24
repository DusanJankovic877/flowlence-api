<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_id',
        'title',
        'price'
    ];
}
