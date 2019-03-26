<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\Security;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
	
   // public $id;
 //   public $username; // убрать это и наверно тоже ничего не изменится
  //  public $password;
   // public $authKey;
  //  public $accessToken;
   

    /**
     * @inheritdoc
     */
	 
	  public static function tableName()
	 {
		 
		return 'user'; 
		 
	 }
    public static function findIdentity($id)
    {
       return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
       return static::findOne(['access_token' => $token]);
    }
	
	public function getId()
    {
        return $this->id;
    }
	
	public function getAuthKey()
    {
       return $this->authkey;
	  
    }
	
	public function validateAuthKey($authKey)
    {
       return $this->getAuthKey() === $authKey;
	   
	 
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
  

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
		// echo $this->password;
       return trim($this->password) === $password;
    }
}
