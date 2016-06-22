<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accountrvperson".
 *
 * @property integer $accountrvpersonid
 * @property integer $accountid
 * @property integer $rvpersonid
 * @property string $createddate
 *
 * @property Account $account
 * @property Rvperson $rvperson
 */
class Accountrvperson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accountrvperson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accountid', 'rvpersonid', 'createddate'], 'required'],
            [['accountid', 'rvpersonid'], 'integer'],
            [['createddate'], 'safe'],
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
            'accountrvpersonid' => 'Accountrvpersonid',
            'accountid' => 'Accountid',
            'rvpersonid' => 'Rvpersonid',
            'createddate' => 'Createddate',
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
    public function getRvperson()
    {
        return $this->hasOne(Rvperson::className(), ['rvpersonid' => 'rvpersonid']);
    }
}
