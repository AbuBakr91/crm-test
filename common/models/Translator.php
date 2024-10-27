<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "translator".
 *
 * @property integer $id
 * @property string $name
 * @property string $working_days JSON-encoded string of working days
 * @property integer $task_count The number of tasks currently assigned to the translator
 * @property integer $created_at Timestamp when the translator was created
 * @property integer $updated_at Timestamp when the translator was last updated
 *
 * @property array $workingDaysArray Array representation of working days
 */
class Translator extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%translator}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'working_days'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['working_days'], 'string'],
            [['task_count'], 'integer', 'min' => 0],
        ];
    }

    /**
     * @var array|null This will hold the decoded array of working days
     */
    private ?array $_workingDaysArray;

    /**
     * Gets the working days array.
     *
     * @return array|null
     */
    public function getWorkingDaysArray(): ?array
    {
        if ($this->_workingDaysArray === null) {
            $this->_workingDaysArray = json_decode($this->working_days, true);
        }
        return $this->_workingDaysArray;
    }

    /**
     * Sets the working days array and encodes it as JSON.
     *
     * @param array $value
     */
    public function setWorkingDaysArray(array $value): void
    {
        $this->_workingDaysArray = $value;
        $this->working_days = json_encode($value);
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind(): void
    {
        parent::afterFind();
        $this->_workingDaysArray = json_decode($this->working_days, true);
    }
}