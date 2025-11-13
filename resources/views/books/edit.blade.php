<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Het veranderen van een post</h1>

    <form method="POST" action="{{ route('books.update', $books->id) }}">         
        @csrf 
        @method('PUT')
        <label>Titel:</label>
        <input type="text" name="title" value="{{ old('title', $books->title) }}">
        
        <label>Auteur:</label>
        <textarea name="author"> {{ old('author', $books->author) }}</textarea>

        <label>Beschrijving:</label>
        <textarea name="description"> {{ old('description', $books->description) }}</textarea>

        <button type="submit">Opslaan</button>
    </form>
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</body>
</html>