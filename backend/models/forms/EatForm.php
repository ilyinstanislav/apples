<?php

namespace backend\models\forms;

use backend\models\Apple;
use yii\base\Model;
use yii\db\StaleObjectException;

/**
 * Class EatForm
 * @package backend\models\forms
 *
 * @property-read int $id
 * @property-read float $size
 */
class EatForm extends Model
{
    /**
     * @var Apple
     */
    protected $apple;
    /**
     * @var int
     */
    public $id;

    /**
     * @var float
     */
    public $size;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['size', 'id'], 'required'],
            ['size', 'number', 'min' => 0.01, 'max' => 100],
            ['size', 'checkBite']
        ];
    }

    /**
     * Проверяем возможность укуса
     */
    public function checkBite()
    {
        $this->apple = Apple::findOne($this->id);

        if (!$this->apple) {
            $this->addError('size', 'Не выбрано яблоко.');
            return false;
        }

        if ($this->apple->isDecayed) {
            $this->addError('size', 'Яблоко испортилось, нельзя кушать.');
        }

        if (!$this->apple->isFalled) {
            $this->addError('size', 'Яблоко на дереве, нельзя кушать.');
        }

        if ($this->apple->eaten + $this->size > 100) {
            $this->addError('size', 'Слишком большой укус.');
        }
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'size' => 'Размер укуса, %',
        ];
    }

    /**
     * Сохранение укуса
     * @return bool|false|int
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function save()
    {
        return $this->apple->eat($this->size);
    }
}
