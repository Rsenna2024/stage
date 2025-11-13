<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Het toevoegen van een nieuw boek</h1>

    <form method="POST" action="{{ route('books.store') }}">         
        @csrf 
        <label>Titel:</label>
        <input type="text" name="title" value="{{ old('title') }}">
        
        <label>Auteur:</label>
        <textarea name="author"> {{ old('author') }}</textarea>

        <label>Beschrijving:</label>
        <textarea name="description"> {{ old('description') }}</textarea>

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