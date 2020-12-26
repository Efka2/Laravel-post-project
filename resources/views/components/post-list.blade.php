
        

<div class="m-3 p-4 bg-gray-200 h-1/2">
        <div class="flex">
            <div class="justify-center w-1/2 h-1/2">
                @if ($post->picture)
                <img style="max-height: 50%" src=" {{ url( 'storage/avatars', [$post->user_id , $post->picture])}} " />
                @endif
            </div>
            
            <div class="justify-between mx-auto">
                <h1 class=" text-4xl font-semibold mb-2 ">{{$post->header}}</h1></br>
                
                <div class=" text-xl">
                    {{$post->body}}
                </div>
            </div>
        
        </div>

        <div class="relative flex justify-start py-4 my-2 text-xl">
            <div class="mr-4">
                <a href=" {{route('posts.view',$post)}} "><button 
                 class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">
                    View 
                </button></a>
            </div>
            <!--LIKE-->
            @if( !$post->isLiked(auth()->user()) )
                <form  action="{{route('posts.like',$post)}}" method="POST">
                    @csrf
                    <button onclick="confirmation() type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">Like <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    </button>
                    <span> {{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}} </span>
                </form>
            @else
                <!--UNLIKE-->
                <form  action="{{route('posts.unlike', $post)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">Unlike </button>
                    <span> {{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}} </span>
                </form>
            @endif
                <!--DELETE-->
                @can('delete', $post)
                    <form onclick="confirmation()" action="{{route('post.delete', $post)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="confirmation()" type="submit" class="mx-4 bg-red-600 text-white font-bold py-2 px-4 hover:bg-red-400 rounded">Delete</button>
                    </form>
                    <i class="fa fa-trash"></i>
                @endcan
                <div class="absolute bottom-0 right-0 mr-2 text-xl"> {{$post->created_at -> diffForHumans() }}
                    by <a style="color:blue" href=" {{route('user.profile', $post->user )}} ">{{$post->user->username}}</a>
                </div>   
        </div>
</div>

<script>
    function confirmation(){
        if(confirm("Are you sure you want to delete this post?")){
            
        }
        else event.preventDefault();
    }
</script>