<?php

namespace App\Http\Controllers;

use DateTime;
use App\BookLeased;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookLease as BookLeaseResource;

class BookLeasedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $today = new DateTime('now');
        $todayTimestamp = $today->getTimestamp();
        $week = date('W', $todayTimestamp);
        $year = date('y',$todayTimestamp);
        $profit = DB::table('book_leaseds')
        ->select('NumofWeek', DB::raw('SUM(leased) as weekly_profit'))
        ->groupBy('NumofWeek')
        ->orderBy('NumofWeek', 'desc')
        ->limit(4)
        ->get();
        return response()->json([
            'profit' => $profit,
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
        $today = new DateTime('now');
        $todayTimestamp = $today->getTimestamp();
        $week = date('W', $todayTimestamp);
        $year = date('Y',$todayTimestamp);
        $bookLeased = new BookLeased;
        $bookLeased->NumOfWeek = "$year"."$week";
        // $bookLeased->Year =date('Y',$todayTimestamp);
        $bookLeased->book_id = $request->input('book_id');
        $bookLeased->user_id = Auth::id();
        $bookLeased->leased = $request->input('leased');
        if($bookLeased->save()){
            return new BookLeaseResource($bookLeased);
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
