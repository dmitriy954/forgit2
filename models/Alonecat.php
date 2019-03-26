<?php

namespace app\models;

use Yii;

class Alonecat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alonecat';
    }
	
	public function getBuketi()
    {
        return $this->hasOne(Buketi::className(), ['id_buk' => 'id']);
    }
	
}