<?php

namespace common\components;

use yii\helpers\ArrayHelper;

/**
 * Class Catalog
 * Базовый класс статических справочников
 * @package common\components
 */
abstract class Catalog
{
    /**
     * список ключ => значение
     * @return array
     */
    abstract static function getOptionsList(): array;

    /**
     * получение значения по ключу
     * @param $value
     * @return string|null
     */
    public static function getOptionValue($value)
    {
        $list = static::getOptionsList();
        return ArrayHelper::getValue($list, $value, null);
    }

    /**
     * список возможных значений
     * @return array
     */
    public static function getKeys()
    {
        return array_keys(static::getOptionsList());
    }

}
