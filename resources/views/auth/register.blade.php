
@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-guest-layout >
    <x-auth-card >
        <x-slot name="logo">

        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST"  action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Name -->
            <div class="row">
                    <div class="col-lg">
                <x-label for="first_name" :value="__('first Name')" />

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>
            <div>
                <x-label for="last_name" :value="__('last Name')" />

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>
        </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="role_id" :value="__('Register as')" />

                <select  name ="role_id" id="role_id" class="form-select" aria-label="Default select example">
                        <option value="seller">seller</option>
                        <option value="customer">customer</option>
                      </select>
            </div>
            <div class="mt-4">
                <x-label for="bio" :value="__('bio')" />
                <textarea id="bio" name="bio" rows="4" cols="40" class="form-control bio"></textarea>
            </div>
            <div class="mt-4">
                <x-label for="avatar" :value="__('Select Avatar')" />

                    <input type="file" name="avatar" class="form-control">
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
