<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    /**
     * Test if all posts are returned
     *
     * @return void
     */
    public function testGetPosts()
    {
        factory(Post::class, 3)->create();

        $response = $this->getJson('api/v1/posts');
        $response->assertStatus(200);

        $response = json_decode($response->getContent());
        $this->assertCount(3, $response->data);
    }

    /**
     * Create a few posts and test that the right one gets returned
     */
    public function testGetSinglePost()
    {
        $posts = factory(Post::class, 3)->create();

        $response = $this->getJson('api/v1/posts/1');
        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $this->assertEquals($posts->first()->title, $response->data->title);

        $this->assertObjectHasAttributes($response->data, ['title', 'body', 'active']);

    }

    /**
     *
     */
    public function testResponseIs404IfNoPostIsFound()
    {
        $response = $this->getJson('api/v1/posts/1');
        $response->assertStatus(404);
    }

    /**
     * Test if a given post's tags are returned
     */
    public function testGetPostsTags()
    {
        factory(Post::class, 3)->create();

        factory(Post::class)->create()->each(function ($u) {
            $u->tags()->save(factory(Tag::class)->make());
        });

        $response = $this->getJson('api/v1/posts/1/tags');

        $response->assertStatus(200);

        $response = json_decode($response->getContent());

        $this->assertObjectHasAttributes($response->data[0], ['name']);


    }

    /**
     * @param $response
     * @param $attributes
     */
    private function assertObjectHasAttributes($response, $attributes)
    {
        foreach ($attributes as $attribute) {
            $this->assertObjectHasAttribute($attribute, $response);
        }
    }
}
