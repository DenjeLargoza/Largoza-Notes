<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 1) {
            // Admin: get all users with their notes
            $users = \App\Models\User::with('notes')->get();
            return view('notes.index', [
                'users' => $users,
                'isAdmin' => true
            ]);
        } else {
            // Regular user: only their notes
            return view('notes.index', [
                'notes' => $user->notes()->latest()->get(),
                'isAdmin' => false
            ]);
        }
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
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        Auth::user()->notes->create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $note->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return back();
    }
    
    public function showNotes()
    {
        return view('notes.showNote');
    }

    public function dashboard()
    {
        $user = Auth::user();
        if ($user->role == 1) {
            $notes = Note::latest()->get();
        } else {
            $notes = $user->notes;
        }
        return view('dashboard', compact('notes'));
    }
}