<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

use App\Http\Resources\Book as BookResource;
use mysql_xdevapi\Collection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = BookResource::collection(Book::all());

        if($book){
            return $book;
        }else{
            return response()->json([
                'msg' => 'error while getting book',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->author = $request->input('author');
        $book->image = $request->input('image');
        $book->NumberOfBook = $request->input('NumberOfBook');
        $book->category_Id = $request->input('categoryId');
        $book->leasePerDay = $request->input('leasePerDay');
        if($book->save  ()){
            return new BookResource($book);
        }
        else{
            return new BookResource("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
        $book_comment = Book::find($id)->comments()->get();
        if($book_comment ){
            return new BookResource($book_comment);
        }
        else{
            return  response()->json([
                'msg' => 'error',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        {
            $book = new Book;
            $book=Book::findOrFail($id);
            $book->title = $request->input('title');
            $book->description = $request->input('description');
            $book->author = $request->input('author');
            $book->image = $request->input('image');
            $book->NumberOfBook = $request->input('NumberOfBook');
            $book->categoryId = $request->input('categoryId');
            $book->leasePerDay = $request->input('leasePerDay');
            if($book->save()){
                return new BookResource($book);
            }else{
                return response()->json([
                    'msg' => 'error while updating',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::findOrFail($id);
        if($book->delete()){
            return new BookResource($book);
        }else{
            return response()->json([
                'msg' => 'error while deleting',
            ]);
        }
    }
}
