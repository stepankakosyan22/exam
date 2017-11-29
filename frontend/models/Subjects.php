<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property integer $subject_id
 * @property string $subject_name
 * @property string $teacher
 * @property string $start_date
 * @property string $end_date
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'safe'],
            [['subject_name', 'teacher'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_name' => 'Subject Name',
            'teacher' => 'Teacher',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * @inheritdoc
     * @return SubjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubjectsQuery(get_called_class());
    }
}
