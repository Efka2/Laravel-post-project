

<div class="m-3 p-4 bg-gray-200">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <img style="width:100% "  src="storage/avatars/{{$post->user_id}}/{{$post->picture}}">
            </div>
            
            <div style="text-align:center ">
                <h1 class=" text-4xl font-semibold mb-2 ">{{$post->header}}</h1></br>
                <div class=" text-xl">
                    
                    {{$post->body}}
                </div>
            </div>
        
        </div>

            <!--LIKE-->
        @if(! $post->hasLiked(auth()->user()) )
            <form action="{{route('post.like', $post)}}" method="POST">
                @csrf
                <button type="submit" class="text-blue-500 mr-2">Like <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                </button>
                <span> {{$post->likes->count()}}   {{Str::plural('like',$post->likes->count())}}</span>
            </form>
        @else
            <!--UNLIKE-->

            <form action="{{route('post.unlike', $post)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-500 mr-2">Unlike </button>
                <span> {{$post->likes->count()}}   {{Str::plural('like',$post->likes->count())}}</span>
            </form>
            
        @endif
            <!--DELETE-->
            @can('delete', $post)
                <form action="{{route('post.delete', $post)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500 mr-2">Delete</button>
                </form>
            @endcan

        <span class = ""> <br> {{$post->created_at -> diffForHumans() }}</span>
</div>