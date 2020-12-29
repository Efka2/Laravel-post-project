<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use App\Models\AwardedPosts;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body','picture'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function isLiked(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function awards(){
        return $this->belongsToMany(Award::class);//->withPivot(['award_id']);
    }

    

}
