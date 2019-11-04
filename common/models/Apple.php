<?php

namespace common\models;

use common\models\catalogs\AppleColors;
use common\models\catalogs\AppleConditions;
use common\models\catalogs\AppleStatuses;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property int $color
 * @property string $dt_create
 * @property string $dt_fall
 * @property string $status
 * @property int $eaten
 */
class Apple extends ActiveRecord
{
    /**
     * Срок хранения после падения
     * @var int
     */
    public $expiration_time = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['color'], 'integer'],
            [['eaten'], 'number', 'min' => 0.00, 'max' => 100],
            [['dt_create', 'dt_fall'], 'safe'],
            [['status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'dt_create' => 'Дата появления',
            'dt_fall' => 'Дата падения',
            'status' => 'Статус',
            'eaten' => 'Сколько съедено, %',
        ];
    }

    /**
     * Получение состояния яблока
     * @return int
     */
    public function getCondition()
    {
        if ($this->status == AppleStatuses::FALL && $this->lyingDuration > $this->expiration_time) {
            return AppleConditions::DECAYED;
        }
        if ($this->status == AppleStatuses::FALL) {
            return AppleConditions::FALL;
        }
        return AppleConditions::ON_TREE;
    }

    /**
     * Получение длительности лежания яблока на земле
     * @return float|int
     */
    public function getLyingDuration()
    {
        if ($this->status == AppleStatuses::FALL && $this->dt_fall) {
            return round((time() - strtotime($this->dt_fall)) / 3600, 1, PHP_ROUND_HALF_DOWN);
        }
        return 0;
    }

    /**
     * Получение текущего цвета яблока
     * @return string|null
     */
    public function getColorCode()
    {
        return AppleColors::getColorValue($this->color);
    }

    /**
     * Получение названия текущего состояния
     * @return string|null
     */
    public function getConditionName()
    {
        return AppleConditions::getOptionValue($this->condition);
    }

    /**
     * Упало ли яблоко?
     * @return int
     */
    public function getIsFalled()
    {
        return $this->status == AppleStatuses::FALL && $this->dt_fall ? 1 : 0;
    }

    /**
     * Испортилось ли яблоко?
     * @return int
     */
    public function getIsDecayed()
    {
        return $this->condition == AppleConditions::DECAYED ? 1 : 0;
    }

    /**
     * Обработка падения яблока на землю
     * @return bool
     */
    public function fallToGround()
    {
        $this->status = AppleStatuses::FALL;
        $this->dt_fall = new Expression('NOW()');
        return $this->save();
    }

    /**
     * Получение размера остатка яблока
     * @return int
     */
    public function getSize()
    {
        return 100 - $this->eaten;
    }

    /**
     * Откусывание от яблока
     * @param float $size
     * @return bool|false|int
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function Eat(float $size)
    {
        $eaten = $this->eaten + $size;

        if ($eaten > 100) {
            return false;
        }

        if ($eaten == 100) {
            return $this->delete();
        }

        $this->eaten = $eaten;
        return $this->save();
    }
}
