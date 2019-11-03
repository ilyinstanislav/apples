<?php

namespace common\models\catalogs;

use common\components\Catalog;
use yii\helpers\ArrayHelper;

/**
 * Class AppleColors
 * @package common\models\catalogs
 */
class AppleColors extends Catalog
{
    const GREEN = 0;
    const YELLOW = 1;
    const RED = 2;
    const WHITE = 3;

    /**
     * список ключ => значение
     * @return array
     */
    public static function getOptionsList(): array
    {
        return [
            self::GREEN => 'Зеленое',
            self::YELLOW => 'Желтое',
            self::RED => 'Красное',
            self::WHITE => 'Белое',
        ];
    }

    /**
     * Цвета для отображения
     * @return array
     */
    public static function getColorsList(): array
    {
        return [
            self::GREEN => 'green',
            self::YELLOW => 'yellow',
            self::RED => 'red',
            self::WHITE => 'white',
        ];
    }

    /**
     * Получение рандомного цвета
     * @return int
     */
    public static function getRandom()
    {
        return array_rand(self::getKeys());
    }

    /**
     * Получение цвета по ключу
     * @param $value
     * @return string|null
     */
    public static function getColorValue($value)
    {
        $list = static::getColorsList();
        return ArrayHelper::getValue($list, $value, null);
    }
}
