<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('register');
    }

    // Register process
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'email'    => 'required|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|min:4',
        ]);

        // Save to DB
        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Save session
        session([
            'user_id'  => $user->id,
            'username' => $user->username,
        ]);

        return redirect('/login')->with('success', 'Registered successfully! Please login.');
    }

    // Show login form
    
    public function showLoginForm()
    {
        return view('login'); // same login view
    }

    public  function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $remember = $request->filled('remember'); // optional "remember me"

        // Try to authenticate by email first, then username.
        $credentialsUser  = ['username' => $request->username, 'password' => $request->password];

        if (Auth::attempt($credentialsUser, $remember)) {
            // Successful login
            $request->session()->regenerate(); // prevent session fixation

            $user = Auth::user();

            // Optional: keep small custom session values you used before
            session([
                'username' => $user->username,
                'is_admin' => $user->is_admin,
            ]);

            // If admin -> go admin dashboard (skip intended redirect to keep admin UX predictable)
            if ($user->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }

            // For normal users: redirect to intended (e.g., checkout) or dashboard
            return redirect()->intended('/dashboard');
        }

        // Failed auth
        return back()->withErrors(['username' => 'Invalid username/email or password.'])->withInput();
    }



    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }

}
