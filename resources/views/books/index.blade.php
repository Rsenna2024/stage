<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books</title>
    <a href="{{ route('dashboard') }}">Terug naar Dashboard</a>
</head>
<body>
    @php
        $googleBooks = $googleBooks ?? [];
        $query = $query ?? '';
    @endphp
    <h1>Alle Boeken</h1>

    <a href="{{ route('books.create') }}">Een nieuw boek toevoegen</a>

    <h2>Zelf toegevoegde boeken</h2>
    @foreach($books as $book)
    <div>
        <h3>{{ $book->title }}</h3>
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

    <h2>Google Books</h2>
    <form action="{{ url('/dashboard/books/search') }}" method="get">
        <input type="text" name="q" placeholder="Bijv. Harry Potter" value="{{ $query ?? '' }}">
        <button type="submit">Zoeken</button>
    </form>

    @if(!empty($googleBooks))
        <h2>Resultaten van Google Books</h2>
        @foreach($googleBooks as $book)
            <div style="margin-bottom:10px;">
                <strong>{{ $book['volumeInfo']['title'] ?? 'Geen titel' }}</strong><br>
                Auteur(s): {{ implode(', ', $book['volumeInfo']['authors'] ?? ['Onbekend']) }}<br>
                @if(isset($book['volumeInfo']['imageLinks']['thumbnail']))
                    <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Cover" style="height:120px;">
                @endif
            </div>
        @endforeach
    @endif
</body>
</html>