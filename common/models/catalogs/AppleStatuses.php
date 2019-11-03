<?php

namespace common\models\catalogs;

use common\components\Catalog;

/**
 * Class AppleStatuses
 * @package common\models\catalogs
 */
class AppleStatuses extends Catalog
{
    const ON_TREE = 0;
    const FALL = 1;

    /**
     * список ключ => значение
     * @return array
     */
    public static function getOptionsList(): array
    {
        return [
            self::ON_TREE => 'На дереве',
            self::FALL => 'Упало',
        ];
    }
}
