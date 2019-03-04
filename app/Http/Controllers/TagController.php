<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Response;
use App\Mandic\Transformers\TagTransformer;



class TagController extends ApiController
{
    private $tagTransformer;

    /**
     * TagController constructor.
     * @param $tagTransformer
     */
    public function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::all();

        return Response::json([
            'data' => $this->tagTransformer->transformCollection($tags->toArray())
        ],200);
    }

    /**
     * Display all the tags for a specific post
     *
     * @param $id
     * @return mixed
     */
    public function postTags($id)
    {
        $tags = $this->getTags($id);

        if(!$tags) {
            return $this->respond('Post not found', 404);
        }
        return Response::json([
            'data' => $this->tagTransformer->transformCollection($tags->toArray())
        ],200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * @param $id
     * @return Tag[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTags($id)
    {
        $post = Post::find($id);

        if (!$post){
            return null;
        }

        return $post->tags;
    }

}
