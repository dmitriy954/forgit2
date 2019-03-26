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
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mail', 'mobile', 'town', 'street', 'house', 'kvoret', 'datemy', 'whentime', 'nametaker', 'mobileto', 'textotkr', 'textcomment'], 'string'],
            [['dost', 'oplata', 'iduser', 'totprice', 'status'], 'integer'],
            [['datez'], 'safe'],
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
}
