<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\Comment as CommentResource;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $id = Auth::id();
        $user_comments = User::find(1)->comments()->get();
        if($user_comments){
            return new CommentResource($user_comments);
        }else{
            return response()->json([
                'msg' => 'error while saving',
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
        //
        $comment = new Comment;
        $comment->body = $request->input('body');
        // $comment->user_id = Auth::id();
        $comment->user_id = 6;
        $comment->book_id = $request->book_id;

        if($comment->save()){
            return new CommentResource($comment);
        }else{
            return response()->json([
                'msg' => 'error while saving',
            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($book_id)
    {
        //
        $comment=Comment::findOrFail($book_id);
        if($comment->delete()){
            return new CommentResource($comment);
        }
    }
}
