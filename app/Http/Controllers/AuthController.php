<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Eloquent\Factories\Factory;

class AuthController extends Controller
{
    //
    public function _construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|string|confirmed|min:6']);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }
//     public function register(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'name' => 'required',
//         'email' => 'required|email|unique:users',
//         'password' => 'required|string|confirmed|min:6'
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors()->toJson(), 400);
//     }

//     $user = User::create([
//         'name' => $request->input('name'),
//         'email' => $request->input('email'),
//         'password' => Hash::make($request->input('password'))
//     ]);

//     // To decrypt the password, you can use the Hash::check() method
//     $isPasswordValid = Hash::check($request->input('password'), $user->password);

//     return response()->json([
//         'message' => 'User successfully registered',
//         'user' => $user,
//         'isPasswordValid' => $isPasswordValid
//     ], 201);
// }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email', 'password' => 'required|string|min:6']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    public function createNewToken($token){
        return response()->json(['access_token'=>$token,'token_type'=>'bearer','expires_in'=>auth()->factory()->getTTL()*60,'user'=>auth()->user()]);
    }
    public function profile(){
        return response()->json(auth()->user());
    }
    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'User logged out'
        ]);
    }
}