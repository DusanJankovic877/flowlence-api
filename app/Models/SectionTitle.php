<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTitle extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'post_id'
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function textareas(){
        return $this->hasMany(Textarea::class);
    }

}
