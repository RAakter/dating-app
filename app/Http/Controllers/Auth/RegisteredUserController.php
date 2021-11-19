<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Stevebauman\Location\Facades\Location;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @param UserService $userService
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(Request $request, UserService $userService)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'dob' => ['required'],
            'image'=> ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $image = $userService->image();
        $geolocation = Location::get($userService->getPublicIP());

        $data = array(
            'password' => Hash::make($request->password),
            'latitude' => ($geolocation != '') ? $geolocation->latitude : 0.00 ,
            'longitude' => ($geolocation != '') ? $geolocation->longitude : 0.00 ,
        );

        $user = User::create(array_merge($request->only('name','email','gender','dob','image'), $data, $image));

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
