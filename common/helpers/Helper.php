<?php

namespace common\helpers;

/**
 * Class Helper
 * @package common\helpers
 * Набор часто используемых методов, которых нет в коробке Yii
 */
class Helper
{
    /**
     * генерация списка int значений
     * @param int $max
     * @return array
     */
    public static function getIntOptions($max = 60)
    {
        $list = [];
        for ($num = 1; $num <= $max; $num++) {
            $list[$num] = $num;
        }
        return $list;
    }

    /**
     * генерация диапазона int значений
     * @param int $min
     * @param int $max
     * @return array
     */
    public static function getRangeOptions($min = 0, $max = 60)
    {
        $list = [];
        for ($num = $min; $num <= $max; $num++) {
            $list[$num] = $num;
        }
        return $list;
    }


    public static function getRandomTimeStamp($format = 'Y-m-d H-i-s')
    {
        return date($format, mt_rand(time() - 86400 * 365, time()));
    }
}
