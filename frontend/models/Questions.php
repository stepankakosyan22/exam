<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $question_id
 * @property string $question_title
 * @property string $answer_1
 * @property string $answer_2
 * @property string $answer_3
 * @property string $answer_4
 * @property integer $true_answer
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['true_answer'], 'integer','max'=>4],
            [['question_title', 'answer_1', 'answer_2', 'answer_3', 'answer_4'], 'string', 'max' => 255],
            [['question_title', 'answer_1', 'answer_2','true_answer','subject_id'], 'required'],
            ['answer_4','validateinputs'],
            ['subject_id','integer'],
            ['true_answer','validatetrueanswer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'question_title' => 'Question Title',
            'answer_1' => 'Answer 1',
            'answer_2' => 'Answer 2',
            'answer_3' => 'Answer 3',
            'answer_4' => 'Answer 4',
            'true_answer' => 'True Answer',
            'subject_id' => 'Subject',
        ];
    }
    public function validateinputs($attribute, $params, $validator)
    {
        $model = new Questions();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->answer_3=='') {
                return $this->addError($attribute, "Fill 3th answer.");
            }
        }
    }

    public function validatetrueanswer($attribute, $params, $validator)
    {
        $model = new Questions();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->answer_3==='' && $model->true_answer==3) {
                return $this->addError($attribute, "3th answer is empty.");
            }elseif ($model->answer_4==='' && $model->true_answer==4){
                return $this->addError($attribute, "4th answer is empty.");
            }
        }
    }
    public function getSubjects()
    {
        return $this->hasOne(Subjects::className(), ['subject_id' => 'subject_id']);
    }
}
