<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use app\models\Buketi;
use app\models\Orders;
use app\models\OrderBuks;

class KabinetController extends Controller
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
                        'actions' => ['index'],
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
	
	
	 public function actionIndex()
    {
		$cookies = Yii::$app->request->cookies;
		$strbuk = $cookies->getValue('massbukandkols', 'deff');
        $havekorz = 0;
		if (strcasecmp ($strbuk, "deff") != 0)
		   {
			   $havekorz = 1;
		   }   
		
		$mass_buks_of_order = [];
		
		$identity = Yii::$app->user->identity;
		$idus = Yii::$app->user->id;
		$orders_tek = Orders::findAll(['iduser' => $idus, 'status' => [1, 2, 3]]);
		$orders_pro = Orders::findAll(['iduser' => $idus, 'status' => 5]);
		
		foreach ($orders_tek as $ord)
		  {
			$bukets_of_order = OrderBuks::findAll(['id_ord' => $ord->id]);
			$mass_buks_of_order[] = $bukets_of_order;
	
		  }
		  
		  foreach ($orders_pro as $ord)
		  {
			$bukets_of_order_pro = OrderBuks::findAll(['id_ord' => $ord->id]);
			$mass_buks_of_order_pro[] = $bukets_of_order_pro;
	
		  }
		
		
		
		return $this->render (index, ['mass_buks_of_order' => $mass_buks_of_order, 'mass_buks_of_order_pro' => $mass_buks_of_order_pro, 'orders_tek' => $orders_tek, 'orders_pro' => $orders_pro, 'havekorz' => $havekorz]);
		
		
		
	}
	
}