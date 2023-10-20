<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class AboutController extends Controller
{
    public function about()
    {
        return response()->json([
            'message' => 'This is the about page of this web.',
            'version' => '10.0.1',
            'author' => 'Andre Tri Rizky',
            'email' => 'andretra@example.com'
        ], Response::HTTP_OK);    
    }
}