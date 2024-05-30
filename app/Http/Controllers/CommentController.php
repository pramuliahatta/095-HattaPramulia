<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
            'body' => [
                'required',
                'max:255',
            ],
        ]);

        $storeData = Comment::create($validatedData);
        if ($storeData) {
            return back()->with('scroll_to_bottom', true);
        }
        
        return back()->with('error', 'Error.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $destroyData = Comment::destroy($comment->id);
        if ($destroyData) {
            return back()->with('scroll_to_bottom', true);
        }
        
        return back()->with('error', 'Error.');
    }
}
