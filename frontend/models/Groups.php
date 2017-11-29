<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id_group
 * @property string $group_name
 * @property string $group_start
 * @property string $group_end
 * @property integer $archived
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_start', 'group_end'], 'safe'],
            [['group_start', 'group_end','group_name'], 'required'],
            [['archived'], 'integer'],
            [['group_end'], 'validateDates'],
            [['archived'], 'default','value'=>0],
            [['group_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_group' => 'Id Group',
            'group_name' => 'Group Name',
            'group_start' => 'Group Start',
            'group_end' => 'Group End',
            'archived' => 'Archived',
        ];
    }

    public function validateDates($attribute, $params, $validator)
    {
        $model = new Groups();

        if ($model->load(\Yii::$app->request->post())) {
            if (strtotime($model->group_end) < strtotime($model->group_start)) {
                return $this->addError($attribute, "Start date cannot be small then end date.");
            }
        }
    }

}
