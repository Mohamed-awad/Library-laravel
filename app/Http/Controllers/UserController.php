<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //where('token', $request->token)->first();
        return UserResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          // return view('create',['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:users|max:20|min:2',
            'userName' => 'required|unique:users|max:20|min:2',
            'phone' => 'required|unique:users|max:11',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->userName = $request->input('userName');
        $user->phone = $request->input('phone');
        $user->SSN = $request->input('SSN');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        
   
        if($user->save()){
            return new UserResource($user);
        } else {
            return new UserResource("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        $fav_book=$user->favourites()->get();
        if($fav_book){
            return new UserResource($fav_book);
        }
        else{
            return  response()->json([
                'msg' => 'error',
            ]);
        } 
        // return view('show',['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->userName = $request->input('userName');
        $user->phone = $request->input('phone');
        $user->SSN = $request->input('SSN');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        if ($user->save()) {
            return new UserResource($user);
        } else {
            return response()->json([
                'msg' => 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return new UserResource($user);
        }
    }
}
