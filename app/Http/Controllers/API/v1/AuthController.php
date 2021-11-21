<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use App\Repositories\UserlistRepositoryInterface;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Stevebauman\Location\Facades\Location;

class AuthController extends BaseController
{
    public function login(UserLoginRequest $request, UserlistRepositoryInterface $UserlistRepository)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $data['token'] =  $user->createToken('MyApp')->plainTextToken;

            $list = $UserlistRepository->nearestUserList('list');

            if ($list)
            {
                $data['list_size'] = count($list);
                $data['list'] = $list;
            }

            Log::debug( $data['token']);
            return $this->sendResponse($data, 'User login Successful');
        }
        else{
            return $this->sendError('Unauthorized.', ['error'=>'Email or Password Doesn\'t Match']);
        }
    }
    public function register(UserRegistrationRequest $request,  UserService $userService)
    {
        Log::debug($request);

        $image = $userService->image();
        $geolocation = Location::get($userService->getPublicIP());
        $data = array(
            'password' => Hash::make($request->password),
            'latitude' => ($geolocation != '') ? $geolocation->latitude : 0.00 ,
            'longitude' => ($geolocation != '') ? $geolocation->longitude : 0.00 ,
        );

        $user = User::create(array_merge($request->only('name','email','gender','dob','image'), $data, $image));

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        if($user){
            Log::debug($success);
            return $this->sendResponse($success, 'User register Successful.');
        }else{
            return $this->sendError('register.', ['error'=>'User Registration Failed']);
        }
    }
}
