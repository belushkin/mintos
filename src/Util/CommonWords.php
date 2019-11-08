<?php

namespace App\Util;

class CommonWords
{

    /**
     * @var array
     */
    private $words = [
        'the',
        'be',
        'to',
        'of',
        'and',
        'a',
        'in',
        'that',
        'have',
        'i',
        'it',
        'for',
        'not',
        'on',
        'with',
        'he',
        'as',
        'you',
        'do',
        'at',
        'this',
        'but',
        'his',
        'by',
        'from',
        'they',
        'we',
        'say',
        'her',
        'she',
        'or',
        'an',
        'will',
        'my',
        'one',
        'all',
        'would',
        'there',
        'their',
        'what',
        'so',
        'up',
        'out',
        'if',
        'about',
        'who',
        'get',
        'which',
        'go',
        'me',
    ];

    /**
     * return common 50 English words
     *
     * @return array
     */
    public function getCommon50Words(): array
    {
        return $this->words;
    }

    /**
     * exclude common words from the string
     *
     * @param string $str
     * @return string
     */
    public function exclude50CommonWords(string $str): string
    {
        return preg_replace('/\b('.implode('|',$this->words).')\b/','', $str);
    }

}
