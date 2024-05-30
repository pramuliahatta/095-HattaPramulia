<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'min:4',
                'max:255',
            ],
            'email' => [
                'required',
                'unique:users',
                'email:dns'
            ],
            'username' => [
                'required',
                'unique:users',
                'min:4',
                'max:255',
            ],
            'password' => [
                'required',
                'min:4',
                'max:255',
                'confirmed',
            ],
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        // $validatedData['email_verified_at'] = now();
        $validatedData['is_active'] = true;
        $validatedData['role'] = 'member';

        $createData = User::create($validatedData);
        if ($createData) {
            return redirect()->intended(route('login'))->with('success', 'An account registered successfully.');
        }
        
        return back()->with('error', 'Error.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('profile', [
            'title' => 'Profile',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($request->has('password')) {

            $validatedData = $request->validate([
                'password' => [
                    'required',
                    'min:4',
                    'max:255',
                    'confirmed',
                ],
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);
            
            $updateData = User::where('id', $user->id)
                ->update($validatedData);
            if ($updateData) {
                return back()->with('success', 'Password updated successfully.');
            }
            return back()->with('error', 'Error.');
        } else {
            $rules = [
                'name' => [
                    'required',
                    'min:4',
                    'max:255',
                ],
            ];

            if($request->email != $user->email) {
                $rules['email'] = [
                    'required',
                    'unique:users',
                    'email:dns',
                ];
            }

            if($request->username != $user->username) {
                $rules['username'] = [
                    'required',
                    'unique:users',
                    'min:4',
                    'max:255',
                ];
            }

            $validatedData = $request->validate($rules);

            $updateData = User::where('id', $user->id)
                ->update($validatedData);
            if ($updateData) {
                if($request->username == $user->username) {
                    return redirect()->intended(route('profile.edit', ['user' => $user->username]))->with('success', 'Profile updated successfully.');
                } else {
                    return redirect()->intended(route('profile.edit', ['user' => $request->username]))->with('success', 'Profile updated successfully.');
                }
            }
            return back()->with('error', 'Error.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role == 'admin') {
                return redirect()->intended(route('dashboard'));
            }
            return redirect()->intended(route('home'));
        }

        return back()->with('error', 'Login Failed');
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->intended(route('home'));
    }
}
