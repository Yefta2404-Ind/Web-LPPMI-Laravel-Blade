<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
</head>
<body>

<h1>Edit Berita</h1>

<form method="POST" action="/news/{{ $news->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $news->title }}" required><br><br>

    <textarea name="content" rows="6" required>{{ $news->content }}</textarea><br><br>

    <input type="file" name="image"><br><br>

    <button>Update</button>
</form>

</body>
</html>
