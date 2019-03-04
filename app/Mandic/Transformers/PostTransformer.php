<?php

namespace App\Mandic\Transformers;


class PostTransformer extends Transformer
{
    /**
     * @param $post
     * @return array
     */
    public function transform($post)
    {
        return [
            'id' => $post['id'],
            'title' => $post['title'],
            'body' => $post['body'],
            'active' => (boolean) $post['active'],
        ];
    }
}