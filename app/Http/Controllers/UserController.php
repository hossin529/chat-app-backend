<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

use App\user;
use Hash;
class UserController extends Controller
{
    public function register(storeUserRequest $request){
		$user = User::create([
			'name'=>$request['name'],
			'email'=>$request['email'],
			'password'=>Hash::make($request['password']),
		]);
		return new UserResource($user);
	}


	public function current()  {
		return new UserResource(auth()->user());
	}

	public function update(Request $request){
		$request->validate([
			'name'=>'required',
			'email'=>'required|email|unique:users,email,'.auth()->id()
		]);
		$user = User::find(auth()->id());
		$user->name = $request['name'];
		$user->email = $request['email'];
		$user->save();
		return new UserResource($user);

	}

	public function fcmToken(Request $request){

		$user = User::find(auth()->id());
		$user->update(['fcm_token'=>$request['fcm_token']]);

		return response()->json('fcm updated successfully',200);

	}
}
