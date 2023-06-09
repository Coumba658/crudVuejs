<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // all books
    public function index()
    {
        $books = Book::all()->toArray();
        return array_reverse($books);
    }

    // add book
    public function add(Request $request)
    {
        $book = new Book([
            'matricule' => $request->matricule,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        $book->save();

        return response()->json('Etudiant ajouté avec success!');
    }

    // edit book
    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    // update book
    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json('Etudiant modifié avec success!');
    }

    // delete book
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json('Etudiant supprimé avec success!');
    }
}
