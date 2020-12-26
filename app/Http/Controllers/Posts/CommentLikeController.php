<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentLike;

class CommentLikeController extends Controller
{
    public function store(Comment $comment){
       
        if(!$comment->isLiked(request()->user())){
            $comment->likes()->create([
                'user_id' => request()->user()->id,
            ]);
        }

        return back();
        
    }

    public function destroy(Comment $comment){

        $comment->likes()->where('user_id', request()->user()->id)->delete();

        return back();
    }
}
