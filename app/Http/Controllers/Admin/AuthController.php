<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $credentials = $request->only('email', 'password');
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->withErrors(['email' => 'Invalid credentials']);
            }

            if ($user->role == "1") {
                return back()->withErrors(['email' => 'Invalid credentials']);
            }

            if ($user->status == 0) {
                return back()->withErrors(['email' => 'Invalid credentials']);
            }

            if (Auth::attempt($credentials)) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return back()->withErrors(['email' => 'Invalid credentials']);
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
                'role' => 'required|in:admin,user',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('login')->with('success', 'Registered successfully');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('admin.login')->with('success', 'Logout successfully');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
