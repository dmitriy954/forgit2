<?php

namespace app\controllers;

use app\models\ForumPost;
use app\models\ForumPostLike;
use app\models\User;
use Yii;
use app\models\ForumTheme;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ForumThemeController extends Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'wide';

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        return parent::beforeAction($action);
    }

    public function actionCreate()
    {
        $model = new ForumTheme();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/forums/' . $model->forum->slug]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->created_by != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/forums/' . $model->forum->slug]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($theme_slug, $created = false)
    {
        $model = ForumTheme::findOne(['slug' => $theme_slug]);

        $model->views = $model->views + 1;
        $model->save(false);

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $postModel = new ForumPost([
                'theme_id' => $model->id,
                'content' => $post['content']
            ]);

            if ($postModel->save()) {
                Yii::$app->session->addFlash('success', 'Пост успешно добавлен.');
                return $this->redirect([
                    'view',
                    'theme_slug' => $model->slug,
                    'created' => true,
                    'page' => $_GET['page'] ?? null,
                    'per-page' => $_GET['per-page'] ?? null,
                ]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => ForumPost::find()->where([
                'theme_id' => $model->id
            ]),
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => Yii::$app->params['forum_theme_post_per_page']
            ],
        ]);

        $posts = $dataProvider->getModels();
        $pagination = $dataProvider->getPagination();

        return $this->render('view', [
            'model' => $model,
            'posts' => $posts,
            'pagination' => $pagination,
            'created' => $created
        ]);
    }

    public function actionPostList($user_id)
    {
        $model = User::findOne($user_id);

        $dataProvider = new ActiveDataProvider([
            'query' => ForumPost::find()->where([
                'created_by' => $model->id
            ]),
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => Yii::$app->params['forum_theme_post_per_page']
            ],
        ]);

        $posts = $dataProvider->getModels();
        $pagination = $dataProvider->getPagination();

        return $this->render('post-list', [
            'model' => $model,
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->created_by != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        $model->delete();

        return $this->redirect(['/forums']);
    }

    public function actionPostLike($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $forumPost = ForumPost::findOne($id);

        if ($forumPost != null) {
            $attrs = [
                'post_id' => $id,
                'author_id' => $forumPost->createdBy->id,
                'user_id' => Yii::$app->user->id
            ];

            if (!ForumPostLike::find()->where([
                'post_id' => $id,
                'author_id' => $forumPost->createdBy->id,
                'user_id' => Yii::$app->user->id
            ])->exists()) {
                $forumLike = new ForumPostLike([
                    'post_id' => $id,
                    'author_id' => $forumPost->createdBy->id,
                    'user_id' => Yii::$app->user->id
                ]);

                $forumLike->save(false);
                $forumPost->createdBy->updatePower(1);
            }
        }

        $forumLikesCount = ForumPostLike::find()->where(['post_id' => $id])->count();

        $popoverContent = '';
        foreach ($forumPost->forumPostLikes as $like) {
            if (!empty($like->user)) {
                $popoverContent .= Html::a(Html::tag('span', '+',
                            ['class' => 'text-success']) . $like->user->getFullName() . ' ',
                        $like->user->getUrl()) . '<br>';
            }
        }

        return [
            'likesCount' => $forumLikesCount,
            'popoverContent' => $popoverContent
        ];
    }

    public function actionPostRemove($id)
    {
        $model = ForumPost::findOne($id);

        if ($model->created_by != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        return $model->delete();
    }

    public function actionModerateMessage($id)
    {
        $post = Yii::$app->request->post();
        $forumPost = ForumPost::findOne($id);

        if (!empty($post) && $forumPost != null) {
            $aboutPost = 'Пост в теме: ' . $forumPost->theme->name . '<br>Номер поста: #' . $forumPost->id . '<br>Жалоба:';

            if (Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Жалоба модератору от ' . Yii::$app->user->identity->getFullName() . ' на пост #' . $forumPost->id)
                ->setHtmlBody($aboutPost . $post['message'])
                ->send()) {
                Yii::$app->session->addFlash('success', 'Сообщение модератору успешно отправлено.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionPostEdit($id)
    {
        $post = Yii::$app->request->post();
        $forumPost = ForumPost::findOne($id);

        if ($forumPost->created_by != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if (!empty($post['post-content']) && $forumPost != null) {
            $forumPost->content = $post['post-content'];
            $forumPost->is_changed = 1;

            if ($forumPost->save()) {
                Yii::$app->session->addFlash('success', 'Пост успешно отредактирован.');
            }
        }

        return $this->redirect(['view', 'theme_slug' => $forumPost->theme->slug]);
    }

    protected function findModel($id)
    {
        if (($model = ForumTheme::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
