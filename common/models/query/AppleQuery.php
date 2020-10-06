<?php

namespace common\models\query;

use common\models\Apple;
use yii\db\ActiveQuery;
use yii\db\Connection;

/**
 * Class AppleQuery
 *
 * @see Apple
 */
class AppleQuery extends ActiveQuery
{
    /**
     * @param null|Connection $db
     *
     * @return array|Apple[]
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * @param null|Connection $db
     *
     * @return null|array|Apple
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $id
     *
     * @return AppleQuery
     */
    public function byId($id): AppleQuery
    {
        return $this->andWhere(['id' => $id]);
    }
}