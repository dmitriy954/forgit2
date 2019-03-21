<?php

namespace app\controllers;

use app\models\Friend;
use app\models\FriendRequest;
use app\models\LoginForm;
use app\models\Notification;
use app\models\User;
use app\models\search\UserSearch;
use app\models\UserGuest;
use himiklab\yii2\recaptcha\ReCaptchaValidator;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\Url;

class UserController extends Controller
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->identity->setOnline();
        }

        return parent::beforeAction($action);
    }

    public function actionAvatar()
    {
        /**
         * @var $model User
         */
        $model = Yii::$app->user->identity;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();

            $imgBin = !empty($post['avatar']) ? $post['avatar'] : null;

            if (!empty($imgBin)) {
                file_put_contents(
                    Yii::getAlias('@webroot')
                    . Yii::getAlias('@user_avatar_img_path')
                    . '/' . $model->id . '_' . time() . '.jpg',
                    file_get_contents($imgBin));

                $model->avatar = Yii::getAlias('@user_avatar_img_path') . '/' . $model->id . '_' . time() . '.jpg';
                $model->save(false);
            }

            Yii::$app->session->addFlash('success', 'Аватар успешно сохранен.');
        }

        return $this->redirect('/user/profile');
    }

    public function actionIndex()
    {
        $best = false;
        $title = 'Все участники портала';
        $searchTitle = 'Найти участника портала';
        $get = Yii::$app->request->queryParams;

        $searchModel = new UserSearch();

        if (!empty($get['UserSearch']['type'])) {
            $type = $get['UserSearch']['type'];

            if ($type == User::TYPE_TRADER) {
                $title = 'Все трейдеры';
                $searchTitle = 'Найти трейдера';
            } elseif ($type == User::TYPE_INVESTOR) {
                $title = 'Все инвесторы';
                $searchTitle = 'Найти инвестора';
            } elseif ($type == User::TYPE_BROKER) {
                $title = 'Все брокеры';
                $searchTitle = 'Найти брокера';
            } elseif ($type == User::TYPE_FUND) {
                $title = 'Все проп-фонды';
                $searchTitle = 'Найти проп-фонд';
            }
        }

        if (!empty($get['UserSearch']['best_time'])) {
            $best = true;
            $time = $get['UserSearch']['best_time'];
            $title = 'Лучшие авторы за ';

            if ($time == 'week') {
                $title .= 'неделю';
            } elseif ($time == 'month') {
                $title .= 'месяц';
            } elseif ($time == 'year') {
                $title .= 'год';
            } else {
                $title .= 'все время';
            }
        }

        $searchModel->email_confirmed = 1;
        $dataProvider = $searchModel->search($get);

        return $this->render('index', [
            'title' => $title,
            'searchTitle' => $searchTitle,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'best' => $best
        ]);
    }

    public function actionConfirm($id)
    {
        $model = User::findOne($id);

        if ($model->email_confirmed) {
            Yii::$app->session->addFlash('error', 'Аккаунт уже был подтвержден.');
            return $this->redirect(['/user/login']);
        }

        $model->email_confirmed = 1;
        if ($model->save(false)) {
            Yii::$app->user->login($model);
            Yii::$app->session->addFlash('success', 'Аккаунт успешно подтвержден.');

            return $this->redirect(['/user/profile']);
        }
    }

    public function actionNotifications($id, $type)
    {
        $types = [];
        if ($type == 'plus') {
            $types = [Notification::TYPE_COMMENT_MARK, Notification::TYPE_BLOG_MARK];
        } elseif ($type == 'text') {
            $types = [Notification::TYPE_COMMENT_ANSWER, Notification::TYPE_BLOG_COMMENT];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Notification::find()->where([
                'user_id_to' => $id,
                'type' => $types
            ])->orderBy(['datetime' => SORT_DESC])
        ]);

        return $this->render('notifications', [
            'dataProvider' => $dataProvider,
            'type' => $type
        ]);
    }

    public function actionUpdateNotifications($type)
    {
        $types = [];
        if ($type == 'plus') {
            $types = [Notification::TYPE_COMMENT_MARK, Notification::TYPE_BLOG_MARK];
        } elseif ($type == 'text') {
            $types = [Notification::TYPE_COMMENT_ANSWER, Notification::TYPE_BLOG_COMMENT];
        }

        return Notification::updateAll(['is_new' => 0], ['user_id_to' => Yii::$app->user->id, 'type' => $types]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();


        if (Yii::$app->request->isPost) {
          //  $captchaValidator = new ReCaptchaValidator();

       //     if (!empty($_POST['captcha']) && $captchaValidator->validate($_POST['captcha'])) {
                if ($model->load(Yii::$app->request->post())) {

                    if (!empty($model->email)) {
                        if (!User::isVerifiedUserExist($model->email)) {
                            if ($model->login()) {

                            }
                        }
                    }

                    return $this->redirect(Yii::$app->request->referrer);
                }
       //     }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignUp()
    {
        $post = Yii::$app->request->post();
        $model = new User([
            'last' => time()
        ]);

        if (Yii::$app->request->isPost) {
            $captchaValidator = new ReCaptchaValidator();

            if (!empty($post['captcha']) && $captchaValidator->validate($post['captcha'])) {
                if ($model->load($post)) {

                    if (!empty($model->email)) {
                        if (!User::isVerifiedUserExist($model->email)) {
                            if (empty($model->type)) {
                                $model->type = User::TYPE_TRADER;
                            }

                            if ($post['password'] != $post['password_repeat']) {
                                Yii::$app->session->addFlash('error', 'Пароли не совпадают.');

                                return $this->render('sign-up', [
                                    'model' => $model
                                ]);
                            }

                            if (!empty($post['password'])) {
                                $model->setPassword($post['password']);
                            }

                            if ($model->save()) {
                                $confirmLink = Url::to(['/user/confirm', 'id' => $model->id], true);
                                if (Yii::$app->mailer->compose()
                                    ->setFrom(Yii::$app->params['adminEmail'])
                                    ->setTo($model->email)
                                    ->setSubject(Yii::$app->name . ': подтверждение email-адреса')
                                    ->setHtmlBody('Вы зарегистрировались на сайте ' . Yii::$app->name . '. Перейдите по ссылке для подтверждения аккаунта: ' . Html::a('подтвердить email',
                                            $confirmLink))
                                    ->send()
                                ) {

                                    Yii::$app->session->addFlash('success',
                                        'Вы зарегистрированы на портале. В течении 2 минут на Ваш email придет письмо для подтверждения регистрации. Перед тем как ввести пароль, подтвердите пожалуйста регистрацию, зайдя в свой почтовый ящик.');

                                    return $this->redirect('/user/login');
                                }
                            }

                            if ($model->hasErrors()) {
                                foreach ($model->errors as $error) {
                                    Yii::$app->session->addFlash('error', $error[0]);
                                }
                            }
                        }
                    }

                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {
                Yii::$app->session->addFlash('error', 'Не удалось зарегистрироваться: докажите, что Вы не робот :)');
            }
        }

        return $this->render('sign-up', [
            'model' => $model
        ]);
    }

    public function actionEdit()
    {
        /** @var User $model */
        $model = Yii::$app->user->identity;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/user/profile');
        }

        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionProfile($id = null)
    {
        $user = $id ? User::findOne($id) : Yii::$app->user->identity;

        if (!Yii::$app->user->isGuest && $id != null && Yii::$app->user->id != $id) {
            $userGuest = new UserGuest([
                'user_id' => $id,
                'guest_id' => Yii::$app->user->id,
                'time' => time()
            ]);

            $userGuest->save(false);
        }

        return $this->render('profile', [
            'model' => $user
        ]);
    }

    public function actionChangePassword()
    {
        $post = Yii::$app->request->post();

        if (!empty($post['password']) && !empty($post['password_again'])) {
            if ($post['password'] != $post['password_again']) {
                Yii::$app->session->addFlash('error', 'Пароли не совпадают.');
                return $this->render('change-password');
            }

            /**
             * @var $user User
             */
            $user = Yii::$app->user->identity;
            $user->setPassword($post['password']);
            $user->save(false);

            Yii::$app->session->addFlash('success', 'Новый пароль успешно назначен.');
        }

        return $this->render('change-password');
    }

    public function actionForgotPassword()
    {
        $post = Yii::$app->request->post();

        if (!empty($post['email'])) {
            /**
             * @var $user User
             */
            $user = User::findByEmail($post['email']);

            if ($user == null) {
                Yii::$app->session->addFlash('error', 'Пользователь с таким email-адресом не найден.');
            } else {
                $password = Yii::$app->security->generateRandomString(8);
                $user->setPassword($password);
                $user->save(false);

                if (Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['adminEmail'])
                    ->setTo($user->email)
                    ->setSubject(Yii::$app->name . ': восстановление пароля')
                    ->setHtmlBody('Ваш новый пароль: ' . $password)
                    ->send()
                ) {
                    Yii::$app->session->addFlash('success',
                        'Новый пароль успешно назначен. Письмо с паролем отправлено на указанный email-адрес.');
                }
            }
        }

        return $this->render('forgot-password');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionFriends($id)
    {
        $model = User::findOne($id);
        $friendUsers = User::friendList($id);

        $friendsRequests = FriendRequest::find()
            ->where(['user_to' => $id])
            ->all();

        return $this->render('friends', [
            'model' => $model,
            'friendUsers' => $friendUsers,
            'friendsRequests' => $friendsRequests
        ]);
    }

    public function actionRemoveFriend($id)
    {
        $user = User::findOne($id);

        User::removeFriendship(Yii::$app->user->id, $id);
        Yii::$app->session->addFlash('warning', $user->getFullName() . ' удален из списка друзей.');

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionCreateFriendRequest($id)
    {
        /**
         * Проверяем не было ли обратного запроса.
         */
        $friendRequestExist = FriendRequest::find()
            ->where([
                'user_from' => $id,
                'user_to' => Yii::$app->user->id
            ])->exists();

        if ($friendRequestExist) {
            User::createFriendship(Yii::$app->user->id, $id);
            Yii::$app->session->addFlash('success', 'Пользователь добавлен в список друзей.');
        } else {

            $friendRequest = new FriendRequest([
                'user_from' => Yii::$app->user->id,
                'user_to' => $id
            ]);

            if ($friendRequest->save()) {
                Yii::$app->session->addFlash('success', 'Запрос в друзья отправлен.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAcceptFriendRequest($id)
    {
        $request = FriendRequest::findOne($id);

        if ($request != null) {
            User::createFriendship($request->user_from, $request->user_to);
            Yii::$app->session->addFlash('success', 'Пользователь добавлен в список друзей.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeclineFriendRequest($id)
    {
        $request = FriendRequest::findOne($id);

        if ($request != null) {
            $request->delete();
            Yii::$app->session->addFlash('warning', 'Запрос на добавление отклонен.');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}