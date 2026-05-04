@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-4">
        <div>
            <a href="dashboard" class="text-gray-800 hover:text-gray-600">
                <h1 class="text-2xl font-bold">Notes</h1>
            </a>
            <div class="text-gray-700 text-sm mt-1">
                Welcome, {{ Auth::user()->name }}
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-gray-600 text-white px-4 py-2 rounded">
                Log out
            </button>
        </form>
    </div>

    <!-- ERROR MESSAGE -->
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(!$isAdmin)
        <!-- AI GENERATOR -->
        <div class="bg-gray-100 p-3 rounded mb-4">
            <h2 class="font-bold mb-2">Generate Notes with AI</h2>

            <form method="POST" action="/notes/generate">
                @csrf
                <input type="text" name="topic"
                    placeholder="Enter topic you want notes about"
                    class="w-full border p-2 rounded mb-2" required>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                    Generate Notes
                </button>
            </form>
        </div>

        <!-- AI RESULT -->
        @if(session('notes'))
            <div class="bg-green-100 p-3 rounded mb-4">
                <h3 class="font-bold mb-2">Generated Notes</h3>

                <div class="text-sm text-gray-800 mb-2">
                    {!! nl2br(e(session('notes'))) !!}
                </div>

                <!-- SAVE AI NOTE -->
                <form method="POST" action="/notes">
                    @csrf
                    <input type="hidden" name="title" value="AI Generated Note">
                    <input type="hidden" name="content" value="{{ session('notes') }}">

                    <button class="bg-blue-600 text-white px-3 py-1 rounded">
                        Save This Note
                    </button>
                </form>
            </div>
        @endif
        @if($generatedNotes)
            <div class="bg-green-100 p-3 rounded mb-4">
                <h3 class="font-bold mb-2">Generated Notes</h3>
                <div class="text-sm text-gray-800 mb-2">
                    {!! nl2br(e($generatedNotes)) !!}
                </div>
                <!-- Save AI Note form here -->
            </div>
        @endif

        <!-- MANUAL ADD NOTE -->
        <form method="POST" action="/notes" class="mb-4 space-y-2">
            @csrf
            <input name="title" placeholder="Title"
                class="w-full border p-2 rounded" required>

            <textarea name="content" placeholder="Content"
                class="w-full border p-2 rounded" required></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Add Note
            </button>
        </form>

        <!-- NOTES LIST -->
        @foreach($notes as $note)
            <div class="bg-white p-3 rounded shadow mb-2">
                <h2 class="font-bold">{{ $note->title }}</h2>
                <p class="text-sm text-gray-700">{{ $note->content }}</p>

                <form method="POST" action="/notes/{{ $note->id }}">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 text-sm mt-2">
                        Delete
                    </button>
                </form>
            </div>
        @endforeach

    @else

        <!-- ADMIN VIEW -->
        @foreach($users as $u)
            <div class="bg-gray-100 p-3 rounded shadow mb-4">
                <h2 class="font-bold text-lg mb-2">
                    User: {{ $u->name }}
                </h2>

                @if($u->notes->count())
                    @foreach($u->notes as $note)
                        <div class="bg-white p-3 rounded shadow mb-2">
                            <h3 class="font-semibold">{{ $note->title }}</h3>
                            <p>{{ $note->content }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="text-gray-500">No notes.</div>
                @endif
            </div>
        @endforeach

    @endif

</div>
@endsection