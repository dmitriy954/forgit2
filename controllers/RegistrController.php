<?php


namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Registration;
use app\models\TempUser;
use yii\bootstrap\ActiveForm;
use app\models\User;
use app\models\Givemepassform;
use app\models\Newpassform;
use yii\helpers\Url;

class RegistrController extends Controller
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
	 
	 public function action()
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
	
	public function actionRegistration()  {
		
		
		
		
		$model  = new Registration();
		// это здесь не применяется. единственное обращение аякс идет к другому экшену.
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    Yii::$app->response->format = Response::FORMAT_JSON;  // выяснить 
    return ActiveForm::validate($model);
}
		if ($model->load(Yii::$app->request->post()) && $model->validate()) 
		{
			 $randstr = Yii::$app->getSecurity()->generateRandomString();
			$email = $model->email;
			$email = trim ($email);
			$st = Url::to(['registr/rogerlog', 'st' => $randstr]);
			$st = "http://suvoroyq.bget.ru" . $st;
			$st = "Перейдите по ссылке, чтобы подтвердить регистрацию \r\n" . $st;
			$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
			$fl = mail ($email, "Подтверждение регистрации", $st, $headers);
			
           $tu = new Tempuser();
           $tu->name = $model->name;
		   $tu->surname = $model->surname;
		   $tu->email = $model->email;
		   $tu->login = $model->login;
		   $tu->password = $model->password;
		   $tu->randstr =  $randstr ;
		   $tu->save();
		   return $this->render('goodreg', ['model' => $model]);
        }
		// Yii::$app->view->params['myp'] = '5';
		return $this->render('registration', ['model' => $model, ]);
		
		
		
		
		
		
	}
	
	public function actionRogeroncemore()  {
		
		$model = new Givemepassform();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) 
		 {
			//$loe =  $model->loginoremail;
			
			$inst = $model->existlogoremOnTemp();
			if ($inst)
			{
				$randstr = Yii::$app->getSecurity()->generateRandomString();
				$inst->randstr = $randstr;
				if ($inst->save())
				{
					$email = $inst->email;
			        $email = trim ($email);
			        $st = Url::to(['registr/rogerlog', 'st' => $randstr]);
			        $st = "http://suvoroyq.bget.ru" . $st;
			        $st = "Перейдите по ссылке, чтобы подтвердить регистрацию \r\n" . $st;
			        $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
			        $f = mail ($email, "Подтверждение регистрации", $st, $headers);
				//	echo $f;
					if ($f)
					{
						// вам высланы данные на е-майл
						 return $this->render('info', ['str' => 'вам выслано письмо  на е-майл чтобы подтвердить регистрацию']); 
					}
					else 
					{
						$st = 'не получается отправить письмо на е-майл. Возможно вы указали неверный е-майл. Попробуйте зарегистрироваться заново';
						// не получается выслать данные на е-майл
						return $this->render('info', ['str' => $st]); 
						
					}
					
					
				}
				else 
				{
					// ошибка 
					echo "ошибка";
					
				}
				
			}
			else
			 {
				// нет такого пользователя во временной таблице
				 return $this->render('info', ['str' => 'нет такого пользователя во временной таблице. ']); 
			 }
			
		 }
		else
		{
			
			 return $this->render('RogerOnceMore', ['model' => $model]) ; 
			
			
		}
		
		
	}
	
	
	public function actionRogerlog()  {
		$request = Yii::$app->request;
		$st = $request->get('st');
		$tu = NULL;
		$tu = TempUser::findOne(['randstr' => $st]);
		if (strcmp ($tu->randstr, $st) == 0)
		{
			
			$us = new User();
			$us->email = $tu->email;
			$us->username = $tu->login;
			$us->password = $tu->password;
			$us->name = $tu->name;
			$us->surname = $tu->surname;
			$us->randstr = $tu->randstr;
			$us->save();
			$tu->delete();
			return $this->render('rogergood');
			
		}
		else {
			$uu = User::findOne(['randstr' => $st]);
			 if (strcmp ($uu->randstr, $st) == 0)
			   return $this->render('rogerbad', ['f' => 1]);
		     else
			   return $this->render('rogerbad', ['f' => 2]); 
			
		}
		
	}
	// страница восстановления пароля
	// во временной таблице никаких записей не создается, просто меняется статус в основной
	public function actionGivemepass() {
		$model = new Givemepassform();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) 
		 {
			//$loe =  $model->loginoremail;
			
			$id = $model->existlogorem();
			//echo ($id);
			if ($id)
			{
				
				$inst = User::findOne($id);
				if ($inst)   // вообще то не нужно
				{
					 $randstr = Yii::$app->getSecurity()->generateRandomString();
					 
					 
					 $st = Url::to(['registr/renewpass', 'st' => $randstr]);
			$st = "http://suvoroyq.bget.ru" . $st;
			$st = "Перейдите по ссылке, чтобы восстановить пароль \r\n" . $st;
			$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
			
					 
					 
					 
			         $fl = mail (trim($inst->email), "восстановление пароля", $st);
					 $inst->randstr = $randstr;
					 $inst->status = 3;
					 $inst->save();
					 return $this->render('changepass');
					 // На ваш емайл выслано письмо. Пройдите по ссылке в письме, чтобы изменить пароль
					
				}
				
			}
			
			else
				{
				   return $this->render('givemepass', ['model' => $model, 'flag' => 3]) ; // вместе с сообщением, что такого логина или емайла не найдено
				}
			
			
		
		 }
		 
		 else return $this->render('givemepass', ['model' => $model, 'flag' => 1]);  // здесь флаг просто так
		
		 
		
		
	}
	
	
	//ajax
public function actionReviselog()  { 
	
	$val = $_POST["vallog"];
	$usc = User::find()
	->where (['username' => $val])
	->count();
	if ($usc > 0) 
	   return "1";
    else
		return "0";
	
	
	
	}
	
	
	
	
	
	
	public function actionRenewpass()  {
		
		$request = Yii::$app->request;
		$st = $request->get('st');
		// $tu = NULL;
		$model = new Newpassform();
		
		$us = User::findOne(['randstr' => $st]);
		
		if ($us)
		{
			if ($us->status == 3)
			   {
			     if ($model->load(Yii::$app->request->post()) && $model->validate()     )
			       {
				     $us->password = $model->password;
			         $us->status = 1; // можно и нулл, но пусть 1
				     $us->save();
					 return $this->render('changepass2', ['flag' => 1]); // пароль изменен
				   } 
				 else
				   {
					  return $this->render('newpass', ['model' => $model, 'name' => $us->username]); 
					  // форма ввода нового пароля
				   }
			   }
            else
			  {
				 return $this->render('changepass2', ['flag' => 2]); 
				// по этому коду уже было восстановление, запросите новый код
				
			  }				
				
				
			
		}
		else {
			
			return $this->render('changepass2', ['flag' => 3]);  // неизвестная строка. Свяжитесь пожалуста с нами
			
		}
	
		
		
		
	}
	
	
	
	
	
	
}