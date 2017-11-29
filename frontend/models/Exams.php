<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "exams".
 *
 * @property integer $exam_id
 * @property integer $teacher_id
 * @property integer $subject_id
 * @property integer $group_id
 * @property string $start
 * @property integer $duration
 * @property integer $active
 */
class Exams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'subject_id', 'duration', 'active','group_id'], 'integer'],
            [['start'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exam_id' => 'Exam ID',
            'teacher_id' => 'Teacher ID',
            'subject_id' => 'Subject ID',
            'start' => 'Start',
            'duration' => 'Duration',
            'active' => 'Active',
            'group_id' => 'Group',
        ];
    }
}
