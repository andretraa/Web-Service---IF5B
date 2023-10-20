<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::OrderBy("id","DESC")->paginate(10);

        $output = [
            "message" => "comment",
            "result" => $comment
        ];

        return response()->json($comment,200);
    }
}