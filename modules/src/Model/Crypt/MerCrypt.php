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
       //echo $total.PHP_EOL; 
        
        for ($i = 0; $i < $length; ++$i) {
            $salt_num = ord($salt_string[($i%$length_salt_string)]) + ($total * $i)%95;
            $crypted_num = self::rot_increase(ord($raw[$i]), $salt_num);
            //echo $salt_num."+".ord($raw[$i])."=".($salt_num+ord($raw[$i])).":".self::fix($salt_num+ord($raw[$i])).PHP_EOL;
            //echo "(".chr($crypted_num).")".$crypted_num;
            $crypted .= chr($crypted_num);
        }
        //echo PHP_EOL;
        
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
        //echo $total.PHP_EOL; 
        
        for ($i = 1; $i < $length; ++$i) {
            $salt_num = ord($salt_string[($i - 1)%$length_salt_string]) + ($total * ($i-1))%95;
            $a = ord($raw[$i]) - $salt_num;
            //echo ord($raw[$i])."-".$salt_num."=".($a).":".self::fix($a).PHP_EOL;
            $a = self::fix($a);
            $decrypted .= chr($a);
        }
        //echo PHP_EOL;
        
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
        $num = 127 + ($num - 32) % 95;
        if ($num === 127) {
            $num = 32;
        }
        return $num;
    }
}