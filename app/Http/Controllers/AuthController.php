<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        //menangkap inputan
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        //menginsert data ke table user 
        $user = User::create($input);

        $data = [
            'message' => 'User is created successfully'
        ];

        //mengirim response json dan status code 200
        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        //menangkap input user 
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //melakukan autentikasi
        if (Auth::attempt($input)) {
            //membuat token
            $token = Auth::user()->createToken('auth_token');

            $data = [
                'message' => 'Login successfully',
                'token' => $token->plainTextToken
            ];
            //mengembalikan response json
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Username or password is wrong'
            ];

            return response()->json($data, 401);
        }
    }
}
