<?php

namespace backend\models\forms;

use common\models\Apple;
use Throwable;
use yii\base\Model;
use yii\db\StaleObjectException;

/**
 * Class EatForm
 *
 * @package backend\models\forms
 *
 * @property-read int   $id
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
    public function rules(): array
    {
        return [
            [['size', 'id'], 'required'],
            ['size', 'number', 'min' => 0.01, 'max' => 100],
            ['size', 'checkBite']
        ];
    }

    public function init()
    {
        $this->apple = Apple::findOne($this->id);
    }

    /**
     * @return false
     */
    public function checkBite()
    {
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
    public function attributeLabels(): array
    {
        return [
            'size' => 'Размер укуса, %',
        ];
    }

    /**
     * Сохранение укуса
     *
     * @return bool|false|int
     */
    public function save()
    {
        return $this->eat($this->size);
    }

    /**
     * @param float $size
     *
     * @return bool|int
     * @throws StaleObjectException
     * @throws Throwable
     */
    private function eat(float $size)
    {
        $eaten = $this->apple->eaten + $size;

        if ($eaten > 100) {
            return false;
        }

        if ($eaten === (float)100) {
            return $this->apple->delete();
        }

        $this->apple->eaten = $eaten;

        return $this->apple->save(true, ['eaten']);
    }
}
