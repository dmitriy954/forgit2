<?php

namespace app\models;

use Yii;

class TempOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'temporders';
    }
	
}