<?php

namespace app\controllers;

use app\models\ForumCategory;
use app\models\ForumPost;
use app\models\ForumTheme;
use app\models\User;
use Yii;
use app\models\Forum;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ForumController extends Controller
{
    public $layout = 'wide';

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $forumData = [];

        $forumCategories = ForumCategory::find()->all();

        /**
         * @var $forumCategory ForumCategory
         */
        foreach ($forumCategories as $forumCategory) {
            $forumData[] = [
                'category' => $forumCategory,
                'forums' => $forumCategory
                    ->getForums()
                    ->leftJoin(ForumTheme::tableName(), 'forum.id = forum_theme.forum_id')
                    ->leftJoin(ForumPost::tableName(), 'forum_theme.id = forum_post.theme_id')
                    ->andWhere(['forum.is_admin' => 0])
                    ->orderBy(['forum_post.created_at' => SORT_DESC])
                    ->all()
            ];
        }

        $onlineUsers = User::find()
            ->where(['between', 'last_online', time() - 240, time() + 240])
            ->all();

        $adminForums = Forum::find()->andWhere(['is_admin' => 1])->all();

        return $this->render('index', [
            'forumData' => $forumData,
            'adminForums' => $adminForums,
            'onlineUsers' => $onlineUsers
        ]);
    }

    public function actionView($forum_slug)
    {
        $model = Forum::findOne(['slug' => $forum_slug]);
        $themes = $model->getForumThemes()
            ->leftJoin(ForumPost::tableName(), 'forum_theme.id = forum_post.theme_id')
            ->orderBy(['forum_post.created_at' => SORT_DESC])
            ->all();

        return $this->render('view', [
            'model' => $model,
            'themes' => $themes
        ]);
    }

    public function actionCreate()
    {
        $model = new Forum();

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

        if (!Yii::$app->user->identity->canAdmin()) {
            return false;
        }

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

        if (!Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if (!empty($model->forumThemes)) {
            Yii::$app->session->addFlash('error', 'Невозможно удалить форум. Сначала удалите темы.');
        } else {
            $model->delete();
        }

        return $this->redirect(['/forums']);
    }

    protected function findModel($id)
    {
        if (($model = Forum::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
