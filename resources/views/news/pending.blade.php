<!DOCTYPE html>
<html>
<head>
    <title>Pending News</title>
</head>
<body>
    <h1>Berita Pending</h1>

    @foreach($news as $n)
        <hr>
        <h3>{{ $n->title }}</h3>
        <p>{{ $n->content }}</p>

        <form method="POST" action="/news/{{ $n->id }}/approve" style="display:inline">
            @csrf
            <button>Approve</button>
        </form>

        <form method="POST" action="/news/{{ $n->id }}/reject" style="display:inline">
            @csrf
            <button>Reject</button>
        </form>
    @endforeach
</body>
</html>
