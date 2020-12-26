<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function show(User $user){
        //dd($user);
        //        $posts = Post::latest()->with(['likes','user'])->paginate(10);
        //$user = $user->with(['receivedLikes','posts']);
        return view('auth.profile',compact('user'))->with(['posts','receivedLikes','comments']);
    }

    public function edit(Request $request, User $user){
        //dd($user);
        return view('auth.profileEdit',compact('user','request'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'username'=> 'required|string'
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    public function changePicture(Request $request){

        $request->validate([
            'profilePicture'=> 'image|max:1999|nullable',
        ]);

        $user = User::find(request()->user()->id);

        if($request->hasFile('profilePicture')){
            $picture = $request->file('profilePicture')->getClientOriginalName();
            $request->file('profilePicture')->storeAs('profilePictures', $request->user()->id. '/'. $picture,'');
            $user-> profile_picture = $picture;
        }

        $user->save();

        return back();
    }
}
