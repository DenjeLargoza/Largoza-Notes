@extends('layouts.app')

@section('content')
<h6>
    @php $user = Auth::user(); @endphp
    @if($isAdmin)
        Hello, {{$user->name}}, here are all users and their notes.
    @else
        Hello, {{$user->name}}, this is your personal information.
    @endif
</h6>
<div class="max-w-2xl mx-auto p-4">
    <div class="flex items-center justify-between mb-4">
        <div>
            <a href="dashboard" class="text-gray-800 hover:text-gray-600">
                <h1 class="text-2xl font-bold">Notes</h1>
            </a>
            <div class="text-gray-700 text-sm mt-1">
                Welcome, {{ Auth::user()->name }}
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="bg-gray-600 text-white px-4 py-2 rounded">Log out</button>
        </form>
    </div>
    @if(!$isAdmin)
        <form method="POST" action="/notes" class="mb-4 space-y-2">
            @csrf
            <input name="title" placeholder="Title"
                class="w-full border p-2 rounded">
            <textarea name="content" placeholder="Content"
                class="w-full border p-2 rounded"></textarea>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Add Note
            </button>
        </form>
        @foreach($notes as $note)
            <div class="bg-white p-3 rounded shadow mb-2">
                <h2 class="font-bold">{{ $note->title }}</h2>
                <p>{{ $note->content }}</p>
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
        @foreach($users as $u)
            <div class="bg-gray-100 p-3 rounded shadow mb-4">
                <h2 class="font-bold text-lg mb-2">User: {{ $u->name }}</h2>
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