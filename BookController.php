<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Book;
use app\models\search\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BookController extends Controller
{
    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        return parent::beforeAction($action);
    }

    public function actionIndex($user_id = null)
    {
        $userModel = User::findOne($user_id);

        $searchModel = new BookSearch([
            'user_id' => $user_id
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Book([
            'user_id' => Yii::$app->user->id
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'user_id' => $model->user_id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userModel' => $userModel,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new Book([
            'user_id' => Yii::$app->user->id
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'user_id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        $model->delete();

        return $this->redirect(['index', 'user_id' => $model->user_id]);
    }

    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Книга не найдена.');
    }
}
