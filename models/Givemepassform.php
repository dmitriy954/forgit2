<?php

namespace app\models;

use yii\base\Model;

//use app\models\User;

//use app\components\validators\Countryvalidator;
use app\models\Countryvalidator;

// этот модел используется для двух акшенов. Для запроса восстановления пароля . И для запроса на отправку еще одного письма, потвреждающего
// регистрацию. Поэтому два метода. В первом случае выборка из основной таблицы, во втором - из временной.

class Givemepassform extends \yii\base\Model
{
	 public $loginoremail;
     
	 
	 public function rules()
    {
        return [
            // username and password are both required
            [['loginoremail',], 'required', 'message' => 'Это поле не может быть пустым'],
		   
			['loginoremail', 'string', 'length' => [3, 25]],
			
            
        ];
    }
	
	public function Existlogorem()
	{
		$loe = $this->loginoremail;
		//echo $loe;
		$inst = User::find()
		->Where (['username' => $loe])
		->orWhere (['email' => $loe])
		->one();
		
		if ($inst)
			return $inst->id;
			
		else
			return NULL;
		
	}
	
	public function ExistlogoremOnTemp()
	{
		$loe = $this->loginoremail;
		//echo $loe;
		$inst = TempUser::find()
		->Where (['login' => $loe])
		->orWhere (['email' => $loe])
		->one();
		
		if ($inst)
			return $inst;
			
		else
			return NULL;
		
	}
	
	
	
	
	
	
	
	
}