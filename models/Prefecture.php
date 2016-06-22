<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prefecture".
 *
 * @property integer $prefectureid
 * @property string $prefecturename
 * @property integer $countryid
 *
 * @property City[] $cities
 * @property Country $country
 */
class Prefecture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prefecture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prefecturename', 'countryid'], 'required'],
            [['countryid'], 'integer'],
            [['prefecturename'], 'string', 'max' => 50],
            [['countryid'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryid' => 'countryid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prefectureid' => 'Prefectureid',
            'prefecturename' => 'Prefecturename',
            'countryid' => 'Countryid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['prefectureid' => 'prefectureid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['countryid' => 'countryid']);
    }
}
