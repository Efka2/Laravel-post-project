<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
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
        $posts = Post::latest()->with(['likes','user'])->paginate(10);
        
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'picture'=> 'image|max:1999|nullable'
        ]);
        
        /* if($request->hasfile('picture')){
            $news->nuotrauka = file_get_contents($request->file('nuotrauka'));
        } */
        
        $post = new Post();
        //dd($request->user());
        

        if($request->hasfile('picture')){
            $picture = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('avatars', $request->user()->id. '/'. $picture,'');
            $post-> picture = $picture;
        }
        $post -> body = $request->input("body");
        $post -> header = $request->input("header");
        $post -> user_id = $request-> user()->id;
        $post->save();

        /* $request-> user()->posts()->create([
            
            
            'body'=>$request->body,
        ]); */

       /*  Post::create([
            'body' => $request->body,
            'users_id' =>$request->user()->id,
        ]); */

        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
