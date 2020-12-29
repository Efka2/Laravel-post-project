<div class="justify-center">
    @if ($award->picture)
        <h1 class="text-2xl font-bold"> {{$award->name}} </h1>
        <img style="width: 200px;height:200px;" src=" {{ url( 'storage/awards', [$award->name , $award->picture])}} " />
        <p class="text-xl"> {{$award->description}} </p>
        <a href=" {{route('award.buy',$award)}}"><button  class="bg-gray-600 text-white font-bold py-2 px-4 hover:bg-gray-400 rounded">Buy award</button></a>
        You own: {{$owned->where('award_id',$award->id)->count()}}
    @endif
</div>