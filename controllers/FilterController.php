<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use app\models\Buketi;



class FilterController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
	 
	 public function actionIndex()
    {
		$request = Yii::$app->request;
		$post = $request->post();
		
		
		$p1 = $post['p1'];
		$p2 = $post['p2'];
		$p3 = $post['p3'];
		$p4 = $post['p4'];
		$p5 = $post['p5'];
		$p6 = $post['p6'];
		$p7 = $post['p7'];
		$p8 = $post['p8'];
		//$p8 = "кор";
		$rows = [];
		
		if ( (strcasecmp ('-1', $p7)  != 0) or (strcasecmp ('-1', $p8)  != 0))
		{
		  if ( strcasecmp ('-1', $p7)  != 0)
		     {
		       $rows = (new \yii\db\Query())
                  ->select(['id_buk'])
                  ->from('alonecat')
	              ->where(['id_cat' => $p7])
		
                  ->column();
		     }
			 
		  if ( strcasecmp ('-1', $p8)  != 0)
		     {
		       $rows = (new \yii\db\Query())
                  ->select(['id'])
                  ->from('buketi')
	              ->Where(['like', 'name', $p8])
				
                  ->column();
		     }
		
		
		
		$count = Buketi::find()
		-> where (['between', 'price', $p1, $p2])
		-> andWhere (['between', 'height', $p3, $p4])
		-> andWhere (['between', 'width', $p5, $p6])
		-> andWhere (['adjunct' => 0])
		-> andWhere (['id' => $rows])
		-> count()
		;
		
		}
		else
		{
		$count = Buketi::find()
		-> where (['between', 'price', $p1, $p2])
		-> andWhere (['between', 'height', $p3, $p4])
		-> andWhere (['between', 'width', $p5, $p6])
		-> andWhere (['adjunct' => 0])
		-> count()
		;
			
			
			
			
		}
		
		return $count;
		
		
	}
	
	public function beforeAction($action) {
 
     
      $this->enableCsrfValidation = false;
      return parent::beforeAction($action);
}
}