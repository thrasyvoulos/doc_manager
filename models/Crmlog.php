<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crmlog".
 *
 * @property integer $crmlogid
 * @property integer $crmtypeid
 * @property string $description
 * @property integer $accountid
 * @property integer $rvpersonid
 * @property string $createddate
 * @property string $fromdate
 * @property string $todate
 * @property integer $status
 *
 * @property Crmtype $crmtype
 * @property Account $account
 * @property Rvperson $rvperson
 */
class Crmlog extends \yii\db\ActiveRecord
{   
    /**
     * @inheritdoc
     */
        const CRMTYPE_RENDEZVOUS=1;
        const CRMTYPE_NORENDEZVOUS=2;
        const CRMTYPE_INTERNET=3;
    public static function tableName()
    {
        return 'crmlog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crmtypeid', 'accountid', 'rvpersonid', 'createddate', 'status','fromdate','description'], 'required'],
            [['crmtypeid', 'accountid', 'rvpersonid', 'status'], 'integer'],
            [['description'], 'string'],
            [['createddate','fromdate', 'todate'], 'safe'],
            [['crmtypeid'], 'exist', 'skipOnError' => true, 'targetClass' => Crmtype::className(), 'targetAttribute' => ['crmtypeid' => 'crmtypeid']],
            [['accountid'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['accountid' => 'accountid']],
            [['rvpersonid'], 'exist', 'skipOnError' => true, 'targetClass' => Rvperson::className(), 'targetAttribute' => ['rvpersonid' => 'rvpersonid']],
           // [['todate'], 'compare','compareAttribute'=>'fromdate','operator'=>'>','message'=>'To date cannot be smaller than From date'],
            [['accountid', 'fromdate'], 'unique', 'targetAttribute' => ['accountid', 'fromdate'],'message'=>'time and place is busy place select new one.','on'=>'create'],
            //[['accountid','todate'], 'checkDate','on'=>'create'],
            //[['accountid','todate'], 'checkDate', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function checkDate($attribute, $params)
    {
        $thereIsAnOverlapping = Crmlog::find()->where(
            ['AND',
                ['accountid' => $this->accountid],
                ['<=', 'fromdate', $this->fromdate],
                ['>=', 'todate', $this->todate]
            ])->exists();

        if($thereIsAnOverlapping){
            $this->addError($attribute, 'This place and time is busy, selcet new place or change time.');
        }


    }
    public function attributeLabels()
    {
        return [
            'crmlogid' => 'Crmlogid',
            'crmtypeid' => 'Crmtypeid',
            'description' => Yii::t('app','Description'),
            'accountid' => 'Accountid',
            'rvpersonid' => 'Rvpersonid',
            'createddate' => Yii::t('app','Date'),
            'status' => Yii::t('app','Status'),
            'fromdate'=>Yii::t('app','Date'),
            'todate'=>Yii::t('app','To'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrmtype()
    {
        return $this->hasOne(Crmtype::className(), ['crmtypeid' => 'crmtypeid']);
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
    public function getRvperson()
    {
        return $this->hasOne(Rvperson::className(), ['rvpersonid' => 'rvpersonid']);
    }
   
   
}
