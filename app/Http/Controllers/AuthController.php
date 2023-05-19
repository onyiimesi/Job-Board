<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the appropriate dashboard based on the user's role
        if ($user->role === 'admin') {

            return redirect('/admin/dashboard');

        } if ($user->role === 'employer'){

            return redirect('/employer/dashboard');

        } if ($user->role === 'candidate') {
            return redirect('/candidate/dashboard');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect to the appropriate dashboard based on the user's role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            elseif ($user->role === 'employer'){

                return redirect('/employer/dashboard');

            }

            elseif ($user->role === 'candidate') {

                return redirect('/candidate/dashboard');
            }

        } else {
            // Failed login attempt
            return redirect('/')->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
