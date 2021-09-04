<?php

namespace App\Common;

/*
    Provide some formatting utilities, even if I don't need them all
*/
class Formatter
{
    public static function generateToken()
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Replace consecutive instances of $token with a different number of instances of the same token in $corpus.
     * Tokens are still counted as consecutive if they are only separated by whitespace.
     *
     * The threshold for when replacement occurs can be configured with $numFound.
     *
     * The number of times the token should actually repeat can be configured with $numPut.
     *
     * @param string $corpus The text to search.
     * @param string $token The token to collapse.
     * @param int $numFound Minimum number of times the token must repeat before it is collapsed. Default 3.
     * @param int $numPut Maximum number of consecutive tokens remaining after collapse. Default 2.
     * @return string|string[]|null
     */
    public static function collapseToken(string $corpus, string $token, $numFound = 3, $numPut = 2)
    {
        return preg_replace('/(\s*' . $token . '\s*){' . $numFound . ',}/', str_repeat($token, $numPut), $corpus);
    }

    /**
     * 
     * Takes an array like ['a', 'b' => [ 'c', 'd', 'e' ], 'f', 'g']
     * and returns a new array like ['a', 'b', 'c', 'd', 'e', 'f', 'g'].
     * 
     * Shamelessly stolen from Mason.
     * 
     * @param $array
     * @return array
     */
    public static function arrayFlattenWithKeys(array $array): array
    {
        $result = [];
        $function = function ($x, $i = null) use (&$result, &$function) {
            $x === null 
                ? null 
                : (is_array($x) 
                    ? $function($i) . array_walk($x, $function) 
                    : $result[] = $x
                );
        };

        $function($array);

        return $result;
    }

    public static function replaceKeys($old, $new, array $array): array
    {
        $reutrn = [];
        foreach ($array as $key => $value) {
            if ($key === $old) {
                $key = $new;
            }

            if (is_array($value)) {
                $value = self::replaceKeys($old, $new, $value);
            }

            $return[$key] = $value;
        }
        return $return; 
    }

    static public function stringlyBoolean($val)
    {
        return ($val === '1' || $val === 1) ? 'True' : 'False';
    }
    
    static public function jsonDecode($string)
    {
        return json_decode($string, null, 512, JSON_OBJECT_AS_ARRAY);
    }

    // https://stackoverflow.com/questions/10290849/how-to-remove-multiple-utf-8-bom-sequences
    public static function removeBOM(string $string): string
    {
        return str_replace("\xEF\xBB\xBF", '', $string);
    }

    // https://www.php.net/manual/en/function.array-diff.php#91756
    // Changed to use !== instead of !=
    public static function arrayDiffRecursive(array $aArray1, array $aArray2): array
    {
        $aReturn = [];
        foreach ($aArray1 as $mKey => $mValue) {
            if (array_key_exists($mKey, $aArray2)) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = self::arrayDiffRecursive($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) {
                        $aReturn[$mKey] = $aRecursiveDiff;
                    }
                } else {
                    if ($mValue !== $aArray2[$mKey]) {
                        $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }
        return $aReturn;
    }
    
    public static function trimRecursive(array $array): array
    {
        return array_map(function ($cell) {
            if (is_array($cell)) {
                return self::trimRecursive($cell);
            } else {
                return trim($cell);
            }
        }, $array);
    }
}
