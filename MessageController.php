<?php

namespace app\controllers;

use app\models\User;
use app\models\Message;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class MessageController extends Controller
{
    public $layout = '//messages';


    public function actionIndex()
    {
        $messageModel = new Message();

        /**
         * @var $user User
         */
        $user = Yii::$app->user->identity;

        /**
         * Получить список пользователей, с которыми есть диалоги.
         */
        $query = User::find()
            ->select(['user.*', 'um.time'])
            ->leftJoin('message as um', 'um.from = user.id OR um.to = user.id')
            ->orWhere(['um.from' => $user->id])
            ->orWhere(['um.to' => $user->id])
            ->andWhere('user.id != :user_id', [':user_id' => $user->id])
            ->orderBy(['um.time' => SORT_DESC]);
//        $sql = $query->createCommand()->rawSql;

        $list = $query->all();

        $userList = [];
        foreach ($list as $user) {
            if (!key_exists($user->id, $userList)) {
                $userList[] = $user;
            }
        }

        return $this->render('index', [
            'messageModel' => $messageModel,
            'user' => $user,
            'userList' => $userList,
        ]);
    }

    public function actionAdd()
    {
        $messageModel = new Message();

        if (Yii::$app->request->isPost && $messageModel->load(Yii::$app->request->post())) {
            $toUser = $messageModel->to;

            $messageModel->from = Yii::$app->user->id;
            $messageModel->read = 0;
            $messageModel->time = time();

            if ($messageModel->save()) {
//                Yii::$app->session->addFlash('success', 'Сообщение успешно отправлено.');
                return $this->redirect(['/message/index', 'to' => $toUser]);
            }
        }

        return $this->redirect([Yii::$app->request->referrer]);
    }

    public function actionAddNew($user_id)
    {
        $messageModel = new Message([
            'from' => Yii::$app->user->id,
            'to' => $user_id,
            'read' => 1
        ]);

        if ($messageModel->save()) {
            return $this->redirect(['/message/index', 'to' => $user_id]);
        }

        return $this->redirect([Yii::$app->request->referrer]);
    }

    public function actionView()
    {
        $messageModels = [];
        $user_id = Yii::$app->request->post('user_id');
        $toUserModel = User::findOne($user_id);

        /**
         * @var $currUserModel User
         */
        $currUserModel = Yii::$app->user->identity;

        if ($user_id != null) {
            $query = Message::find()
                ->orWhere(['AND', ['from' => $user_id], ['to' => $currUserModel->id]])
                ->orWhere(['AND', ['to' => $user_id], ['from' => $currUserModel->id]]);

            $messageModels = $query->all();

            Message::updateAll([
                'read' => 1
            ], [
                'from' => $user_id,
                'to' => $currUserModel->id,
            ]);
        }

        return $this->renderPartial('view', [
            'messageModels' => $messageModels,
            'currUserModel' => $currUserModel,
            'toUserModel' => $toUserModel
        ]);
    }
}
