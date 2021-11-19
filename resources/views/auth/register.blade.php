<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <h1 class="mt-5">User Registration</h1>
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name *')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email *')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password *')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password *')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-label for="dob" :value="__('Date Of Birth *')" />

                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Gender *')" />
                <select class="block mt-1 w-full" required autofocus name="gender" id="gender">
                    <option selected disabled value=""> Please Select Gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-label for="image" :value="__('Profile Photo *')" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autofocus />
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
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    window.onload = function() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(setPosition);
        } else {
            console.log("Geolocation not supported by browser.");
        }

    };

    function setPosition(position) {
        console.log(position);
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        $.ajax({
            type: 'POST',
            url: "{{ route('register') }}",
            data: {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            },
            success: function(ajax) {
                console.log($.ajax);
            },
            error: function(request, error) {
                console.log(error);
            }
        });
    }
</script>
--}}
