<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buketi".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property integer $idcat1
 * @property integer $idcat2
 * @property integer $idcat3
 * @property integer $idcat4
 * @property integer $idcat5
 * @property integer $idcat6
 * @property integer $idcat7
 * @property string $pathim
 * @property string $extim
 */
class Buketigii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buketi';
    }

    /**
     * @inheritdoc
     */
   public function scenarios()
     {
	     $scenarios['default'] = ['name', 'price', 'strcat1', 'strcat2', 'strcat3', 'strcat4', 'pathim', 'extim', 'width', 'height', 'adjunct', 'info', 'fromcountry' ];
		 return $scenarios;
	 }


   public function rules()
    {
        return [
            [['name', 'price' ], 'required', 'message' => 'это поле не может быть пустым' ],
            [['name', 'pathim', 'extim'], 'string'],
            [['price'], 'integer'],
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
            'price' => 'Price',
            
            'pathim' => 'Pathim',
            'extim' => 'Extim',
			'ajunct' => 'Ajunct',
        ];
    }
}
