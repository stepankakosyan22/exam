<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $enable
 * @property integer $activated
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property string $username
 * @property string $email
 * @property integer $status
 * @property string $role
 * @property string $group
 * @property string $passport_scan
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
//            [['role'], 'required','message'=>'Choose one of roles'],
            [['name','surname'], 'string','min'=>2],
            [['name','surname','username','password'],'required','on'=>'create'],
            [['name','surname','username'],'required', 'on'=>'edit'],

            [['name','surname','username','group'],'required','on'=>'edit_student'],
            [['name','surname','username','password','passport_scan','group'],'required','on'=>'create_student'],

            [['username','password'], 'string','min'=>6, 'max'=>20],
            [['name','surname'], 'match', 'pattern' => '/^[a-zA-Z\-\s]+$/i','message'=>'There is non letter characters.'],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9\!\@\#\$\&\*\_\+\+\-\.]+$/i',
                'message'=>'Username must have letters, numbers or those symbols (! @ # $ & * _ + - .)'],

            [['passport_scan'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg','on'=>'edit_student'],
            [['passport_scan'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg','on'=>'create_student'],

            ['group','string','on'=>'edit_student'],
            ['group','string','on'=>'create_student'],

            [['password'], 'match', 'pattern' => '/^[a-zA-Z0-9\!\@\#\$\&\*\_\+\+\-\.]+$/i',
                'message'=>'Password must have English letters, numbers or those symbols (! @ # $ & * _ + - .)'],

            [['status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],

            [['role','passport_scan','group'], 'string'],

            [['activated'], 'integer'],
            [['activated'], 'default','value'=>0],

            [['enable'], 'integer'],
            [['enable'], 'default','value'=>1],

            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'unique'],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['name','surname','username','password','role'];
        $scenarios['edit'] = ['name','surname','username','password','enable','role'];
        $scenarios['edit_student'] =   ['name','surname','username','password','enable','role','group','passport_scan'];
        $scenarios['create_student'] = ['name','surname','username','password','enable','role','group','passport_scan'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'username' => 'Username',
            'email' => 'Email',
            'status' => 'Status',
            'role' => 'Role',
            'password' => 'Password',
            'passport_scan' => 'Passport scan',
            'group' => 'Group',
            'enable' => 'Enable',
            'activated' => 'Activated',
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
        $user = new User();
        $user->username = $this->username;
        $user->role = $this->role;
        $user->name = $this->name;
        $user->enable = $this->enable;
        $user->activated = $this->activated;
        $user->surname = $this->surname;
        $user->passport_scan = $this->passport_scan;
        $user->group = $this->group;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();
        return  $user ;
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
