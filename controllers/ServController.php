<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\ActiveRecord;
use app\models\Buketi;
use app\models\Alonecat;
use app\models\Buket;
use app\models\Mainmenu;
use yii\web\UploadedFile;
use app\models\FilterData;
use yii\data\Pagination;

class ServController extends Controller
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
	
	public function actionIndex()
    {
		$auth = Yii::$app->authManager;
		
		$viewAdmin = $auth->createPermission('viewAdmin');
        $viewAdmin->description = 'View post';
        $auth->add($viewAdmin);
		
		$adm = $auth->createRole('adm');
        $auth->add($adm);
        $auth->addChild($adm, $viewAdmin);
		
		$auth->assign($adm, 3);
		
		
	}
	
	public function actionIndex2()
    {
		if (\Yii::$app->user->can('viewAdmin')) {
			echo "yes";
    // create post
       }
	   else {
		   
		   echo "no";
	   }
		
		
		
		
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
} 