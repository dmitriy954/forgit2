<?php

namespace app\controllers;

use Yii;
use app\models\ForumCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ForumCategoryController extends Controller
{
    public $layout = 'wide';

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        if (!Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        return parent::beforeAction($action);
    }

    public function actionCreate()
    {
        $model = new ForumCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/forums']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/forums']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->forums)) {
            Yii::$app->session->addFlash('error', 'Невозможно удалить категорию. Сначала удалите форумы.');
        } else {
            $model->delete();
        }

        return $this->redirect(['/forums']);
    }

    protected function findModel($id)
    {
        if (($model = ForumCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
