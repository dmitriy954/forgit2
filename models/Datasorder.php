<?php
namespace app\models;

use Yii;



class DatasOrder extends \yii\base\Model
{
    public $name;
	public $email;
	public $mobile;
	public $town;
	public $street;
	public $house;
	public $kvoret;
	public $datemy;
	public $whentime;
	public $mobileto;
    public $textotkr;
	public $dost;
	public $oplata;
	public $textcomment;
	public $idt;
	public $controlst;
	public $nametaker;
	
	public function scenarios()
     {
	     $scenarios['default'] = ['name', 'email', 'mobile', 'town', 'street', 'house', 'kvoret',
		 'datemy', 'whentime', 'mobileto', 'textotkr', 'nametaker', 'dost', 'oplata', 'textcomment', 'idt', 'controlst'];
		 return $scenarios;
	 }
		 
		 
		 
		 
		 
		 
    
    public function rules()
    {
        return [
            // define validation rules here
			
			[['name', 'email', 'name2', 'town', 'street', 'house', '', '', '', '', '', '',], 'required', 'message' => 'Это поле не может быть пустым'],
			['email', 'email', 'message' => "неправильный емайл" ],
			['mobile', 'myvalid55']
        ];
    }    
	
	//  'message' => 'Е-майл введен некорректно'
	public function myvalid55 ($attribute, $params)
    {
		
		// if (preg_match('/^+7 (951) 758 96 65$/', $this->$attribute))
		if (!preg_match('/^\+7 \(\d{3}\) \d{3} \d{2} \d{2}$/', $this->$attribute)  )	
			{
        $this->addError($attribute, 'Телефон не соответствует маске');
			}
			
	}	
			
			
			
		    
}