<?php

namespace App\Http\Controllers;

use App\Mandic\Transformers\PostTransformer;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostController extends ApiController
{
    protected $postTransformer;

    /**
     * PostController constructor.
     * @param PostTransformer $postTransformer
     */
    function __construct(PostTransformer $postTransformer)
    {
        $this->postTransformer = $postTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return Response::json([
            'data' => $this->postTransformer->transformCollection($posts->toArray())
        ],200);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if(!$post) {
            return $this->respond('Post not found', 404);
        }

        return Response::json([
            'data' => $this->postTransformer->transform($post)
        ]);
    }

}
