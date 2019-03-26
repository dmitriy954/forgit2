<?php
namespace app\models;

use yii\base\Model;


class Newpassform extends \yii\base\Model
{
	 public $password;
	
     
	 
	 public function rules()
    {
        return [
            // username and password are both required
            [['password', 'passwordrep'], 'required', 'message' => 'Это поле не может быть пустым'],
		   
			[['password', 'passwordrep'], 'string', 'length' => [6, 25]],
			['passwordrep', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
			
            
        ];
    }
}