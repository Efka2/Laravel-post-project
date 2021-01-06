<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Award;
use App\Models\Award_Post;
use App\Models\Award_User;
use App\Models\Post;

class AwardsController extends Controller
{
    public function index(){
        $awards = Award::all();
        $owned = Award_User::where('user_id',request()->user()->id)->get();

        return view('awards.index',compact('awards','owned'));
    }

    public function create(){

        return view('awards.create');
    }

    public function store(Request $request){

        $this->validate($request,[
            'picture'=> 'image|max:1999',
            'name'=> 'min:3',
        ]);

        $award = new Award();
        

        if($request->hasFile('picture')){
            $picture = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->storeAs('awards', $request->input('name'). '/'. $picture,'');
            $award->picture = $picture;
        }
        $award->name = $request->input('name');
        $award->description = $request->input('description');
        $award->save();

        return redirect('awards');
    }

    private function destroyAward($id){
        $awardToDetete = Award_User::where('user_id',request()->user()->id)
        ->where('award_id',$id)->first();
        $awardToDetete->delete();
    }

    public function chooseAward(Post $post){
        $awards = Award::all();
        $owned = Award_User::where('user_id',request()->user()->id)->get();
        return view('awards.awardPost',compact('post','awards','owned'));
    }

    public function awardPost(Post $post,Award $award){

        $this->destroyAward($award->id);

        
        $award_post = new Award_Post;


        $award_post->award_id = $award->id;
        $award_post->post_id = $post->id; 
        $award_post->user_id = request()->user()->id;

        $award_post->save();

        return redirect('posts');
    }

    

    public function buyAward(Award $award){

        $pivot = new Award_User;
        $pivot -> award_id = $award->id;
        $pivot ->user_id = request()->user()->id;
        $pivot->save();

        return redirect('awards');
    }
}
