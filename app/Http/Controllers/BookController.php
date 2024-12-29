<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|integer',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'message' => 'Buku aman ditambah bree!!',
            'book' => $book,
        ], 201);
    }
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku takde'], 404);
        }

        return response()->json($book, 200);
    }
    public function update(Request $request, $id)
    {
        Log::info('Request method: ' . $request->method());
        Log::info('Request URL: ' . $request->url());
        Log::info('Book ID: ' . $id);
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku takde'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|integer',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Buku diganti bre!',
            'book' => $book,
        ], 200);
    }
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku Ilang'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Buku kehapus!'], 200);
    }
}
