<?php

namespace App\Util;

class FrequencyCalculator
{

    const TEN_WORDS = 10;

    /**
     * return array of 10 most frequent words with their respective counts
     *
     * @param string $str
     * @return array
     */
    public function get10FrequentWords(string $str): array
    {
        $wordsArray = explode(" ", $str);
        $wordsArray = array_count_values($wordsArray);

        if (isset($wordsArray[''])) {
            unset($wordsArray['']);
        }
        arsort($wordsArray);

        if (count($wordsArray) > self::TEN_WORDS) {
            return array_slice($wordsArray, 0, self::TEN_WORDS);
        }
        return $wordsArray;
    }

}
