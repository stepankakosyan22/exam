<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $username
 * @property string $email
 * @property integer $status
 * @property string $role
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 */
class User extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'required','message'=>'Choose one of roles'],
            [['full_name','username','password'], 'required'],
            [['full_name'], 'string','min'=>2],
            [['prof_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['username','password'], 'string','min'=>6, 'max'=>20],
            [['full_name'], 'match', 'pattern' => '/^[a-zA-Z\-\s]+$/i','message'=>'There is non letter characters.'],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9\!\@\#\$\&\*\_\+\+\-\.]+$/i',
                'message'=>'Username must have letters, numbers or those symbols (! @ # $ & * _ + - .)'],
            [['password'], 'match', 'pattern' => '/^[a-zA-Z0-9\!\@\#\$\&\*\_\+\+\-\.]+$/i',
                'message'=>'Password must have English letters, numbers or those symbols (! @ # $ & * _ + - .)'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'username' => 'Username',
            'email' => 'Email',
            'status' => 'Status',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function creatingUser()
    {
//        if (!$this->validate()) {
//            return null;
//        }

        $user = new User();
        $user->username = $this->username;
        $user->role = $this->role;
        $user->full_name = $this->full_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
