<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Mail\WelcomeUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {

        // Regex for validating phone numbers
        $phoneRegex = '/^(?:\+234|0)[789][01]\d{8}$/';

        // Logic to create a new user
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'phone' => ['nullable', 'string', 'max:12', "regex:$phoneRegex"],
        ]);

        $user = User::create([
            'id' => (string) Str::uuid(), // Generate a UUID for the user ID
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],

        ]);

        Mail::to($user->email)->send(new WelcomeUserMail($user->name));



        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }


    // public function login()
    public function login(Request $request)
    {
        // Logic to authenticate a user
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required|string']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,

            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }




    // logout user
    public function logout(Request $request)
    {
        // Logic to log out a user
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
