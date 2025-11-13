<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books</title>
    <a href="{{ route('dashboard') }}">Terug naar Dashboard</a>
</head>
<body>
    <h1>Alle Boeken</h1>

    <a href="{{ route('books.create') }}">Een nieuw boek toevoegen</a>

    @foreach($books as $book)
    <div>
        <h2>{{ $book->title }}</h2>
        <p>{{ $book->author }}</p>
        <p>{{ $book->description }}</p>
        <a href="{{ route('books.edit', $book->id) }}">Edit</a>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm ('Weet je zeker dat je dit boek wilt verwijderen?')"> Verwijderen</button>
        </form>
    </div>
    @endforeach
</body>
</html>