<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $roleid
 * @property string $description
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ROLE_ADMIN    = 1;
    const ROLE_USER   = 2;
    public static function tableName()
    {
        return 'role';
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
            'roleid' => 'Roleid',
            'description' => 'Description',
        ];
    }
}
