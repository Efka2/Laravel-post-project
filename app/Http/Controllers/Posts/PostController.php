<?php

namespace App\Http\Controllers\Posts;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Award_Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with(['comments','likes','user','category','awards'])->paginate(10);


        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    public function userPosts(User $user){

        $posts = Post::latest()->with(['likes','user'])->
                where('user_id', $user->id)->paginate(10);

        return view('posts.userPosts',compact('posts','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request ,[
            'body' => 'nullable|max:500',
            'picture'=> 'image|max:1999|nullable',

        ]);

        $post = new Post();

        if($request->hasfile('picture')){
            $picture = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('avatars', $request->user()->id. '/'. $picture,'');
            $post-> picture = $picture;
        }
        $post-> category_id = $request->input("category");
        $post -> body = $request->input("body");
        $post -> header = $request->input("header");
        $post -> user_id = $request-> user()->id;
        $post->save();

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $comments = Comment::latest()->with('user','likes','user')->where('post_id', $post->id)->get();
        //return($comments);

        return view('posts.view',compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this -> authorize('delete', $post);
        $post->delete();
        return back();
    }
}
