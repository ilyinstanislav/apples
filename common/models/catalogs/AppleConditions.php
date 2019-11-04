<?php

namespace common\models\catalogs;

use common\components\Catalog;

/**
 * Class AppleConditions
 * @package common\models\catalogs
 */
class AppleConditions extends Catalog
{
    const ON_TREE = 0;
    const FALL = 1;
    const DECAYED = 2;

    /**
     * список ключ => значение
     * @return array
     */
    public static function getOptionsList(): array
    {
        return [
            self::ON_TREE => 'Висит на дереве',
            self::FALL => 'Упало/лежит на земле',
            self::DECAYED => 'Испортилось',
        ];
    }
}
