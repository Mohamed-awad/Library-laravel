<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index($book_id)
    {

        $comments = DB::table('comments')->leftjoin('users','users.id','=', 'comments.user_id')->where('book_id', '=', $book_id)->get();
        if($comments){
            return response()->json([
                'comments' => $comments,
            ]);
        }else{
            return response()->json([
                'msg' => 'error while savinggg',
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
    public function store(Request $request, $book_id, $user_id)
    {
        //
        $comment = new Comment;
        $comment->body = $request->input('body');
        // $comment->user_id = Auth::id();
        $comment->user_id = $user_id;
        $comment->book_id = $book_id;

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
    public function destroy($comment_id)
    {
        //
        $comment=Comment::findOrFail($comment_id);
        if($comment->delete()){
            return new CommentResource($comment);
        }
    }
}
