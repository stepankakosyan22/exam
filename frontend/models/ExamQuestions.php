<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "exam_question".
 *
 * @property integer $exq_id
 * @property integer $exam_id
 * @property integer $question_id
 */
class ExamQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_id', 'question_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exq_id' => 'Exq ID',
            'exam_id' => 'Exam ID',
            'question_id' => 'Question ID',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsQuestion(){
        return $this->hasMany(Questions::className(), ['question_id'=>'question_id']);
    }
}
