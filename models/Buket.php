<?php

namespace app\models;
use yii\web\UploadedFile;
use yii\validators\ImageValidator;
use yii\imagine\Image;

use Yii;
use yii\base\Model;

class Buket extends Model
{
    public $name;
    public $price;
	public $image;
	public $maincat = [];
    public $maincat2 = [];
	public $im;
	public $bn ;
	public $ext;
	
	
	
    public function rules()
    {
        return [
            [['im'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
			[['im'], 'yii\validators\ImageValidator', 'maxWidth' => 44443, 'maxHeight' => 45553],
			[['price', 'name'], 'required'],
            [['price'], 'integer'],
            [['name'], 'string', 'min' => 3],
           
        ];
    }
	
	
	public function upload()
    {
		if ($this->validate()) {
			
			$this->bn = $this->im->baseName;
			$this->ext = $this->im->extension;
            $this->im->saveAs('uploads/' . $this->im->baseName . '.' . $this->im->extension);
			$str1 = 'uploads/' . $this->im->baseName . '.' . $this->im->extension;
			$str2 = 'uploads/' . $this->im->baseName . '_thumb'.'.' . $this->im->extension;
			Image::thumbnail($str1, 200, 200)
                 ->save($str2, ['quality' => 50]);
	
            return true;
        } else {
            return false;
        }		
    }
}

?>