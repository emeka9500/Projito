<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use id;

class AuthController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'email' => 'required|unique:users,email',
                'phone' => 'required|nullable|string|max:20',
                'password' => 'required|min:6|confirmed'
        ]);
        // $request->validate([
        if($validator->fails()){
            return response()->json([
                'message' => 'All fields are mandatory',
                'error' => $validator->messages()
            ], 422);
        }
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
        ]);
        // return redirect()-> url('auth.login');
        return response()->json(['message' => 'Student Profile created successfully', 'data' => $user],200);
    
    }
    public function loginUser(Request $request){
        $request->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
    //to check if the user is authenticated
        if ( Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;


            return response()->json([
                'status' => 'success',
                'message' => 'User logged in successfully',
                'data' => [
                    'user' => Auth::user($request),
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    // 'expires_in' => config('sanctum.expiration') ?? 3600
                ]
            ], 200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);

        }
    
        
            // return back()->withInput()->withErrors(['status' => 'Invalid credentials.']);
        
    }

       
            
    public function profile(Request $request) {

        // $user = User::findOrFail($id);
        $user = $request->user();
        
        if($user) {
            return response()->json([
            'message' => 'Profile retrieved successfully',
            'user' => $user, 
            200]);
        }else {
            return response()->json([
                'message' => 'User not found'
            ], 400);

        }
    }

    public function show($id)
    {
        {
           // Check if the requested ID matches the authenticated user's ID
            if (Auth::id() != $id) {
                return response()->json(['message' => 'Unauthorized: You can only view your own profile.'], 403);
            }

        $user = User::findOrFail($id);

        return response()->json([
            'message' => 'User Details retrieved successfully',
            'user' => $user,
        ]);
        }
    }
    public function destroy()
    {
        $user = Auth::user();

        // Verify password first (optional but recommended)
        if (!Hash::check(request('password'), $user->password)) {
            return response()->json(['message' => 'Incorrect password'], 403);
        }

        $user->deleteProfile();

        // Optional: Logout after deletion
        // Auth::guard('web')->logout();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}   