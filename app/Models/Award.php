<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['award_id'];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
}
