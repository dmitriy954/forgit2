<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mainmenu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_cat
 */
class Mainmenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mainmenu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_cat'], 'required'],
            [['name'], 'string'],
            [['id_cat'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_cat' => 'Id Cat',
        ];
    }
}
