<?php

namespace app\models;

use Yii;

use himiklab\yii2\search\behaviors\SearchBehavior;

class Buketi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	 public function behaviors()
    {
        return [
         
        'search' => [
                'class' => SearchBehavior::className(),
                'searchScope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['id', 'price', 'rating']);
                    //$model->andWhere(['indexed' => true]);
                },
                'searchFields' => function ($model) {
                    /** @var self $model */
                    return [
                        ['name' => 'title', 'value' => $model->id],
                        ['name' => 'price', 'value' => $model->price],
						['name' => 'namee', 'value' => $model->name],
                        
                        // ['name' => 'model', 'value' => 'page', 'type' => SearchBehavior::FIELD_UNSTORED],
                    ];
                }
            ],
        ];
    }
    public static function tableName()
    {
        return 'buketi';
    }
	
	public function getAlonecat()
    {
        return $this->hasOne(Alonecat::className(), ['id' => 'id_buk']);
    }
	
}