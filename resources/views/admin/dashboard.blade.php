<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #b3b7c4;
            padding: 30px;
        }

        .container-box{
            max-width: 700px;
            margin: auto;
            background: rgba(255,255,255,0.2);
            padding: 20px;
            border-radius: 20px;
        }
        .note-card{
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container-box">
        <div class="d-flex justify-content-between mb-3">
            <h5>Hello, {{auth()->user()->name}}
                <br>
                <small>All notes and their authors</small>
            </h5>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        @foreach($notes as $note)
            <div class="note-card">
                <h6><strong>Title: </strong>{{ $note->title }}</h6>
                <p><strong>Discription: </strong>{{ $note->content }}</p>
                <small><strong>Author: </strong>{{ $note->user->name }}</small>
            </div>
        @endforeach
    </div>
</body>
</html>