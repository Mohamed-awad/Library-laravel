<?php

namespace App\Http\Controllers;

use App\BookRate;
use Illuminate\Http\Request;
use App\Http\Resources\BookRate as BookRateResource;

class BookRateController extends Controller
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
        $bookRate = new BookRate;
        $bookRate->bookId = $request->input('bookId');
        $bookRate->userId = Auth::id();
        $bookRate->Rate = $request->input('rate');
        if($bookRate->save()){
            return new BookRateResource($bookRate);
        }else{
            return response()->json([
                'msg' => 'error while saving',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function show(BookRate $bookRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function edit(BookRate $bookRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookRate $bookRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookRate  $bookRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookRate $bookRate)
    {
        //
    }
}
