<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\validators\ImageValidator;
use yii\imagine\Image;

class MassCheck extends \yii\base\Model
{
   // четрые массива для чекбосов
   // не забыть, что если этим массивы заполнить списков идов, то эти иды будут в чекбоксе отмечены   
    public $masscat1 = [];
	public $masscat2 = [];
	public $masscat3 = [];
	public $masscat4 = [];
	public $im1 = NULL, $im2 = NULL, $im3 = NULL, $im4 = NULL, $im5 = NULL;  // экземпляр файла
	
	public $flag;
	public $bn1 = NULL, $bn2 = NULL, $bn3 = NULL, $bn4 = NULL, $bn5 = NULL; // имя файла
	public $ext1 = NULL, $ext2 = NULL, $ext3 = NULL, $ext4 = NULL, $ext5 = NULL; // расширение файла
	
	public function scenarios()
     {
	     $scenarios['default'] = ['masscat1', 'masscat2', 'masscat3', 'masscat4', 'bn1', 'ext1', 'im1', 'bn2', 'ext2', 'im2', 'bn3', 'ext3', 'im3', 'bn4', 'ext4', 'im4', 'bn5', 'ext5', 'im5'];
		 return $scenarios;
	 }
	

    public function rules()
    {
        return [
		
		[['im1, im2, im3, im4, im5'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg' ],
			[['im1, im2, im3, im4, im5'], 'yii\validators\ImageValidator', 'maxWidth' => 44443, 'maxHeight' => 45553],
            // define validation rules here
        ];
    }
	
	
	
	
	
	
	
	
	
	public function upload1()
    {
		
					 $this->bn1 =  uniqid();
			         $this->ext1 = $this->im1->extension;
					 
                     $this->im1->saveAs('uploads/' .  $this->bn1 . '.' . $this->im1->extension);
					 $str1 = 'uploads/' .  $this->bn1 . '.' . $this->im1->extension;
			         $str2 = 'uploads/' .  $this->bn1 . '_thumb'.'.' . $this->im1->extension;
			         Image::thumbnail($str1, 200, 200)
                        ->save($str2, ['quality' => 50]);
					 
					 
                     return true;
            
					
            
    }
	
	
	
	
	public function upload2()
    {
		
					 $this->bn2 =  uniqid();
			         $this->ext2 = $this->im2->extension;
                     $this->im2->saveAs('uploads/' .  $this->bn2 . '.' . $this->im2->extension);
					 $str1 = 'uploads/' .  $this->bn2 . '.' . $this->im2->extension;
			         $str2 = 'uploads/' .  $this->bn2 . '_thumb'.'.' . $this->im2->extension;
			         Image::thumbnail($str1, 200, 200)
                        ->save($str2, ['quality' => 50]);
					 
					 
                     return true;
                 
    }
	
	
	
	
    public function upload3()
    {
		
					 $this->bn3 =  uniqid();
			         $this->ext3 = $this->im3->extension;
                     $this->im3->saveAs('uploads/' .  $this->bn3 . '.' . $this->im3->extension);
					 $str1 = 'uploads/' .  $this->bn3 . '.' . $this->im3->extension;
			         $str2 = 'uploads/' .  $this->bn3 . '_thumb'.'.' . $this->im3->extension;
			         Image::thumbnail($str1, 200, 200)
                        ->save($str2, ['quality' => 50]);
					 
					 
                     return true;
                 
            
    }
	
	
	
	
	public function upload4()
    {
		
					 $this->bn4 =  uniqid();
			         $this->ext4 = $this->im4->extension;
                     $this->im4->saveAs('uploads/' .  $this->bn4 . '.' . $this->im4->extension);
					 $str1 = 'uploads/' .  $this->bn4 . '.' . $this->im4->extension;
			         $str2 = 'uploads/' .  $this->bn4 . '_thumb'.'.' . $this->im4->extension;
			         Image::thumbnail($str1, 200, 200)
                        ->save($str2, ['quality' => 50]);
					 
					 
                     return true;
                 
    }
	
	
	
	
	
	public function upload5()
    {
		 
					 $this->bn5 =  uniqid();
			         $this->ext5 = $this->im5->extension;
                     $this->im5->saveAs('uploads/' .  $this->bn5 . '.' . $this->im5->extension);
					 $str1 = 'uploads/' .  $this->bn5 . '.' . $this->im5->extension;
			         $str2 = 'uploads/' .  $this->bn5 . '_thumb'.'.' . $this->im5->extension;
			         Image::thumbnail($str1, 200, 200)
                        ->save($str2, ['quality' => 50]);
					 
					 
                     return true;
                 
            
    }
}