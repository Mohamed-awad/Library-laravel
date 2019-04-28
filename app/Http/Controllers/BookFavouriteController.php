<?php

namespace App\Http\Controllers;

use App\BookFavourite;
use Illuminate\Http\Request;

class BookFavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $bookFavorite = new BookFavourite;
        $bookFavorite->bookId = $request->input('bookId');
        $bookFavorite->userId = Auth::id();
        if($bookFavorite->save()){

            return new BookFavouriteResource($bookFavorite);
        }else{
            return response()->json([
                'msg' => 'error while saving',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookFavourite  $bookFavourite
     * @return \Illuminate\Http\Response
     */
    public function show(BookFavourite $bookFavourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookFavourite  $bookFavourite
     * @return \Illuminate\Http\Response
     */
    public function edit(BookFavourite $bookFavourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookFavourite  $bookFavourite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookFavourite $bookFavourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookFavourite  $bookFavourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookFavourite $bookFavourite)
    {
        //
    }
}
