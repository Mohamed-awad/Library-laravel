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
        //return "ssssss";

        $book = BookResource::collection(Book::with('category')->get());

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
        //$book->image = $request->input('image');
        $book->NumberOfBook = $request->input('NumberOfBook');
        $book->category_id = $request->input('category_id');
        $book->leasePerDay = $request->input('leasePerDay');
        if($files=$request->file('image')){
            $name=time().$files->getClientOriginalName();
            $book->image = $name;
            $files->move('image',$name);
        }

        if($book->save  ()){
            return new BookResource($book);
        }
        else{
            return ("error");
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
        $book = new Book;
        $book=Book::findOrFail($id);
        return new BookResource($book);
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

            $book = new Book;
            $book=Book::findOrFail($id);
            //return new  BookResource($book);
            $book->title = $request->input('title');
            $book->description = $request->input('description');
            $book->author = $request->input('author');
            $book->NumberOfBook = $request->input('NumberOfBook');
            $book->category_id = $request->input('category_id');
            $book->leasePerDay = $request->input('leasePerDay');
            if($book->save()){
                return new BookResource($book);
            }else{
                return response()->json([
                    'msg' => 'error while updating',
                ]);
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
