<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crmtype".
 *
 * @property integer $crmtypeid
 * @property string $description
 */
class Crmtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crmtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'crmtypeid' => 'Crmtypeid',
            'description' => 'Description',
        ];
    }
}
