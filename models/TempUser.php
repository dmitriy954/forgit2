<?php

namespace app\models;

use Yii;

class TempUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tempuser';
    }
	
	 public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }
	
	public function validatePassword($password)
    {
		// echo $this->password;
       return trim($this->password) === $password;
    }
	
	
	
	
}