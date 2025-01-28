<?php

declare(strict_types = 1);

namespace App\Enums;

use Illuminate\Support\Arr;

trait EnumTrait
{

    /**
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }


    /**
     * @return array
     */
    public static function values(array $params  =  [] , ? bool $is_string = false): array
    {
        $result = array_column(self::cases(), 'value');
 
        if(count($params) > 0){
            $result  = [];
            foreach($params as $param){
                $result [] = self::value($param);
            }
        }

        if($is_string){
            $result = array_map('strval', $result);
        }

        return $result;
    }


    /**
     * @return array
     */
    public static function toArray(): array
    {
        return array_combine(self::names(), self::values(),);
    }


    /**
     * @return array
     */
    public static function value(mixed $param , ? bool $is_string = false): mixed {
        
        $res = Arr::get(self::toArray(),$param,null);
        if($res && $is_string){
            $res  = strval($res);
        }
        return $res;
    }


     /**
     * @return array
     */
    public static function keyVal(mixed $param , ? bool $is_string = false): mixed {
        $res = Arr::get(array_flip(self::toArray()),$param,null);
        if($res && $is_string){
            $res  = strval($res);
        }
        return $res;
    }

}
