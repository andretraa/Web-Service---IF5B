<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::OrderBy("id","DESC")->paginate(10);

        $output = [
            "message" => "product",
            "result" => $product
        ];

        return response()->json($product,200);
    }

    public function store(Request $request){
        $input = $request->all(); //mengambil semua input dari user
        $product = Product::create($input); //membuat post baru

        return response()->json($product,200); //mengembalikan data post baru dalam bentuk json
    }

    public function show($id){
        $product = Product::find($id); //mencari post berdasarkan id

        if(!$product){
            abort(404);
        }

        return response()->json($product,200);
    }

    public function update(Request $request, $id){
        $input = $request->all(); //mengambil semua input dari user
        $product = Product::find($id); //mencari post berdasarkan id

        if(!$product){
            abort(404);
        }

        $product->fill($input); //mengisi post dengan data baru dari input
        $product->save(); //menyimpan post ke database

        return response()->json($product,200); //mengembalikan data post yang baru diupdate dalam bentuk json
    }

    public function destroy($id){
        $product = Product::find($id); //mencari post berdasarkan id

        if(!$product){
            abort(404);
        }

        $product->delete(); //menghapus post

        $message = ["message" => "delete success", "id" => $id];

        return response()->json($message,200); //mengembalikan pesan ketika post berhasil dihapus
    }
}