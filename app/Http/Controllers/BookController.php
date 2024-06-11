<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display a listing of the books.
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book.
    public function create()
    {
        return view('books.create');
    }

    // Store a newly created book in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/images', $imageName);
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Book created successfully.');
    }

    // Show the form for editing the specified book.
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Update the specified book in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Book::findOrFail($id);

        $imageName = $book->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->storeAs('public/images', $imageName);
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Book updated successfully.');
    }

    // Remove the specified book from storage.
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Book deleted successfully.');
    }
}
