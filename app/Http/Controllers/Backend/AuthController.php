<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view("backend.layouts.auth.login");
    }
    public function authenticate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email|max:255', // Added 'email' rule for proper format
                'password' => 'required|string|min:8|max:255', // Removed redundant ':255'
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if ($user->user_type === 'COMPANY' || $user->user_type === 'SUPER-ADMIN') {

                    Toastr::success('Successfully logged in.');
                    return redirect()->route('dashboard');
                } else {
                    Auth::logout();
                    Toastr::error('You do not have permission to access this area.');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Invalid email or password.');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            Toastr::error('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::logout();
        Toastr::success('Successfully Logout');
        return redirect()->route('login');
    }
}
