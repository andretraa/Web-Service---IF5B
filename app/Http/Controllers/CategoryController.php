<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::OrderBy("id","DESC")->paginate(10);

        $output = [
            "message" => "category",
            "result" => $category
        ];

        return response()->json($category,200);
    }

    public function store(Request $request){
        $input = $request->all(); //mengambil semua input dari user
        $category = Category::create($input); //membuat post baru

        return response()->json($category,200); //mengembalikan data post baru dalam bentuk json
    }

    public function show($id){
        $category = Category::find($id); //mencari category berdasarkan id

        if(!$category){
            abort(404);
        }

        return response()->json($category,200);
    }

    public function update(Request $request, $id){
        $input = $request->all(); //mengambil semua input dari user
        $category = Category::find($id); //mencari post berdasarkan id

        if(!$category){
            abort(404);
        }

        $category->fill($input); //mengisi category dengan data baru dari input
        $category->save(); //menyimpan category ke database

        return response()->json($category,200); //mengembalikan data category yang baru diupdate dalam bentuk json
    }

    public function destroy($id){
        $category = Category::find($id); //mencari category berdasarkan id

        if(!$category){
            abort(404);
        }

        $category->delete(); //menghapus category

        $message = ["message" => "delete success", "post_id" => $id];

        return response()->json($message,200); //mengembalikan pesan ketika post berhasil dihapus
    }
}