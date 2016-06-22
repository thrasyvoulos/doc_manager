<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rvperson".
 *
 * @property integer $rvpersonid
 * @property string $firstname
 * @property string $lastname
 * @property string $fathername
 * @property integer $cityid
 * @property string $address
 * @property string $zipcode
 * @property string $birthdate
 * @property string $birthplace
 * @property integer $sex
 * @property string $mobilephone
 * @property string $telephone
 * @property string $email
 * @property string $gps
 * @property string $createddate
 *
 * @property City $city
 */
class Rvperson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $countryid;
    public $prefectureid;
    public static function tableName()
    {
        return 'rvperson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'cityid', 'address', 'mobilephone', 'email', 'createddate'], 'required'],
            [['cityid', 'sex'], 'integer'],
            [['birthdate', 'createddate'], 'safe'],
            [['firstname', 'lastname', 'fathername', 'address', 'birthplace', 'email', 'gps'], 'string', 'max' => 50],
            [['zipcode', 'mobilephone', 'telephone'], 'string', 'max' => 20],
            [['cityid'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityid' => 'cityid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rvpersonid' => 'Rvpersonid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'fathername' => 'Fathername',
            'cityid' => 'Cityid',
            'address' => 'Address',
            'zipcode' => 'Zipcode',
            'birthdate' => 'Birthdate',
            'birthplace' => 'Birthplace',
            'sex' => 'Sex',
            'mobilephone' => 'Mobilephone',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'gps' => 'Gps',
            'createddate' => 'Createddate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['cityid' => 'cityid']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
     public function getAccountrvpersons()
    {
        return $this->hasMany(Accountrvperson::className(), ['rvpersonid' => 'rvpersonid']);
    }
      const SEX_MALE=1;
      const SEX_FEMALE=2;

        public function getSex()
        {
            return array(
                self::SEX_MALE=>'Male',
                self::SEX_FEMALE=>'Female',
                );
        }
        
}
