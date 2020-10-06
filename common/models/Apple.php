<?php

namespace common\models;

use common\models\catalogs\AppleColors;
use common\models\catalogs\AppleConditions;
use common\models\catalogs\AppleStatuses;
use common\models\query\AppleQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apples".
 *
 * @property int              $id
 * @property int              $color
 * @property string           $dt_create
 * @property string           $dt_fall
 * @property string           $status
 * @property-read null|string $conditionName
 * @property-read null|string $colorCode
 * @property-read float|int   $lyingDuration
 * @property-read int         $isDecayed
 * @property-read int         $size
 * @property-read int         $condition
 * @property-read int         $isFalled
 * @property int              $eaten
 */
class Apple extends ActiveRecord
{
    /**
     * Срок хранения после падения
     *
     * @var int
     */
    public $expirationTime = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    public function attributeLabels(): array
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
     *
     * @return int
     */
    public function getCondition(): int
    {
        if ($this->status === AppleStatuses::FALL && $this->lyingDuration > $this->expirationTime) {
            return AppleConditions::DECAYED;
        }
        if ($this->status === AppleStatuses::FALL) {
            return AppleConditions::FALL;
        }
        return AppleConditions::ON_TREE;
    }

    /**
     * Получение длительности лежания яблока на земле
     *
     * @return float|int
     */
    public function getLyingDuration()
    {
        if ($this->status === AppleStatuses::FALL && $this->dt_fall) {
            return round((time() - strtotime($this->dt_fall)) / 3600, 1, PHP_ROUND_HALF_DOWN);
        }
        return 0;
    }

    /**
     * Получение текущего цвета яблока
     *
     * @return string|null
     */
    public function getColorCode()
    {
        return AppleColors::getColorValue($this->color);
    }

    /**
     * Получение названия текущего состояния
     *
     * @return string|null
     */
    public function getConditionName()
    {
        return AppleConditions::getOptionValue($this->condition);
    }

    /**
     * Упало ли яблоко?
     *
     * @return int
     */
    public function getIsFalled(): int
    {
        return $this->status === AppleStatuses::FALL && $this->dt_fall ? 1 : 0;
    }

    /**
     * Испортилось ли яблоко?
     *
     * @return int
     */
    public function getIsDecayed(): int
    {
        return $this->condition === AppleConditions::DECAYED ? 1 : 0;
    }

    /**
     * Получение размера остатка яблока
     *
     * @return int
     */
    public function getSize(): int
    {
        return 100 - $this->eaten;
    }

    /**
     * @return AppleQuery
     */
    public static function find(): AppleQuery
    {
        return new AppleQuery(static::class);
    }
}
