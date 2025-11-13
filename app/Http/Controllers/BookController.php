<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact ('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Boek is gepost');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $books = Book::findOrFail($id);
        return view('books.edit', compact('books'));
    }

   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
        ]);

        $books = Book::findOrFail($id); // vind het boek 
        $books ->update($validated); // Update een boek 
        
        return redirect()->route('books.index')->with('success', 'Boek is geupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $books = Book::findOrFail($id); // vind een boek
         $books->delete(); //delete een boek

          return redirect()->route('books.index')->with('success', 'Boek is verwijderd');
    }
}
