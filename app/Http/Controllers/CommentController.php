<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

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

    public function store(Request $request){
        $input = $request->all(); //mengambil semua input dari user
        $comment = Comment::create($input); //membuat post baru

        return response()->json($comment,200); //mengembalikan data post baru dalam bentuk json
    }

    public function show($id){
        $comment = Comment::find($id); //mencari comment berdasarkan id

        if(!$comment){
            abort(404);
        }

        return response()->json($comment,200);
    }

    public function update(Request $request, $id){
        $input = $request->all(); //mengambil semua input dari user
        $comment = Comment::find($id); //mencari post berdasarkan id

        if(!$comment){
            abort(404);
        }

        $comment->fill($input); //mengisi comment dengan data baru dari input
        $comment->save(); //menyimpan comment ke database

        return response()->json($comment,200); //mengembalikan data comment yang baru diupdate dalam bentuk json
    }

    public function destroy($id){
        $comment = Comment::find($id); //mencari comment berdasarkan id

        if(!$comment){
            abort(404);
        }

        $comment->delete(); //menghapus comment

        $message = ["message" => "delete success", "post_id" => $id];

        return response()->json($message,200); //mengembalikan pesan ketika post berhasil dihapus
    }
}