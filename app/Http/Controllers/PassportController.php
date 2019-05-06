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
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userName'=>$request->userName,
            'phone'=>$request->phone,
            'SSN'=>$request->SSN,
        ]);
        if($files=$request->file('image')){
            $name=time().$files->getClientOriginalName();
            $user->image = $name;
            $files->move('image',$name);
            $user->save();
        }
        $token = $user->createToken('TutsForWeb')->accessToken;
        return response()->json(['token' => $token, 'user' => $user], 200);
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
