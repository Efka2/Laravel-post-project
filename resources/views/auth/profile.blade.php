
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __($user->username. ' user\'s profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                   
                        <h1 class="text-4xl text-black font-bold"> Profile information </h1>
                                  
                    <div class="flex justify-center  my-10">
                        <div class=""></div>
                        
                        <div class="justify-center w-1/2 h-1/2 ">
                            @if ($user->profile_picture)
                            <img class="rounded-full" style="max-height: 50%" src=" {{ url( 'storage/profilePictures', [$user->id , $user->profile_picture])}} " />
                            @endif
                        </div>
                    </div>

                    @can('changeProfileInfo',$user)
                    <form method="POST" action="{{ route('user.changePicture') }}" enctype="multipart/form-data" files ="true">
                        @csrf
                        <div class="flex flex-col justify-center">
                            <div>
                                <x-label class="mt-3" for="profilePicture" :value="__('Profile picture')" />
                                <input type="file" name="profilePicture">
                            </div>
                            <div class="justify-center mt-4">
                                <button class="mb-5 bg-blue-600 text-white font-bold py-2 px-4 hover:bg-blue-400 rounded">
                                    Change profile picture
                                </button>
                            </div>
                        </div>
                    </form>
                    @endcan

                    <div class=" bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Name:  <span class="ml-auto"> {{$user->name}} </span>
                    </div>

                    <div class=" bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Username:  <span class="ml-auto"> {{$user->username}} </span>
                    </div>

                    <div class="bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Email:  <span class="ml-auto "> {{$user->email}} </span>
                    </div>

                    @can('changeProfileInfo',$user)
                        <a href=" {{route('user.profile.edit',$user)}} "><button class="bg-blue-600 text-white font-bold py-2 px-4 hover:bg-blue-400 rounded">
                            Change profile settings
                            </button>
                        </a>
                    @endcan

                    <h1 class="text-4xl text-black font-bold my-4"> Post information </h1>
                    
                    <div class="bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Posted  <span class="ml-au"> {{$user->posts->count()}}  {{Str::plural('post',$user->posts->count())}} </span>
                        <a href=" {{route('user.posts',$user)}} ">
                            <button class="ml-4 bg-blue-600 text-white font-bold py-2 px-4 hover:bg-blue-400 rounded">
                            View posts
                           </button>
                       </a>
                    </div>

                    <div class="bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Received  <span class="ml-au"> {{$user->receivedLikesOnPosts->count()}}  {{Str::plural('like',$user->receivedLikesOnPosts->count())}} </span>
                    </div>

                    <h1 class="text-4xl text-black font-bold my-4"> Comment information </h1>

                    <div class="bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Posted  <span class="ml-au"> {{$user->comments->count()}}  {{Str::plural('comment',$user->comments->count())}} </span>
                        
                    </div>
                    
                    <div class="bg-gray-200 rounded font-bold py-4 px-4 mb-4">
                        Received  <span class="ml-au"> {{$user->receivedLikesOnComments->count()}}  {{Str::plural('like',$user->receivedLikesOnComments->count())}} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
