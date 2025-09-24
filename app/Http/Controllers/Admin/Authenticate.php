<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class Authenticate extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validation
            $request->validate([
                "email" => "required|email|unique:admins,email",
                "password" => "required|min:6|confirmed" // confirmed means "password_confirmation" input must match
            ]);

            // If validation passes, create user (example)
            Admin::create([
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);

            return redirect()->route('adminloginview')->with("status", "Admin Registered Succefully");
        } catch (ValidationException $e) {
            // Redirect back with validation errors

            return back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (Exception $e) {
            // Any other unexpected exception
            return back()->with("error", "Something went wrong: " . $e->getMessage());
        }
    }


            public function login(Request $request)
            {
                try {
                    // Validate input
                    $request->validate([
                        "email" => "required|email",
                        "password" => "required|min:6",
                    ]);

                    // Check if email exists
                    $admin = Admin::where("email", $request->email)->first();

                    if (!$admin) {
                        // Email not found
                        throw ValidationException::withMessages([
                            'email' => ['The provided email does not exist.'],
                        ]);
                    }

                    // Check password
                    if (!Hash::check($request->password, $admin->password)) {
                        // Password mismatch
                        throw ValidationException::withMessages([
                            'password' => ['The password you entered is incorrect.'],
                        ]);
                    }

                    // If both correct → log in with admin guard
                    Auth::guard('admin')->login($admin);




                    return redirect()->route('admin.dashboard')->with("status", "Login successful!");
                } catch (ValidationException $e) {
                    // Redirect back with validation errors
                    return back()
                        ->withErrors($e->errors())
                        ->withInput();
                } catch (Exception $e) {
                    // Any other unexpected exception
                    return back()->with("error", "Something went wrong: " . $e->getMessage());
                }
            }


            



}
