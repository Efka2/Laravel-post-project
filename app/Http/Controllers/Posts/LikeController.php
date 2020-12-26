<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post){
        if(!$post->isLiked(request()->user())){
            $post->likes()->create([
                'user_id' => request()->user()->id,
            ]);
        }
    
        return back();
        
    }

    public function destroy(Post $post){
        $post->likes()->where('user_id',request()->user()->id) ->delete();

        return back();
    }
}
