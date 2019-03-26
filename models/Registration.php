<?php

namespace app\models;

use yii\base\Model;

use app\models\User;

//use app\components\validators\Countryvalidator;
use app\models\Countryvalidator;

class Registration extends \yii\base\Model
{
	 public $login;
     public $password;
	 public $passwordrep;
	 public $name;
     public $surname;
	 public $email;
	 public $captcha;
	 
	 public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password', 'passwordrep', 'name', 'surname', 'email', 'captcha'], 'required', 'message' => 'Это поле не может быть пустым'],
		    ['captcha','captcha', 'message' => 'не совпадает с картинкой'], 
		//	 [['password', 'passwordrep'], 'string', 'min' => 6, 'max' => 12, 'message' => ' Пароль от 6 до 12 символов'],
		    ['email', 'email', 'message' => 'Это не е-майл адрес'],
            // rememberMe must be a boolean value
			['login', 'string', 'length' => [3, 15]],
			['login', 'validateLogin'],
			[['password', 'passwordrep'], 'string', 'length' => [6, 25], 'tooShort' => 'Пароль должен сожержать не менее 6 символов'],
           //  ['password', 'validatePassword'],
			 // ['passwordrep', Countryvalidator::className()],
			 ['passwordrep', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            // password is validated by validatePassword()
            
        ];
    }
	
	
	 public function validateLogin($attribute, $params)
    {
        if (!$this->hasErrors()) {
           
                $val = $this->$attribute;
				
				$usc = User::find()
	            ->where (['username' => $val])
	            ->count();
				
				if ($usc > 0) 
	               $this->addError($attribute, 'Логин, который Вы ввели, уже есть в базе. Введите другой');
               
       
               
            }
        
    }
	
	
	
	
	
}