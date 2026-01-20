<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ================= LOGIN ================= */

    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ]);
        }

        $user = Auth::user();

        // Blocked user check
        if (! $user->is_active) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your account has been blocked by admin.',
            ]);
        }

        // // Redirect by role
        // if ($user->isAdmin()) {
        //     return redirect()->route('admin.dashboard');
        // }

        if ($user->isAuthor()) {
            return redirect()->route('author.blogs.index');
        }

        return redirect()->route('home');
    }

    /* ================= REGISTER ================= */

    public function showRegister()
    {
        return view('user.auth.register');
    }

  public function register(Request $request)
{
    $data = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role'     => 'required|in:user,author',
    ]);

    $user = User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => Hash::make($data['password']),
        'is_active' => true,
    ]);

    // Assign selected role (user or author)
    $role = Role::where('name', $data['role'])->firstOrFail();
    $user->roles()->attach($role);

    Auth::login($user);

    // Redirect based on role
    if ($data['role'] === 'author') {
        return redirect()->route('author.blogs.index')
            ->with('success', 'Welcome Author! You can start writing blogs.');
    }

    return redirect()->route('home')
        ->with('success', 'Registration successful.');
}


    /* ================= LOGOUT ================= */

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
