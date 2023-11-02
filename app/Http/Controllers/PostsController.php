<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $acceptHeader = $request->header("Accept");

        // 
        if ($acceptHeader === "application/json" || $acceptHeader === "application/xml") {
            $posts = Posts::OrderBy("id", "ASC")->paginate(10);

            if ($acceptHeader === "application/json") {
                // JSON
                return response()->json($posts->items('data'), 200);
            } else {
                // XML
                $xml = new \SimpleXMLElement('<posts/>');
                foreach ($posts->items('data') as $item) {
                    $xmlItem = $xml->addChild('post');
                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('post_title', $item->post_title);
                    $xmlItem->addChild('post_author', $item->post_author);
                    $xmlItem->addChild('post_category', $item->post_category);
                    $xmlItem->addChild('post_status', $item->post_status);
                    $xmlItem->addChild('post_content', $item->post_content);
                    $xmlItem->addChild('user_id', $item->user_id);
                    $xmlItem->addChild('created_at', $item->created_at);
                    $xmlItem->addChild('updated_at', $item->updated_at);
                }
                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    public function store(Request $request){
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $contentTypeHeader = $request->header('Content-Type');

            if($contentTypeHeader === 'application/json'){
                $input = $request->all();
                $post = Posts::create($input);

                return response()->json($post,200);
            } else if ($contentTypeHeader === 'application/xml'){
                $xml = new \SimpleXMLElement($request->getContent());

                $post = Posts::create([
                    'author' => $xml->author,
                    'category' => $xml->category,
                    'title' => $xml->title,
                    'status' => $xml->status,
                    'content' => $xml->content,
                    'user_id' => $xml->user_id
                ]);

                return response($post, 200);
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }
    public function show(Request $request, $id){
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $post = Posts::find($id);

            if(!$post){
                abort(404);
            }

            if($acceptHeader === 'application/json'){
                return response()->json($post,200);
            } else {
                $xml = new \SimpleXMLElement('<posts/>');

                $xmlItem = $xml->addChild('post');

                $xmlItem->addChild('id', $post->id);
                $xmlItem->addChild('author', $post->author);
                $xmlItem->addChild('category', $post->category);
                $xmlItem->addChild('title', $post->title);
                $xmlItem->addChild('status', $post->status);
                $xmlItem->addChild('content', $post->content);
                $xmlItem->addChild('created_at', $post->created_at);
                $xmlItem->addChild('updated_at', $post->updated_at);

                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }
    public function update(Request $request, $id){
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $contentTypeHeader = $request->header('Content-Type');

            if($contentTypeHeader === 'application/json'){
                $input = $request->all();
                $post = Posts::find($id);

                if(!$post){
                    abort(404);
                }

                $post->fill($input);
                $post->save();

                return response()->json($post,200);
            } else if ($contentTypeHeader === 'application/xml'){
                $xml = new \SimpleXMLElement($request->getContent());

                $post = Posts::find($id);

                if(!$post){
                    abort(404);
                }

                $post->fill([
                    'author' => $xml->author,
                    'category' => $xml->category,
                    'title' => $xml->title,
                    'status' => $xml->status,
                    'content' => $xml->content,
                    'user_id' => $xml->user_id
                ]);
                $post->save();

                return response($post, 200);
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }
    public function destroy(Request $request, $id){
        $acceptHeader = $request->header('Accept');

        if($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $post = Posts::find($id);

            if(!$post){
                abort(404);
            }

            $post->delete();
            $message = ['message' => 'deleted successfully', 'post_id' => $id];

            if($acceptHeader === 'application/json'){
                return response()->json($message,200);
            } else {
                $xml = new \SimpleXMLElement('<messages/>');

                $xmlItem = $xml->addChild('message', $message['message']);
                $xmlItem->addAttribute('post_id', $message['post_id']);

                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }
}