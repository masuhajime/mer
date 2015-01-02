<?php namespace Mer\Model\Crypt;

class TestMerCrypt extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider cryptRaw
     */
    public function MerCryptで復号化出来る($key, $raw)
    {
        $crypt = \Mer\Model\Crypt\MerCrypt::crypt($raw, $key);
        $decrypt = \Mer\Model\Crypt\MerCrypt::decrypt($crypt, $key);
        
        /*
        echo PHP_EOL;
        echo "crypt:".$crypt.PHP_EOL;
        echo "decry: ".$decrypt.PHP_EOL;
        exit;
        //*/
        
        $this->assertSame($raw, $decrypt);
    }
    
    public function cryptRaw2()
    {
        return [
            [
                '93ys',
                '{"name": "John Smith", "age": 33}{'
            ],
        ];
    }
    
    public function cryptRaw()
    {
        return [
            [
                '#98h!Po;93ys',
                'aaaaaaaaaaaaaaaaaaaaaaaaaaa{"name": "Matt Smith", "age": 34}'
            ],
            [
                '#98h!Po;93ys',
                'aaaaaaaaaaa{"name": "John Smith", "age": 34}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}{"name": "John Smith", "age": 33}'
            ],
            ['a', 'a'],
            [
                '!8h0i`982{}', 
                '\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"\'\"',
            ],
            [
                '!&"!&$"F()"',
                '+LJ0FUPOJihofh3p08y7OK"PPKJG#"(PG)#P::kp1@2J#PJ+3jpg;jaaaaaaaa*G+#K`"K*ksldfj;f:gw|"`O#J+O#J'
            ],
            [
                'h@:*^=0p?.<',
                '32hfh3pg4hphgheps34UHT67gUYGZGFp23@3^-23-2p@23lr;l3:2r@pjJOPAU)38h3oifhhfh3io8OI#(H#OFHO'
            ],
            [
                'jkh)(SHFPwk;3f2j33;+K#F*#FK"#JFOJ',
                'lhwoifhpH!"!`J!"}#K}K]]kjf:g[]@g0o33223~||!#I=~#!+*S<>?<_<ZXV*LAOJJ`J$ITJjklejgl;wejgu294u(H#OPJ$PO"PJkjdj;gsroj;hj:4ejhhhr9hjwJ#GJODLSJP)#JOGJJ+G*SD*GJ*#}{#}{#}L}}{#L}L]]]l]3lt]l3'
            ],
            [
                '}+}{}{|?|`?~`+|*|_|}|{}{|}|}{{}}||~`+?|~{_}_|{|``',
                '}*}+~{P~|={*}?_>}*+{}P~|>?<?_<_+}*{=~|=~|0=P+?<?_>_>}*+{`P~~|~`}*+*}>?_>?_<_*+}*P~00(()()()~=|{{}}{{}{{}{{*>?_<_*+}`|~*}>+*L{P`O{*}_<?<_*}P|~)(()(%%&"&>?_}{}}{}}{}{}}{}`*+*>*}{{~{`**?_?}`{`{P{`P{=0()(()&&%%*>_?>}*+}`P*}',
            ],
            [
                '123456',
                '}*}+~{P~|={*}?_>}*+{}P~|>?<?_<_+}*{=~|=~|0=P+?<?_>_>}*+{`P~~|~`}*+*}>?_>?_<_*+}*P~00(()()()~=|{{}}{{}{{}{{*>?_<_*+}`|~*}>+*L{P`O{*}_<?<_*}P|~)(()(%%&"&>?_}{}}{}}{}{}}{}`*+*>*}{{~{`**?_?}`{`{P{`P{=0()(()&&%%*>_?>}*+}`P*}',
            ],
            [
                '{{{{{',
                '}*}+~{P~|={*}?_>}*+{}P~|>?<?_<_+}*{=~|=~|0=P+?<?_>_>}*+{`P~~|~`}*+*}>?_>?_<_*+}*P~00(()()()~=|{{}}{{}{{}{{*>?_<_*+}`|~*}>+*L{P`O{*}_<?<_*}P|~)(()(%%&"&>?_}{}}{}}{}{}}{}`*+*>*}{{~{`**?_?}`{`{P{`P{=0()(()&&%%*>_?>}*+}`P*}',
            ],
            [
                '{{{{{',
                '{"name": "John Smith", "age": 34}["milk", "bread", "eggs"]{"name": "John Smith", "age": 34}["milk", "bread", "eggs"]{"name": "John Smith", "age": 34}["milk", "bread", "eggs"]{"name": "John Smith", "age": 34}["milk", "bread", "eggs"]',
            ],
        ];
    }
}
