<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required|string|max:100|min:2',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'msg' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' =>'required|string|email',
            'password' =>'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if (!$token = auth()->attempt($validator->validate())) {
            return response()->json(['success'=>false,'msg'=>'Username and Password is Incorrect']);
        }

        return $this->respondWithToken($token);

    }

    protected function respondWithToken($token){
        return response()->json([
           'success'=>true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        try {
            auth()->logout();
            return response()->json(['success'=>true,'msg'=>'User logged out!!']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage()]);
        }
    }

    public function profile()
    {
        try {
            return response()->json(['success'=>true,'data'=>auth()->user()]);
        } catch (Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
    }

    public function UpdateProfile(Request $request)
    {
        if (auth()->user()) {
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'name' =>'required|string',
                'email' =>'required|string|email',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response()->json(['success'=>true,'msg'=>'User Update Successfully', 'data'=>$user]);
        } else {
            return response()->json(['success'=>false,'msg'=>'User is not Authenticate']);
        }

    }
}
