<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($books as $book)
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-xl font-bold mb-2">{{ $book->title }}</h3>
            <p class="mb-1"><span class="font-semibold">Auteur:</span> {{ $book->author }}</p>
            <p class="mb-3">{{ $book->description }}</p>
            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('books.edit', $book->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-center">Edit</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit boek wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 w-full sm:w-auto">Verwijderen</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <h2 class="text-2xl font-semibold mt-8 mb-3">Google Books</h2>
    <form action="{{ url('/dashboard/books/search') }}" method="get" class="flex flex-col sm:flex-row gap-2 mb-6">
        <input type="text" name="q" placeholder="Bijv. Harry Potter" value="{{ $query ?? '' }}"
            class="flex-1 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Zoeken</button>
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