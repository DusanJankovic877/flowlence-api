<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_title'
    ];
    public function section_titles(){
       return $this->hasMany(SectionTitle::class);
    }
    public static function boot() {
        parent::boot();
        
    }
}
