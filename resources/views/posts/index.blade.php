<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>

        <div  class="flex justify-end">
            <a href=" {{route('posts.create')}} ">
                <button class="bg-gray-600 text-white text-2xl font-bold py-2 px-4 hover:bg-gray-400 rounded-lg">
                    Create a post
                </button>
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mb-10">
                    @if($posts->count())
                        @foreach ($posts as $post)
                            <x-post-list :post="$post" />
                        @endforeach
                        {{$posts-> links()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
