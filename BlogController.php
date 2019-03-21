<?php

namespace app\controllers;

use app\models\BlogPostComment;
use app\models\BlogPostCommentMark;
use app\models\BlogPostFavorites;
use app\models\BlogPostMark;
use app\models\BlogTheme;
use app\models\Notification;
use app\models\User;
use Yii;
use app\models\BlogPost;
use app\models\search\BlogPostSearch;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class BlogController extends Controller
{
    public $layout = 'blog';
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        /*if ($action->id == 'index') {
            $blogSearchArr = Yii::$app->request->get('BlogSearch');
            $blogPostSearchArr = Yii::$app->request->get('BlogPostSearch');

            $theme_id = !empty($blogSearchArr['theme_id']) ? $blogSearchArr['theme_id'] : null;

            if (empty($theme_id)) {
                $theme_id = !empty($blogPostSearchArr['theme_id']) ? !$blogPostSearchArr['theme_id'] : null;
            }

            if (!empty($theme_id)) {
                $model = BlogTheme::findOne($theme_id);

                if ($model != null) {
                    return $this->redirect($model->getUrl(), 301);
                }
            }
        }*/

        if ($action->id == 'view') {
            $model = BlogPost::findOne(Yii::$app->request->get('id'));

            if ($model != null) {
                return $this->redirect($model->getUrl(), 301);
            }
        }

        return parent::beforeAction($action);
    }

    public function actionIndex($category_slug = null)
    {
        $theme = null;
        $title = 'Блоги мира трейдеров';
        $meta_title = 'Статьи о трейдинге, инвестициях, рисках - "Мир трейдеров" портал для общения трейдеров';
        $meta_description = 'Самые свежие статьи трейдеров и инвесторов в России. Новости финансов, экономический календарь событий в мире,котировки и графики в реальном времени-валюты,сырья,металлов';
        $getSearched = Yii::$app->request->get('BlogPostSearch');

        $searchModel = new BlogPostSearch([
            'category_slug' => $category_slug
        ]);

        if (!empty($getSearched['category'])) {
            $title = BlogPost::categoryList()[$getSearched['category']];
        } elseif (!empty($getSearched['theme_id'])) {
            $theme = BlogTheme::findOne($getSearched['theme_id']);

            if ($theme) {
                $title = $theme->name;
                $meta_title = $theme->getMetaTitle();
                $meta_description = $theme->meta_description;
            }
        } elseif (!empty($category_slug)) {
            $theme = BlogTheme::findOne(['slug' => $category_slug]);

            if ($theme) {
                $title = $theme->name;
                $meta_title = $theme->getMetaTitle();
                $meta_description = $theme->meta_description;
            }
        } elseif (!empty($getSearched['tags'])) {
            $title = 'Поиск статей по тегу "' . $getSearched['tags'] . '"';
            $meta_title = 'Статьи по теме "' . $getSearched['tags'] . '" – портал Мир трейдеров';
        } elseif (!empty($getSearched['created_by'])) {
            $user = User::findOne($getSearched['created_by']);
            $title = 'Статьи пользователя ' . $user->getFullName();
            $meta_title = 'Статьи пользователя ' . $user->getFullName() . ' – портал Мир трейдеров';
        } elseif (!empty($getSearched['friends'])) {
            $title = 'Лента друзей';
        } elseif (!empty($getSearched['favorite'])) {
            $title = 'Избранное';
        } elseif (!empty($getSearched['best'])) {
            $title = 'Лучшее за 2 суток';
        } elseif (!empty($getSearched['blocked'])) {
            $title = 'Заблокированные';
        } elseif (!empty($getSearched['theme_id'])) {
            $themeModel = BlogTheme::findOne($getSearched['theme_id']);
            $title = $themeModel->name;
        }

        if (empty($meta_title)) {
            $meta_title = $title;
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $pagination = $dataProvider->getPagination();

        return $this->render('index', [
            'title' => $title,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'pagination' => $pagination,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'themeModel' => $theme
        ]);
    }

    public function actionView($id = null, $article_slug = null)
    {
        $post = Yii::$app->request->post();
        $model = BlogPost::find()
            ->andFilterWhere(['id' => $id])
            ->andFilterWhere(['slug' => $article_slug])
            ->one();

        if ($model->status == BlogPost::STATUS_BLOCKED) {
            if (Yii::$app->user->isGuest) {
                return $this->redirect('http://google.ru');
            } else {
                if ($model->isAuthor(Yii::$app->user->id) || Yii::$app->user->identity->canAdmin()) {
                    Yii::$app->session->addFlash('error', 'Данная статья заблокирована.');
                }

                if (!Yii::$app->user->identity->canAdmin()) {
                    return $this->redirect('http://google.ru');
                }
            }
        }

        $commentModel = new BlogPostComment([
            'blog_post_id' => $model->id
        ]);

        if ($commentModel->load($post) && !Yii::$app->user->isGuest) {
			if ($commentModel->save()) {
            $notification = new Notification([
                'type' => Notification::TYPE_BLOG_COMMENT,
                'user_id_from' => Yii::$app->user->id,
                'user_id_to' => $model->author->id,
                'datetime' => time(),
                'is_new' => 1,
                'text' => Html::a(mb_substr(strip_tags($commentModel->content), 0, 100),
                        $model->getUrl()) . '...'
            ]);

            $notification->save();

            if (!empty($post['curr_comment_id'])) {
                $comment = BlogPostComment::findOne($post['curr_comment_id']);

                $notification = new Notification([
                    'type' => Notification::TYPE_COMMENT_ANSWER,
                    'user_id_from' => Yii::$app->user->id,
                    'user_id_to' => $comment->author->id,
                    'datetime' => time(),
                    'is_new' => 1,
                    'text' => Html::a(mb_substr(strip_tags($commentModel->content), 0, 100),
                            $model->getUrl()) . '...'
                ]);

                $notification->save();
            }

            Yii::$app->session->addFlash('success', 'Комментарий успешно добавлен.');

            $commentModel = new BlogPostComment([
                'blog_post_id' => $model->id
            ]);

            return $this->redirect(['/blog/view', 'id' => $model->id, 'commentCreated' => 1]);
			}
        }

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        return $this->render('view', [
            'model' => $model,
            'commentModel' => $commentModel,
        ]);
    }

    public function actionComments($user_id = null)
    {
        $title = 'Все комментарии';

        $dataProvider = new ActiveDataProvider([
            'query' => BlogPostComment::find()->andFilterWhere(['created_by' => $user_id]),
            'pagination' => [
                'pageSize' => 40,
            ],
        ]);

        if ($user_id != null) {
            $user = User::findOne($user_id);
            $title = 'Комментарии пользователя ' . $user->getFullName();
        }

        $pagination = $dataProvider->getPagination();

        return $this->render('comments', [
            'dataProvider' => $dataProvider,
            'pagination' => $pagination,
            'title' => $title
        ]);
    }

    public function actionCreate()
    {
        $model = new BlogPost();
        $user = Yii::$app->user->identity;

        if ($user->type == 'Трейдер') {
            $model->category = BlogPost::CATEGORY_TRADER;
        } elseif ($user->type == 'Инвестор') {
            $model->category = BlogPost::CATEGORY_INVESTOR;
        } elseif ($user->type == 'Брокер') {
            $model->category = BlogPost::CATEGORY_BROKER;
        } elseif ($user->type == 'Проп-фонд') {
            $model->category = BlogPost::CATEGORY_FUND;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $img = UploadedFile::getInstance($model, 'img');
                $model->uploadImg($img);

                Yii::$app->session->addFlash('success', 'Статья успешно сохранена.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_img = $model->img;

        if ($model->author->id != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->img)) {
                $model->img = $old_img;
            }

            if ($model->save()) {
                $img = UploadedFile::getInstance($model, 'img');
                $model->uploadImg($img);

                Yii::$app->session->addFlash('success', 'Статья успешно сохранена.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionBlock($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;

        if (!Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if ($model->save()) {
            if ($status == BlogPost::STATUS_BLOCKED) {
                Yii::$app->session->addFlash('success', 'Статья успешно заблокирована.');
            } else {
                Yii::$app->session->addFlash('success', 'Статья успешно разблокирована.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCommentUpdate($id)
    {
        $model = BlogPostComment::findOne($id);
        $blog_post_id = $model->blog_post_id;

        if ($model->author->id != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', 'Комментарий успешно сохранен.');
        }

        return $this->redirect(['/blog/view', 'id' => $blog_post_id, 'commentCreated' => 1]);
    }

    public function actionFavorite($id)
    {
        $model = $this->findModel($id);

        $blogFavorite = BlogPostFavorites::findOne([
            'blog_post_id' => $model->id,
            'user_id' => Yii::$app->user->id
        ]);

        if ($blogFavorite == null) {
            $blogFavorite = new BlogPostFavorites([
                'blog_post_id' => $model->id,
                'user_id' => Yii::$app->user->id
            ]);

            if ($blogFavorite->save()) {
                Yii::$app->session->addFlash('success', 'Статья успешно добавлена в избранное.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMark($id, $type)
    {
        $model = $this->findModel($id);

        if ($type == BlogPostMark::MARK_GOOD) {
            $mark = 4;
            $model->author->updateRating(4);
        } elseif ($type == BlogPostMark::MARK_FINE) {
            $mark = 5;
            $model->author->updateRating(5);
        } else {
            $mark = 0;
        }

        if (!$model->isMarked(Yii::$app->user->id)) {
            $blogPostMark = new BlogPostMark([
                'blog_post_id' => $model->id,
                'type' => $type,
                'mark' => $mark
            ]);

            $notification = new Notification([
                'type' => Notification::TYPE_BLOG_MARK,
                'user_id_from' => Yii::$app->user->id,
                'user_id_to' => $model->author->id,
                'datetime' => time(),
                'is_new' => 1,
                'text' => Html::a(mb_substr(strip_tags($model->title), 0, 100),
                        $model->getUrl()) . '...'
            ]);

            $notification->save();

            if ($blogPostMark->save()) {
                Yii::$app->session->addFlash('success', 'Статья успешно оценена.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCommentMark($id, $mark)
    {
        $model = BlogPostComment::findOne($id);
        $blog_post_id = $model->blog_post_id;

        if (!$model->isMarked(Yii::$app->user->id)) {
            $blogPostCommentMark = new BlogPostCommentMark([
                'blog_post_comment_id' => $model->id,
                'mark' => $mark
            ]);

            if ($blogPostCommentMark->save()) {
                $model->author->updatePower(1);

                $notification = new Notification([
                    'type' => Notification::TYPE_COMMENT_MARK,
                    'user_id_from' => Yii::$app->user->id,
                    'user_id_to' => $model->author->id,
                    'datetime' => time(),
                    'is_new' => 1,
                    'text' => Html::a(mb_substr(strip_tags($model->content), 0, 100),
                            ['/blog/view', 'id' => $blog_post_id]) . '...'
                ]);

                $notification->save();

                Yii::$app->session->addFlash('success', 'Комментарий успешно оценен.');
            }
        }

        return $this->redirect(['/blog/view', 'id' => $blog_post_id, 'commentCreated' => 1]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->author->id != Yii::$app->user->id && !Yii::$app->user->identity->canAdmin()) {
            return false;
        }

        if ($model->delete()) {
            Yii::$app->session->addFlash('success', 'Статья успешно удалена.');
        }

        return $this->redirect(['index']);
    }

    public function actionDeleteComment($id)
    {
        $model = BlogPostComment::findOne($id);

        if (!Yii::$app->user->identity->is_admin) {
            return false;
        }

        if ($model->delete()) {
            Yii::$app->session->addFlash('success', 'Комментарий успешно удален.');
        }

        return $this->redirect(['/blog/view', 'id' => $model->blog_post_id]);
    }

    public function actionBlogPostModerateMessage($id)
    {
        $post = Yii::$app->request->post();
        $blogPost = BlogPost::findOne($id);

        if (!empty($post) && $blogPost != null) {
            $aboutPost = 'Статья: ' . $blogPost->title . '<br><br>Жалоба:<br>';

            if (Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Жалоба модератору от ' . Yii::$app->user->identity->getFullName() . ' на статью #' . $blogPost->id)
                ->setHtmlBody($aboutPost . $post['message'])
                ->send()
            ) {
                Yii::$app->session->addFlash('success', 'Сообщение модератору успешно отправлено.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCommentModerateMessage($id)
    {
        $post = Yii::$app->request->post();
        $comment = BlogPostComment::findOne($id);

        if (!empty($post) && $comment != null) {
            $aboutPost = 'Комментарий в статье: ' . $comment->blogPost->title . '<br><br>Комментарий: ' . $comment->content . '<br><br>Жалоба:<br>';

            if (Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Жалоба модератору от ' . Yii::$app->user->identity->getFullName() . ' на комментарий #' . $comment->id)
                ->setHtmlBody($aboutPost . $post['message'])
                ->send()
            ) {
                Yii::$app->session->addFlash('success', 'Сообщение модератору успешно отправлено.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = BlogPost::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Пост не найден.');
    }
}
