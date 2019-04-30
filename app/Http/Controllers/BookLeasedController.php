<?php

namespace App\Http\Controllers;

use App\BookLeased;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookLeasedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'msg' => 'hi from index@book leased',
        ]);

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
        $bookLeased = new BookLeased;
        $bookLeased->bookId = $request->input('bookId');
        $bookLeased->userId = Auth::id();
        $bookLeased->leased = $request->input('leased');
        if($bookLeased->save()){

            return new BookLeasedResource($bookLeased);
        }else{
            return response()->json([
                'msg' => 'error while saving',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookLeased  $bookLeased
     * @return \Illuminate\Http\Response
     */
    public function show(BookLeased $bookLeased)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookLeased  $bookLeased
     * @return \Illuminate\Http\Response
     */
    public function edit(BookLeased $bookLeased)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookLeased  $bookLeased
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookLeased $bookLeased)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookLeased  $bookLeased
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookLeased $bookLeased)
    {
        //
    }
}
