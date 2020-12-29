<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Awards') }}
        </h2>
        @if(auth()->user()->role->name == 'Admin')
        <div  class="flex justify-end">
            <a href=" {{route('awards.create')}} ">
                <button class="bg-gray-600 text-white text-2xl font-bold py-2 px-4 hover:bg-gray-400 rounded-lg">
                    Create an award 
                </button>
            </a>
        </div>
        @endif
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class=" grid gap-4 grid-cols-5">
                        @if($awards->count())
                            @foreach ($awards as $award)
                                <div class="">
                                    <x-award :award="$award" :owned="$owned"/>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
