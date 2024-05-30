<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        if(Route::current()->getName() == 'home') {
            return view('home', [
                'title' => 'Home',
                'posts'=> Post::all(),
            ]);
        }

        // Retrieve the post with the given username
        $posts = $user->post;

        if ($posts) {
            return view('home', [
                'title' => 'Your Post',
                'posts'=> $posts,
                'user' => $user,
            ]);
        } else {
            // User not found
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => [
                'required',
                'min:4',
                'max:255',
            ],
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // Adjust max size as needed
            ],
        ]);

        
        // Generate a random filename
        $randomFileName = Str::random(20); // Generates a random string of 20 characters
        
        // Store the uploaded image in the filesystem
        $imagePath = $request->file('photo')->move(public_path('img/upload'), $randomFileName.'.'.$request->file('photo')->getClientOriginalExtension());
        // $imagePath = $request->file('photo')->store('img/upload');

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['photo'] = $randomFileName.'.'.$request->file('photo')->getClientOriginalExtension();
        
        if ($imagePath) {
            $createData = Post::create($validatedData);
            if ($createData) {
                return redirect()->intended(route('post.index', ['user' => Auth::user()->username]));
                // ->with('success', 'An account registered successfully.');
            }
        }
        
        return back()->with('error', 'Error.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Post $post)
    {
        return view('post', [
            'title' => 'Post Detail',
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $filePath = public_path('img/upload/') . $post->photo;

        if (File::exists($filePath)) {
            File::delete($filePath);
            
            $destroyData = Post::destroy($post->id);
            if ($destroyData) {
                return redirect()->intended(route('post.index', ['user' => Auth::user()->username]));
            }    
        }
        return back()->with('error', 'Error.');
    }

    // public function showAll()
    // {
    //     return view('home', [
    //         'title' => 'Home',
    //         'posts'=> Post::all(),
    //     ]);
    // }

}
