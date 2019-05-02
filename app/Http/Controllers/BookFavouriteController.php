<?php

namespace App\Http\Controllers;

use App\BookFavourite;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\BookFavourite as BookFavouriteResource;

class BookFavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //return fav of spacific user
         $user = User::find($user_id);
         $fav_book=$user->favourites()->get();
         if($fav_book){
             return new BookFavouriteResource($fav_book);
         }
         else{
             return  response()->json([
                 'msg' => 'error',
             ]);
         }
        //return all favourites
        //return BookFavouriteResource::collection(BookFavourite::all());
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
    public function store($user_id,$book_id)
    {
        //
        $book_fav = new BookFavourite;
        $book_fav->user_id=$user_id;
        $book_fav->book_id=$book_id;
        if($book_fav->save()){
            return new BookFavouriteResource($book_fav);
        }
        else{
            return new BookFavouriteResource("error");
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
    public function destroy($user_id,$book_id)
    {
        //
       $book_fav = BookFavourite::where(['user_id'=>$user_id,'book_id'=>$book_id])->first();
        if($book_fav->delete()){
            return new BookFavouriteResource($book_fav);
        }
        // return redirect('/contact');
    }
}
