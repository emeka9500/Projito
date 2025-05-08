<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function users(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
        ]);
        return response()->json(['message' => 'Student Profile created successfully', 'data' => $user],200);
    
    }
}
