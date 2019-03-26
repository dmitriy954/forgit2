<?php

namespace app\models;


use yii\base\Model;

class FilterData extends \yii\base\Model
{
	public $price1; 
	public $price2;
	public $height1;
	public $height2;
	public $width1;
	public $width2;
	public $sort1;
	public $sort2;
	public $searchq;
	public $categ;
	public $searchforaja;
	
	
	
	
   public function scenarios()
     {
	     $scenarios['default'] = ['price1', 'price2', 'height1', 'height2', 'width1', 'width2', 'searchq', 'sort1',  'sort2', 'categ'];
		 return $scenarios;
	 }
}