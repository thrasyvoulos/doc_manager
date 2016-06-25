<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $countryid
 * @property string $description
 *
 * @property Prefecture[] $prefectures
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryid' => 'Countryid',
            'description' => Yii::t('app','Description')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrefectures()
    {
        return $this->hasMany(Prefecture::className(), ['countryid' => 'countryid']);
    }
}
