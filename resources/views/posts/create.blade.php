<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="flex items-center justify-end mt-4">
            <a href=" {{route('posts')}} ">
                <x-button class="ml-4">
                    {{ __('<- Back to posts') }}
                </x-button>
            </a>
        </div>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" files ="true">
            @csrf

            <!-- Header -->
            <div>
                <x-label for="header" :value="__('Header')" />

                <x-input id="header" class="block mt-1 w-full" type="text" name="header" :value="old('header')" required autofocus />
            </div>
            
            <!-- Picture -->

            <div>
                <x-label class="mt-3" for="picture" :value="__('Your picture')" />
                <input type="file" name="picture">
            </div>

            <div>
                <x-label class="mt-3" for="body" :value="__('Post body!')" />
                <textarea class="block mt-1 w-full mb-3" name="body" rows="20" cols="22" placeholder="Post something!"></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Post!') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
