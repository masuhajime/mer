<?php namespace Mer\Model\Crypt;

// どうすればよかったんかねえ・・・
// openssl crypt使いたかったが記号は居るし

abstract class MerCrypt {
    
    private static $_HEAD = 32;
    private static $_FOOT = 126;
    private static $_DIFF = 94;
    
    public static function crypt($raw, $salt_string)
    {
        $crypted = '';
        $length = strlen($raw);
        $length_salt_string = strlen($salt_string);
        
        $total = 0;
        for ($i = 0; $i < $length; ++$i) {
            $total += ($i+1) * ord($raw[$i]);
        }
        $total = ($total % (self::$_DIFF + 1));
         
        for ($i = 0; $i < $length; ++$i) {
            $salt_num = $salt_string[$i%$length_salt_string] + $total;//($total * ($i%10));
            $crypted .= chr(self::rot_increase(ord($raw[$i]), $salt_num));
        }
        
        return chr($total + self::$_HEAD).$crypted;
    }
    
    private static function rot_increase($char_num, $salt_num)
    {
        $num = $char_num + $salt_num;
        $num = self::fix($num);
        return $num;
    }
    
    public static function decrypt($raw, $salt_string)
    {
        $decrypted = '';
        $length = strlen($raw);
        $length_salt_string = strlen($salt_string);
        
        $total = ord($raw[0]) - self::$_HEAD;
        
        for ($i = 1; $i < $length; ++$i) {
            $salt_num = $salt_string[($i - 1)%$length_salt_string] + $total;//($total*(($i-1)%10));
            $a = ord($raw[$i]) - $salt_num;
            $a = self::fix($a);
            $decrypted .= chr($a);
        }
        
        return $decrypted;
    }
    
    private static function rot_decrease($char_num, $salt_num)
    {
        $num = $char_num - $salt_num;
        return self::fix($num);
    }
    
    private static function fix($num)
    {
        if (32 <= $num) {
            return ($num - 32) % 95 + 32;
        }
        return 127 + ($num - 32) % 96;
    }
}