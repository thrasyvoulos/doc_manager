<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specialties".
 *
 * @property integer $specialtiesid
 * @property string $description
 */
class Specialties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'specialtiesid' => Yii::t('app', 'Specialtiesid'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
