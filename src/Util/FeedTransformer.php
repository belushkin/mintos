<?php

namespace App\Util;

class FeedTransformer
{

    /**
     * strip tags
     *
     * @param string $str
     * @return string
     */
    public function transform(string $str): string
    {
        return preg_replace('/<br \/>|–|,|\d|\.|\'|\"|\?/iU', '', strip_tags($str));
    }

}