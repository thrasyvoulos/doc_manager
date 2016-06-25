<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $accountid
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $active
 * @property integer $roleid
 *
 * @property Role $role
 */
class Account extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'username', 'password', 'email', 'active', 'roleid'], 'required'],
            [['active', 'roleid'], 'integer'],
            ['username','unique','on'=>'create'],
            ['email','unique','on'=>'create'],
            [['firstname', 'lastname', 'username', 'password', 'email'], 'string', 'max' => 50],
            [['roleid'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['roleid' => 'roleid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'accountid' => 'Accountid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'active' => 'Active',
            'roleid' => 'Roleid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['roleid' => 'roleid']);
    }

    public function getAuthKey() {
        throw new \yii\base\NotSupportedException;
    }

    public function getId() {
        return $this->accountid;
    }

    public function validateAuthKey($authKey) {
        throw new \yii\base\NotSupportedException;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException;
    }
    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }
    public function validatePassword($password){
        return $this->password===$password;
    }

    
}
