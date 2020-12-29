<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <h1 class="text-center text-3xl font-bold my-4"> {{$post->header}} </h1>
                    <div class="flex justify-center">
                        <div class=" ">
                            @if ($post->picture)
                            <img style="" src=" {{ url( 'storage/avatars', [$post->user_id , $post->picture])}} " />
                            @endif
                        </div>
                    </div>
                    <div class="text-base w-1/2 my-5 mx-3 ">
                        {{$post->body}}
                    </div>
                </div>

                
            </div>
            <div class="text-xl font-bold  my-10 p-6 bg-white border-b border-gray-200">
                Comments
            </div>

            <form method="POST" action=" {{route('posts.comment',$post)}} ">
                @csrf
                <div class="bg-gray-500 h-full">
                    <textarea class="text-xl block mt-1 w-full mb-3 rounded p-5" name="body" rows="5" cols="5"
                     placeholder="Comment something!" :value="old('body')"></textarea>    
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button class="text-base ml-4">
                        {{ __('Comment') }}
                    </x-button>
                </div>
            </form>
            
            @if ($comments->count())
                @foreach ($comments as $comment)
                    <div class="relative  justify-end  rounded-lg  my-5 p-6 bg-white border-b border-gray-200">
                        
                        <div class="text-lg absolute left-0 top-0 ml-4 my-3">
                            <a href="{{route('user.profile', $comment->user )}}">{{$comment->user->username}}</a> {{$comment->created_at->diffForHumans()}} 
                        </div>

                        <div class="my-7 flex">
                            <div>
                                @if ($comment->user->profile_picture)
                                    <img class="mr-4 rounded-full" style="width: 110px" src=" {{ url( 'storage/profilePictures', [$comment->user->id , $comment->user->profile_picture])}} " />
                                @else
                                    <img class="mr-4 rounded-full" style="width: 110px" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.watsonmartin.com%2Fwp-content%2Fuploads%2F2016%2F03%2Fdefault-profile-picture.jpg&f=1&nofb=1" />
                                @endif
                            </div>
                        
                            <div class="text-xl bg-gray-300 my-6 p-3 rounded-lg">  {{$comment->body}} </div>
                        </div>
                        @if (!$comment->isLiked(auth()->user()))
                            <form  action=" {{route('comment.like',$comment )}} " method="POST">
                                @csrf
                                <button  type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">Like <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                </button>
                                <span> {{$comment->likes->count()}} {{Str::plural('like',$comment->likes->count())}} </span>
                            </form>
                        @else
                            <form  action=" {{route('comment.unlike',$comment)}} " method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">Unlike </button>
                                <span> {{$comment->likes->count()}} {{Str::plural('like',$comment->likes->count())}} </span>
                            </form>
                        @endif

                        @can('delete',$comment)
                            <form onclick="confirmation()" action="{{route('comment.delete', $comment)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  type="submit" class="bg-red-600 text-white font-bold py-2 px-4 hover:bg-red-400 rounded">Delete</button>
                            </form>
                            <i class="fa fa-trash"></i>
                        @endcan
                        
                    </div>
                @endforeach
            @endif
            <!-- move to component -->  
          
        </div>
    </div>
</x-app-layout>
<script>
    function confirmation(){
        if(confirm("Are you sure you want to delete your comment?")){
            
        }
        else event.preventDefault();
    }
</script>