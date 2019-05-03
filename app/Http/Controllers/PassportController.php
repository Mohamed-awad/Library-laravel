<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $user = User::create($request->all());
        if($request->file('image')){
            $filename=time().'_'.$request->file('image')->getClientOriginalName();
            $path = public_path('alumni-photos/' . $filename);

        }

        /*$this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);*/

       //

        //$token = $user->createToken('TutsForWeb')->accessToken;

        ////////////////////////////////
        //$student = Student::create($request->all());

        // do we have an image to process?
        if($request->image){
            //$filename = substr( md5( $student->id . '-' . time() ), 0, 15) . '.' . $request->file('image')->getClientOriginalExtension();
            $filename = $student->id.'-'.substr( md5( $student->id . '-' . time() ), 0, 15) . '.jpg'; // for now just assume .jpg : \
            $path = public_path('alumni-photos/' . $filename);
            Image::make($request->image)->orientate()->fit(500)->save($path);

            // now update the photo column on the student record
            $student->photo = $filename;
            $student->save();
        }

        return 'success';
        ///////////////////////////////
    }
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        if($request->isEmail){
            $keyword = 'email';
        }else{
            $keyword = 'userName';
        }
        $credentials = [
            $keyword => $request->loginKeyword,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json(['token' => $token, 'user' => auth()->user()], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
