<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $name
 * @property string $mail
 * @property string $mobile
 * @property string $town
 * @property string $street
 * @property string $house
 * @property string $kvoret
 * @property string $datemy
 * @property string $whentime
 * @property string $mobileto
 * @property string $textotkr
 * @property integer $dost
 * @property integer $oplata
 * @property integer $textcomment
 * @property integer $iduser
 * @property integer $totprice

 * @property string $datez
 * @property integer $status
 */
class Orders_upd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }
	
	public function scenarios()
     {
	     $scenarios['default'] = ['totprice', 'status', 'name', 'mail', 'mobile', 'town', 'street', 'house', 'kvoret', 'datemy', 'whentime', 'mobileto', 'nametaker', 'textotkr', 'dost', 'oplata', 'textcomment', 'iduser', 'datez' ];
		 return $scenarios;
	 }

	 
	     public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mail' => 'Mail',
            'mobile' => 'Mobile',
            'town' => 'Town',
            'street' => 'Street',
            'house' => 'House',
            'kvoret' => 'Kvoret',
            'datemy' => 'Datemy',
            'whentime' => 'Whentime',
            'mobileto' => 'Mobileto',
            'textotkr' => 'Textotkr',
            'dost' => 'Dost',
            'oplata' => 'Oplata',
            'textcomment' => 'Textcomment',
            'iduser' => 'Iduser',
            'totprice' => 'Totprice',
   
            'datez' => 'Datez',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     */
   

    /**
     * @inheritdoc
     */

}
