<?php

namespace common\models;

class Util {

    /**
     *  Convert Color Hexadecimal to Array of RGB
     * @param type $colour
     * @return boolean
     */
    public static function hex2rgb($colour) {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('r' => $r, 'g' => $g, 'b' => $b);
    }

    /**
     * Convert Color Hexadecimal to RGB(A)
     * @param type $hex
     * @param type $opacity
     * @return string
     */
    public static function convertColorHexToRGB($hex, $opacity = null) {
        $ar = self::hex2rgb($hex);
        if (is_array($ar)) {
            if (!$opacity) {
                return "rgb({$ar['r']},{$ar['g']},{$ar['b']})";
            } else {
                return "rgba({$ar['r']},{$ar['g']},{$ar['b']},{$opacity})";
            }
        } else {
            return '';
        }
    }

    /**
     * Remove Accent from text
     * @param type $t
     * @return type
     */
    static function removeAccent($t) {
        $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
            , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç");
        $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
            , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C");
        return str_replace($array1, $array2, $t);
    }

    /**
     * Remove middle of String
     * @param type $string
     * @param type $maxChars
     * @return type
     */
    static function removeMiddleOfString($string, $maxChars, $middleString = '...') {

        $textLength = strlen($string);
        return substr_replace($string, $middleString, $maxChars / 2, $textLength - $maxChars);
    }

    /**
     * Generate a token 
     * @param type $quantity
     * @return type
     */
    static function generateHashSha256($quantity = null) {
        $token = md5(uniqid(""));
        if (!empty($quantity)) {
            return substr(hash('sha256', $token . date('dmY')), 0, $quantity);
        }
        return hash('sha256', $token . date('dmY'));
    }

    /**
     * Remove special characters 
     * @param type $str
     * @return type
     */
    static function sanitizeString($str) {
        $str = Util::removeAccent($str);
        $str = preg_replace('/ /', '', $str);
        return $str;
    }

    static function fileRemovePath($fullPath) {
        $path = pathinfo($fullPath);
        return $path['basename'];
    }

    static function getFileContents($filename) {
        return file_get_contents($filename);
    }

}
