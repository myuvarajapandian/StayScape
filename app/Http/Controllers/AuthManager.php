<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login()
    {
        return view('login');
    }

    function register()
    {
        return view('register');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->input('remember'))) {

            $user = Auth::user();
            if ($user->user_role === 'house owner') {
                return redirect()->intended(route('owner.index'));
            } else {
                return redirect()->intended(route('customer.index'));
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid login credentials']);
    }

    function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'password' => 'required|min:8'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['user_role'] = $request->role;
        $data['about'] = 'You can add about you...';
        $data['phone'] = $request->phone;
        $user = User::create($data);
        if (!$user) {
            return redirect(route('register'))->with("error", "signup failed");
        }
        return redirect(route('login'))->with("success", "Registration success, Login to your account");
    }

    public function forgotview()
    {
        return view('forgot');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect(route('forgot'))->with('error', 'Email not found');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('login'))->with('success', 'Password Reset Success');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
