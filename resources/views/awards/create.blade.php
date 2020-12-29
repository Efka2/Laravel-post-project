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
            <a href=" {{route('awards')}} ">
                <x-button class="ml-4">
                    {{ __('<- Back to awards') }}
                </x-button>
            </a>
        </div>

        <form method="POST" action="{{ route('awards.store') }}" enctype="multipart/form-data" files ="true">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Award name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            
            <!-- Picture -->

            <div>
                <x-label class="mt-3" for="picture" :value="__('Picture')" />
                <input type="file" name="picture" required>
            </div>

            <!-- Description -->
            <div>
                <x-label class="mt-3" for="body" :value="__('Award description')" />
                <x-input id="description" class="block mt-1 w-full h-10" type="text" name="description" :value="old('description')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Create') }}
                </x-button>
            </div>
            
        </form>
    </x-auth-card>
</x-guest-layout>
