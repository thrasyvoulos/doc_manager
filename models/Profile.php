<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $profileid
 * @property integer $accountid
 * @property integer $specialtiesid
 * @property string $firstname
 * @property string $lastname
 * @property string $fathersname
 * @property integer $cityid
 * @property string $address
 * @property string $zipcode
 * @property string $birthdate
 * @property string $birthplace
 * @property integer $sex
 * @property string $mobilephone
 * @property string $telephone
 * @property string $email
 * @property string $note
 * @property string $logo
 * @property string $gps
 * @property string $createddate
 *
 * @property Account $account
 * @property Specialties $specialties
 * @property City $city
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $countryid;
    public $prefectureid;
    public $file;
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accountid', 'specialtiesid', 'firstname', 'lastname', 'cityid', 'address', 'zipcode',  'sex', 'mobilephone', 'email','createddate'], 'required','on'=>'create'],
            [['accountid', 'specialtiesid', 'cityid', 'sex'], 'integer'],
            [['birthdate', 'createddate'], 'safe'],
            [['firstname', 'lastname', 'address', 'birthplace', 'email', 'gps','fathersname'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 1000],
            [['logo'], 'string', 'max' => 200],
            [['file'],'file'],
            [['zipcode', 'mobilephone', 'telephone'], 'string', 'max' => 20],
            [['accountid'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['accountid' => 'accountid']],
            [['specialtiesid'], 'exist', 'skipOnError' => true, 'targetClass' => Specialties::className(), 'targetAttribute' => ['specialtiesid' => 'specialtiesid']],
            [['cityid'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['cityid' => 'cityid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profileid' => Yii::t('app', 'Profileid'),
            'accountid' => Yii::t('app', 'Accountid'),
            'specialtiesid' => Yii::t('app', 'Specialty'),
            'firstname' => Yii::t('app', 'First Name'),
            'lastname' => Yii::t('app', 'Last Name'),
            'fathersname' => Yii::t('app', 'Father Name'),
            'cityid' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'zipcode' => Yii::t('app', 'Zip Code'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'birthplace' => Yii::t('app', 'Birthplace'),
            'sex' => Yii::t('app', 'Sex'),
            'mobilephone' => Yii::t('app', 'Mobile phone'),
            'telephone' => Yii::t('app', 'Telephone'),
            'email' => Yii::t('app', 'Email'),
            'gps' => Yii::t('app', 'Gps'),
            'createddate' => Yii::t('app', 'Createddate'),
            'countryid'=>Yii::t('app','Country'),
            'prefectureid'=>Yii::t('app','Prefecture'),
            'note'=>Yii::t('app','Note'),
            'file'=>'Logo',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['accountid' => 'accountid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialties()
    {
        return $this->hasOne(Specialties::className(), ['specialtiesid' => 'specialtiesid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['cityid' => 'cityid']);
    }
    const SEX_MALE=1;
    const SEX_FEMALE=2;

    public function getSex()
    {
        return array(
            self::SEX_MALE=>Yii::t('app','Male'),
            self::SEX_FEMALE=>Yii::t('app','Female'),
        );
    }
}
