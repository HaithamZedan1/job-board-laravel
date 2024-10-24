<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');
        $remember = $request->filled('remember');

        if(Auth::attempt($credentials,$remember)){
            return redirect()->intended('/');
        }else{
            return redirect()->back()->with('error','invaled credentials');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createNew()
    {
        return view('auth.create-new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeNew(Request $request)
    {
    $request->validate([
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email', 
        'password' => 'required|confirmed' 
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
    ]);

    Auth::login($user);

    return redirect()->route('jobs.index')
    ->with('success','User account created succesfully!');
    }

    
    public function destroy()
    {
        Auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerate();

        return redirect('/');
    }
}
