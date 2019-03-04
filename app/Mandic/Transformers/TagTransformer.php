<?php

namespace App\Mandic\Transformers;


class TagTransformer extends Transformer
{
    /**
     * @param $tag
     * @return array
     */
    public function transform($tag)
    {
        return [
            'id' => $tag['id'],
            'name' => $tag['name'],
        ];
    }
}