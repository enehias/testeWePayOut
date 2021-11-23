<?php

use \Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


    /**
     * @param $item
     * @return string|string[]|null
     */
    function tagear($item)
    {
        //Transformando o titulo em tag
        $urlP = $item;
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z',
            'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
            'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
            'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
        );
        // Traduz os caracteres em $string, baseado no vetor $table
        $urlP = strtr($urlP, $table);
        // converte para minúsculo
        $urlP = strtolower($urlP);
        // remove caracteres indesejáveis (que não estão no padrão)
        $urlP = preg_replace("/[^a-z0-9_\s-]/", "", $urlP);
        // Remove múltiplas ocorrências de hífens ou espaços
        $urlP = preg_replace("/[\s-]+/", " ", $urlP);
        // Transforma espaços e underscores em hífens
        $urlP = preg_replace("/[\s_]/", "-", $urlP);
        //Transformando o titulo em tag
        return $urlP;
    }


    /**
     * @param $string
     * @return bool|false|string|string[]|null
     */
    function sanitizeString($string) {

        $stringinfo = trim($string);
        $what = array( 'Ã', 'Õ', 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á',
            'É','Í','Ó','Ú','ñ','Ñ','ç','Ç',' ','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
        $by   = array( 'A', 'O', 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A',
            'E','I','O','U','n','n','c','C',' ','','','','','','','','','','','','','','','','','','','','','','' );
        $return = str_replace($what, $by, $stringinfo);
        return mb_convert_case($return, MB_CASE_UPPER, "UTF-8");
    }


    function verifyServeURL($url)
    {
        return $_SERVER["SERVER_NAME"] == $url;
    }

    function testConnection()
    {
        // Test database connection
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            if(env('APP_ENV')=='local')
                dd("Error {$e}");

            return false;
        }
    }
