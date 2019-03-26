<?php 

namespace app\models;

use yii\validators\Validator;

class Countryvalidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
      /*  if (!in_array($model->$attribute, ['USA', 'Web'])) {
            $this->addError($model, $attribute, 'The country must be either "USA" or "Web".');
        }  */
		
		$this->addError($model, $attribute, 'The country must be either "USA" or "Web".');
    }
	
	
	public function clientValidateAttribute($model, $attribute, $view)
    {
		return <<<JS

   messages.push("7777777777777777777777777777777777777777777");

JS;
		
		
	}
	
	
}