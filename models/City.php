<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $cityid
 * @property string $cityname
 * @property integer $prefectureid
 *
 * @property Prefecture $prefecture
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $countryid;
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityname', 'prefectureid'], 'required'],
            [['prefectureid'], 'integer'],
            [['cityname'], 'string', 'max' => 50],
            [['prefectureid'], 'exist', 'skipOnError' => true, 'targetClass' => Prefecture::className(), 'targetAttribute' => ['prefectureid' => 'prefectureid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cityid' => 'Cityid',
            'cityname' => 'Cityname',
            'prefectureid' => 'Prefectureid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrefecture()
    {
        return $this->hasOne(Prefecture::className(), ['prefectureid' => 'prefectureid']);
    }
}
