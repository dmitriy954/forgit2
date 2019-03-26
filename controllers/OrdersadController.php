<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\Orders_upd;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OrderBuks;
use yii\filters\AccessControl;
use yii\web\MethodNotAllowedHttpException;
/**
 * OrdersadController implements the CRUD actions for Orders model.
 */
class OrdersadController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
			
			'access' => [
            'class' => AccessControl::className(),
			'rules' => [
                [
                    'allow' => true,
                    
                    'roles' => ['viewAdmin'],
                ],
				
			
			],
			
			
			
			],
			
			
			
        ];
    }

	
	public function actionPageadmin()
	{
		 return $this->render('pageadmin');	
		
		
		
		
		
		
		
	}
    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		
		$bukets_of_order = OrderBuks::findAll(['id_ord' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id), 'buks_of_order' => $bukets_of_order
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			if  ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]); }
			else  {
				throw new MethodNotAllowedHttpException($message = "Не удалось изменить данные по заказу"); 
				
			}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	
	 public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update2', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders_upd::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
