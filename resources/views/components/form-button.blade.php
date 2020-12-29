<form  action="{{route('posts.like',$post)}}" method="POST">
    @csrf
    <button  type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 hover:bg-blue-400 rounded">Like <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
    </button>
    <span> {{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}} </span>
</form>