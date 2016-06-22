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
            [['crmtypeid', 'description', 'accountid', 'rvpersonid', 'createddate', 'status'], 'required'],
            [['crmtypeid', 'accountid', 'rvpersonid', 'status'], 'integer'],
            [['description'], 'string'],
            [['createddate'], 'safe'],
            [['crmtypeid'], 'exist', 'skipOnError' => true, 'targetClass' => Crmtype::className(), 'targetAttribute' => ['crmtypeid' => 'crmtypeid']],
            [['accountid'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['accountid' => 'accountid']],
            [['rvpersonid'], 'exist', 'skipOnError' => true, 'targetClass' => Rvperson::className(), 'targetAttribute' => ['rvpersonid' => 'rvpersonid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'crmlogid' => 'Crmlogid',
            'crmtypeid' => 'Crmtypeid',
            'description' => Yii::t('app','Description'),
            'accountid' => 'Accountid',
            'rvpersonid' => 'Rvpersonid',
            'createddate' => Yii::t('app','Date'),
            'status' => 'Status',
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
