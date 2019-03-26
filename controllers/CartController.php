<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use app\models\Buketi;
use app\models\Buket;
use app\models\Datasorder;
use app\models\TempOrders;
use app\models\TempOrdersBuks;
use app\models\Orders;
use app\models\OrderBuks;
use yii\web\MethodNotAllowedHttpException;


class CartController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return string
     */
	 
	 public function actionIndex()
    {
		
		$strforjs = "";
		$mass_of_bukets = [];
		$mass_of_kols = [];
		$endarr = [];
		
		$buk = new Buketi();
		
		$session = Yii::$app->session;
	    $main_ses = $session->get('massbukandkols_ses');
	    if ($main_ses)
		 {  $strbuk = $main_ses;   }  
	    else {  $cookies = Yii::$app->request->cookies; $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
	
		//echo $strbuk;
		if (strcasecmp ($strbuk, "deff") != 0)
		   {
			 $endarr  = unserialize ($strbuk);  
			   
		   }
		   
		
		
		$total = 0; 

	    if (is_array ($endarr) && count($endarr) > 0)
	
		  {
			 $strforjs = implode ("xxx", $endarr) ;
			  
			  
			  
		  }
		if (is_array ($endarr) && count($endarr) > 0)
		  {
		  
		    foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st); 
				 $id = 1 * $mass_str [0];
				 $kol = 1 * $mass_str [1];
				 $buk = Buketi::findOne ($id);
				 $total = $total + $buk->price * $kol;
				 $mass_of_bukets[] = $buk;
				 $mass_of_kols[] = $kol;
				 
				
			  }
		  }
		  
	    $buketi = new Buketi();
		$buketi = Buketi::find()
		   ->where(['adjunct' => 1])
		   ->all();
	//	echo "jhj"	;
        return $this->render('index', ['mass_of_bukets' => $mass_of_bukets, 'mass_of_kols' => $mass_of_kols, 'total' => $total, 'buketi' => $buketi, 'strforjs' => $strforjs]);
			
			
		
    }
	
	
	public function actionRenewkol()
	{
		$ch = $_POST["idbuk"];
		$endarr = [];
		$endarr2 = [];
		$mass_str = [];
		$cookies = Yii::$app->request->cookies;
		$strbuk = $cookies->getValue('massbukandkols', 'deff');
		//$strkol = $cookies->getValue('masskolofbuks', 'deff');
		$bukbd  = new Buketi();
		
		
		
		
	}
	
	
	// добавление дополнительного товара
	// $readystr  -  на странице корзины пользователь может менять количество товаров. это строка с товарами, у которых пользователь менял
	// количество. ид товара и его установленное кол-во
	 public function actionAddadj($id, $readystr) 
      {
		 $endarr = [];
		$endarr2 = [];
		$mass_str = [];
		$mass_str2 = [];
	//	echo $id; 
		//echo $readystr;
		//$cookies = Yii::$app->request->cookies;
		//$strbuk = $cookies->getValue('massbukandkols', 'deff'); 
		
		// $req = Yii::$app->request;
	//	$id = $req->get('id');
		
	//	if (strcasecmp ($strbuk, "deff") == 0)
		
			$endarr  = unserialize ($readystr);
			
			if ( is_array($endarr) && count($endarr) > 0)
			 {
			  foreach ($endarr as $st)
			   {
				 $mass_str = explode ("ddd", $st); 
				 
				 if (strcasecmp ($mass_str[0], $id) != 0) 
				 {
					 $endarr2[] = $st;
					
					 
				 }
			   }
			 }
			  
			  
            $st = $id . "ddd" . "1"  ;
			$endarr2[] = $st;
			$str = serialize ($endarr2);
			$session = Yii::$app->session;
			$session->set('massbukandkols_ses', $str);
			$cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                        'name' => 'massbukandkols',
                        'value' => $str,
						'expire' => time() + 3600*24*30,
                          ]));
					
		  
		  
		   return $this->redirect (['index']);
		  
	  }
	  
	  
	
	 public function actionDelete($id, $readystr)  // вообще то редирект шлет гет параметры. поэтуму для надежности можно переписать
      {
		 // echo $readystr;
		$endarr = [];
		$endarr2 = [];
		$mass_str = [];
		$mass_str2 = [];
		
	//	echo $id;
		
		//$cookies = Yii::$app->request->cookies;
		//$strbuk = $cookies->getValue('massbukandkols', 'deff'); 
		
		// $req = Yii::$app->request;
		// $id = $req->get('id');
		
		
		// if (strcasecmp ($strbuk, "deff") == 0)
		
			$endarr  = unserialize ($readystr);
			if (count ($endarr))
			{
			  foreach ($endarr as $st)
			   {
				// echo $st; 
				 $mass_str = explode ("ddd", $st); 
				 
				 if (strcasecmp ($mass_str[0], $id) != 0) 
				 {
					 $endarr2[] = $st;
					
					 
				 }
			   }
			}
			

              $cookies = Yii::$app->response->cookies;
               if (count($endarr2) == 0)
					 {
						 $cookies->remove('massbukandkols');
						 $session->remove('massbukandkols_ses');
					 }
			   else
					 {
                        $str = serialize ($endarr2);
						$session = Yii::$app->session;
						$session->set('massbukandkols_ses', $str);
                        $cookies->add(new \yii\web\Cookie([
                        'name' => 'massbukandkols',
                        'value' => $str,
						'expire' => time() + 3600*24*30,
                          ]));
					 } 


          return $this->redirect (['index']);
		
		  
	  }  
		  

 public function actionEnterdata()		
 {
	// после того как клиент зашел в корзину и выбрал оформить заказ, его кидает на страницу ввода данных
	Yii::$app->view->params['totkol'] = -1; //  при значениях больше нуля соответствующие виевы берут эти параметры
	// так как не всегда можно обойтись сессиями для отображения оперативного изменения этих данных
	// но тут по умолчанию они в минусе
	Yii::$app->view->params['totprice'] = -1; 
    $arr1 = [];
	$arr2 = [];
	$endarr = [];
    $endarr2 = [];
	$mass_str = [];
	$mass_str2 = []; 
	$mass_ids = [];
	 $order = new TempOrders(); // это временный заказ, далее еще будут добавляться в другую таблицу товары относящиеся к заказу.
	 
	$total_control = 0; 
	$delim1 = "gg";
	$delim2 = "xx";
	$request = Yii::$app->request;
    $post = $request->post();
	$lch = $post['listchange']; // в этом преобразованном в строку массиве хранятся списки букетов, у которых клиент изменял количество
	// то же самое, ид букета и обновленное количество. 
	$tot = $post['totalinp'];
	

	
	$model = new Datasorder();
	// если это обработка уже введенных данных
	if ($model->load(Yii::$app->request->post()) )
		{
			
		  
			// была создана временная строка во временной таблице (далее в елсе)
			     
				   $flag = 1;
				 //  echo $flag;
				 // во временной строке временной таблицы была создана котрольная случайная строка, которая передавалась в форму
				   $tempord = TempOrders::findOne ($model->idt); // в форму передавался ID  строки временной таблицы
				  
				   if ($tempord == null)
				     {  $flag = 0; }
			       else 
					if ($tempord->control_string != $model->controlst)  // проверка чтоб клиент не обманул. совпадение строк. 
					{
						$flag = 0;
						
						// echo $tempord->idt;
						
					}
					
				   if ($flag == 1) // если во временной таблице есть строка с таким идом и контрольные строки совпали.
				   {
					   if ($model->validate()) {
						  
						  // формируем строку заказа в постоянной таблице
						 			  
						  $ordbd = new Orders(); 
						  
						  $ordbd->totprice = $tempord->total_price;
                          $ordbd->iduser = $tempord->user_id;			
						  $ordbd->name = $model->name;
						  $ordbd->mail = $model->email;
						  $ordbd->mobile = $model->mobile;
						  $ordbd->town = $model->town;
						  $ordbd->street = $model->street;
						  $ordbd->house = $model->house;
						  $ordbd->kvoret = $model->kvoret;
						  $ordbd->datemy = $model->datemy;
						  $ordbd->whentime = $model->whentime;
						  $ordbd->mobileto = $model->mobileto;
						  $ordbd->textotkr = $model->textotkr;
						  $ordbd->dost = $model->dost;
						  $ordbd->oplata = $model->oplata;
						//  $ordbd->textcomment = $model->textcomment;
						  $ordbd->textcomment = $model->textcomment;
						  $ordbd->nametaker = $model->nametaker;
						  
						  if ($model->oplata == 2 ) // наличные курьеру
						   $ordbd->status = 1; // заказ в оплате не нуждается
					      else {
						  $ordbd->status = 2; // заказ нуждается в оплате, но не оплачен
						  }
						  
						  if ($ordbd->save())
						  // добавить исключение
						  {
							  // товары по заказу переносим из временной таблицы в постоянную
							   $fbuks = 1;
							   
							   $buks_of_tempord = TempOrdersBuks::findAll(['id_order' => $model->idt]);
							   foreach ($buks_of_tempord as $tempbuk)
							   {
								  $buk_of_ord = new OrderBuks();
								  $buk_of_ord->id_ord = $ordbd->id;
								  $buk_of_ord->id_buk = $tempbuk->id_buk;
								  $buk_of_ord->price = $tempbuk->price;
								  $buk_of_ord->kol = $tempbuk->kol;
								  $d = $buk_of_ord->save();
								  if (!$d)
								  {
									throw new MethodNotAllowedHttpException($message = "Не удалось сохранить данные в базу данных (список товаров)");  
									$fbuks = 0;  
								  }
								   
							   }
							   foreach ($buks_of_tempord as $tempbuk)
							   {
								  $tempbuk->delete();  // оцищаем товары из временной таблицы
							   }
							   // очищаем строку заказа из врменной таблицы
							   $tempord->delete(); // отсюда надо что-нибудь взять в основную
							   // сюда исключение
							  // заказ сормирован и куки нам больше не нужны, как и запись во временной таблице (нет записи -> создается ошибка)
							   $cookies = Yii::$app->response->cookies;
							   $session = Yii::$app->session;
         					   $cookies->remove('massbukandkols');
							   $session->remove('massbukandkols_ses');
							   
							   if ($fbuks)
							   {
								  if ($ordbd->oplata != 2 )
						            {
							             return $this->redirect(['payemulate', 'id' => $ordbd->id]);
						            }
						          else {
							          Yii::$app->view->params['totkol'] = 0;
						              Yii::$app->view->params['totprice'] = 0;
						              return $this->render ('goodwithoutpay', ['id' => $ordbd->id]); 
									  } 
								   
							    }
							  
							  
						  }
						  else 
						  {
							  // вот сюда сров нью эксептион
							  throw new MethodNotAllowedHttpException($message = "Не удалось сохранить данные в базу данных");  
						  }
						  
						  
						  
						  // перенести выше в сейв а здесь добавить исключение (после вызова исключения дальше ничего и не сработает)
						
						  
						  
						   
						   
					   }
					   else
					   {
						   // если не пройдена валидация
						    return $this->render (enterdata, ['post' => $post, 'model' => $model, 'idt' => $model->idt, 'controlst' => $model->controlst]) ;
						   // не знаю зачем тут post
					   }
					   
				   }
				   else
				   {
					  // исключение 
					    return $this->render (diffcontrolsumm);  
				   }
			
				
				
			
		}
else  // если это первичная отправка формы (имеется ввиду отправка формы на заполнение данных клиентом)
        {
			$mytotkol = 0;
			
			if (isset ($post['idadd']))
			{   $idadd = 1 * $post['idadd'];  }
			else
			{    $idadd = NULL;    }
	        if (isset ($post['iddel']))
			{   $iddel = 1 * $post['iddel'];  }
			else
			{ $iddel = NULL;  }
		//echo $iddel;
		    $arr1 = [];
		  // строка с идами , по которым клиент менял количестиво, и соответсвенно с количествами
		    if (strlen ($lch) > 2) //если пользователь менял какие-то количество и соответственно если строка не пустая
	        $arr1 = explode ($delim1, $lch); 
		// массив букетов, в которых клиент менял количество. а точнее массив строк - ид букета, разделитель, новое количество
	///////////////////////////////////////
            $session = Yii::$app->session;
	        $main_ses = $session->get('massbukandkols_ses');
            if ($main_ses)
		       {  $strbuk = $main_ses;   }  
	         else {  $cookies = Yii::$app->request->cookies; $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
	
	//	echo $strbuk;
	    // из куков мы берем в принципе массив товаров, которые заказал клиент, но со старыми количествами. 
		    $readystr = "";
		    if (strcasecmp ($strbuk, "deff") == 0)  // если куки пустые
		     {
			   if ($iddel)  {  return $this->redirect(['index']);    }
		     }
	        else
		     {
			  if (strlen ($strbuk) > 2 ) // если не пустой
			    $endarr  = unserialize ($strbuk); // массив из куки со списком (ид букета, разделитель, количество)
			
		    
			 if (count($endarr)   > 0  )
			 {
			 foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st);  // массив строчек, каждая из которых ид букета и количество
				 
				 foreach ($arr1 as $strchangekol) //  $arr1 массив с букетами, у которых клиент обновлял количество. (ид букета и новое количество)
				   {
					// echo " ?  " ; echo $strchangekol ; echo " ? " ;
					 $arr2 = explode ($delim2, $strchangekol);   // масив из двух элементов (ид букета и количество)
					// echo " ** ";   echo  $mass_str[0];       echo " ** ";
					// echo " *** ";   echo  $arr2[0];       echo " *** ";
					 if (  strcasecmp ($mass_str[0] , $arr2[0]) == 0)   // $mass_str[0] - ид букета из куки ,,, $arr2[0] - ид букета из массива с обновленным количеством
					    {
							// если они совпадают, то меняем количество
							$mass_str[1] = $arr2[1];
							
						  //  echo " * ";   echo  $mass_str[1];       echo " * ";
					    }
					 
				   }
				   
				  $mytotkol = $mytotkol + $mass_str[1];
				   
				  $st = implode ("ddd", $mass_str) ; // собираем строку обратно
				 // echo " *@ ";   echo  $st;       echo " *@ ";
                  $endarr2[] = $st;		// сюда переписываем массив из куки, и количества букетов тут уже обновлены	

                  $readystr = serialize ($endarr2)	;	

                  
			  }
			}
			  
		}   
		if ($idadd != 0)	
				    {
						// echo $idadd;
						//$st3 = "addadj&id=" . $idadd;
					    return $this->redirect(['addadj', 'id' => $idadd, 'readystr' => $readystr]);
					  
					  
				    }	
        else
				    {
					   if ($iddel != 0)
					     {
							// echo $readystr;
						 //  $st3 = "delete&id=" . $iddel;
						   return $this->redirect(['delete', 'id' => $iddel, 'readystr' => $readystr]);
					     }
					  
					  
				    }					  
		 
	
	
	// далее идет блок проверки равенства переданной общей суммы и подсчитанной суммы (чтоб клиент не обманул)
// то есть из куки берем иды заказанных букетов и их количество, и далее из таблицы букетов берем цены на эти букеты.
// считаем общую сумму и проверяем на совпадение с суммой, переданной из формы 
     if (strcasecmp ($strbuk, "deff") == 0)   
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			throw new MethodNotAllowedHttpException($message = "Это действие для вас недоступно. В вашей корзине нет товаров");
			 
		   }
	 else
		   {
			
			$endarr  = unserialize ($strbuk);
			
			foreach ($endarr as $st)	
			  {
				$mass_str = explode ("ddd", $st); 
				$mass_ids[] = $mass_str[0];   // формируем массив с id товаров из корзины
				
			  }	
            }	
			
			
				// берем из базы букеты по составленному массиву идов
    $bukets = Buketi::findAll ($mass_ids)	;
    $endarr  = unserialize ($strbuk);
	
    foreach ($bukets as $buket)	
	  {
		$id = $buket->id;
		$pr = $buket->price * 1;
		
		// сначала берем количество из куки
		$kol = 0;	
		foreach ($endarr as $st)   // повторяем то, что было до этого (см. выше) 
		// а то есть учитываем и строку с идами товаров, по которым производил клиент изменение кол-ва (иды и новые кол-ва по ним)
			  {
				 $mass_str = explode ("ddd", $st); 
		          if (  strcasecmp ($mass_str[0] , $id) == 0)
					    {
		                  $kol = 1 * $mass_str[1];
						}
			  }
			  
		// потом если есть - количество из массива с изменными кол-вами, переданное через форму  
	    foreach ($arr1 as $strchangekol)
				   {
					// echo " ?  " ; echo $strchangekol ; echo " ? " ;
					 $arr2 = explode ($delim2, $strchangekol);
					// echo " ** ";   echo  $mass_str[0];       echo " ** ";
					// echo " *** ";   echo  $arr2[0];       echo " *** ";
					 if (  strcasecmp ($id , $arr2[0]) == 0)
					    {
							
							$kol = $arr2[1];
						  //  echo " * ";   echo  $mass_str[1];       echo " * ";
					    }
					 
				   }
			  
		$tot1 = $pr * $kol;
		$total_control = $total_control + $tot1;
		
		
		
		
	     }
		 
		  $cookies2 = Yii::$app->response->cookies;
// сохраняем в куки массив с обновленными количествами по букетам. 
         if (count($endarr2) == 0)
					 {
						 $cookies2->remove('massbukandkols');
						 $session->remove('massbukandkols_ses');
						 // и генерация исключения
					 }
	     else
					 {
                        
						$str = serialize ($endarr2);
						$session->set('massbukandkols_ses', $str);
					//	echo " *@* ";   echo  $str555;       echo " *@* ";
						// $cookies->remove('massbukandkols');
                        $cookies2->add(new \yii\web\Cookie([
                        'name' => 'massbukandkols',
                        'value' => $str,
						'expire' => time() + 3600*24*30,
                          ]));
					 }     
					 

   
	     $tot = 1 * $tot;
	     $total_control = 1 * $total_control;
	     $mytotprice = $tot;
	     if ($total_control == $tot)   // если пройдена проверка на равенство общей суммы. 
	            {
		
		            $idt = null; $controlst = null; // добавление временного заказа, и эти же данные будут скрытыми инпутами отправлены в первичную форму
					
		            if (count($endarr2) != 0 && $total_control == $tot)  // повторение условия 
			             {		
					          $order = new TempOrders(); // временный заказ
		                      $order->total_price = $tot;
				              $randstr = Yii::$app->getSecurity()->generateRandomString(); // проверка на обман, контрольная строка.
		                      $order->control_string = $randstr;
							  // далее снам нужен ид клиента. 
							  $identity = Yii::$app->user->identity;
							  $idus = Yii::$app->user->id;
							  $order->user_id = $idus;
				              if ($order->save())
				                    {
					//echo $order->id;       
					                         $idt = $order->id;
											 $controlst = $order->control_string;
											 
				                     }
							  else 
							         {
										
								       throw new GoneHttpException($message = "Не удалось сохранить данные в базе данных");
								  
								  
							         }
										 
		
			              }
		               // нужная ли это проверка
	                 if ($idt != null && $controlst != null)
					  {
						 // товары по временнуму заказу тоже во временную таблицу
						  foreach ($endarr2 as $st)
						   {
							  $mass_str = explode ("ddd", $st); 
							  $buktemp = new TempOrdersBuks();
							  $buktemp->id_buk = $mass_str[0];
							  $buktemp->id_order = $idt;
		                      $buktemp->kol = $mass_str[1];
							  $bb = Buketi::findone($mass_str[0]);
							  // след стр - исключение
							  $buktemp->price =  $bb->price;
							  //исключение  
							  $buktemp->save();
		                 


//						 $kol = 1 * $mass_str[1];
						
							  
							  
							  
						   }
					 
					    Yii::$app->view->params['totkol'] = $mytotkol;
						Yii::$app->view->params['totprice'] = $mytotprice;
					 
					    return $this->render (enterdata, ['post' => $post, 'model' => $model, 'tot' => $tot, 'idt' => $idt, 'controlst' => $controlst]) ;
					  }
					   
	            }
	     else 
	               {
		                return $this->render (diffcontrolsumm);
						// продумать получше исключение
		 
	               }

        }
 
 } 
 

	
 public function actionPayemulate($id)
 {
	  return $this->render (payemulate, ['id' => $id]);
	 
 }
 public function actionPayemulate2()
 {
	 
	  $request = Yii::$app->request;
      $id = $request->get('id');
	  return $this->render (payemulate, ['id' => $id]);
	 
 }
 
 public function actionTakepay()
 {
	  $request = Yii::$app->request;
      $id = $request->get('id');
	  
	  $ord = Orders::findOne ($id);
	//  echo $ord->status;
	//  $ord->payornot = 1;
	  $ord->status = 3;
	  if (!$ord->save(false) )
	    throw new MethodNotAllowedHttpException($message = "Не удалось изменить данные по заказу");  
	  
	  return $this->render (rogerpay, ['id' => $id]);
	 
 }
 
 
 
 
 public function actionReadyorder()
 {
	 
	 
 }

 public function actionEnterdata2()		
 {
// echo "hhhh";
  $cookies2 = Yii::$app->request->cookies; 

$language = $cookies2->getValue('language', 'en');
 
 
 $cookies1 = Yii::$app->response->cookies;


 $cookies1->add(new \yii\web\Cookie([
    'name' => 'language',
    'value' => 'wert444579',
]));   


$language = $cookies2->getValue('language', 'en');
 return $this->render (checking2, ['lang' =>  $language]);

// echo "qqq";




 //   echo "----"; echo $language; echo "----";

 
 




	

//	return $this->render (enterdata) ;
	
 }
 
  public function actionEnterdata3()		
 {
	 
	 $cookies2 = Yii::$app->request->cookies; 

$language = $cookies2->getValue('language', 'en');
echo "----";
echo $language;
echo "----";
  
	 
 }

 
 public function beforeAction($action) {
  //echo $action->id;
  if ($action->id === "index")
   {
     $nameses = "doing_for_rating";
     $session = Yii::$app->session;
     $session->open();
  // $str9 = "filtbase";  // когда переключаются страницы, используется только get параметр. поэтому приходится работать с сессиями
     $getses = $session->get ($nameses);
	 if ($getses == NULL)
	 {
		// echo "ffff";
		 $randstr = Yii::$app->getSecurity()->generateRandomString();
		 $session->set($nameses, $randstr);
		 
	 }
	 		 
	 $session->close();
   }   
 // echo "hhh";
  return parent::beforeAction($action);
}
 
 
		  
}