<div class="m-3 p-4 bg-gray-200 h-1/2">

    <div class=" mr-2 text-xl mb-5">
        <div class="inline ">
            @if ($post->user->profile_picture)
                <img class="mr-4 rounded-full inline-block " style="width: 10%" src=" {{ url( 'storage/profilePictures', [$post->user->id , $post->user->profile_picture])}} " />
            @else
                <img class="mr-4 rounded-full inline-block" style="width: 10%" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.watsonmartin.com%2Fwp-content%2Fuploads%2F2016%2F03%2Fdefault-profile-picture.jpg&f=1&nofb=1" />
            @endif
        </div>
        <div class="inline-block">
            <a style="color:blue" href=" {{route('user.profile', $post->user )}} ">{{$post->user->username}}</a>
            {{$post->created_at -> diffForHumans() }}
        </div>
    </div>
        <h1 class=" text-4xl font-semibold mb-2 ">{{$post->header}}</h1></br>
        <div class="flex justify-center">
            <div class=" w-1/2 h-1/2">
                @if ($post->picture)
                <img style="max-height: 50%;" src=" {{ url( 'storage/avatars', [$post->user_id , $post->picture])}} " />
                @endif
            </div>

        </div>

        <div class="relative flex justify-start py-4 my-2 text-xl">
            <div class="mr-4">
                <a href=" {{route('posts.view',$post)}} "><button
                 class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">
                    View
                </button></a>
            </div>
            <div class="inline-block">
            <!--LIKE-->
            @if( !$post->isLiked(auth()->user()) )
                <form  action="{{route('posts.like',$post)}}" method="POST">
                    @csrf
                    <button  type="submit" class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">Like <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
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
                        <button  type="submit" class="mx-4 bg-red-600 text-white font-bold py-2 px-4 hover:bg-red-400 rounded">Delete</button>
                    </form>
                    <i class="fa fa-trash"></i>
                @endcan
                </div>
                <div class="ml-4">
                    comments {{$post->comments->count()}}
                </div>
        </div>
        <div class="">
            @if ($post->awards->count())
            Awards:
                @foreach ($post->awards as $award)
                    <img style="width:7%" src=" {{ url( 'storage/awards', [$award->name , $award->picture])}} " />
                @endforeach

            @endif

        </div>
</div>

<script>
    function confirmation(){
        if(confirm("Are you sure you want to delete this post?")){

        }
        else event.preventDefault();
    }
</script>
