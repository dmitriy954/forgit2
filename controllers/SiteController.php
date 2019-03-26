<?php

namespace app\controllers;
require_once ("serv.php");
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\ActiveRecord;
use app\models\Buketi;
use app\models\Buketi_ims;
use app\models\Alonecat;
use app\models\Buket;
use app\models\Mainmenu;
use yii\web\UploadedFile;
use app\models\FilterData;
use yii\data\Pagination;
use app\models\Ratings;
use yii\data\ArrayDataProvider;
use app\models\Onlytest;
use yii\helpers\Url;





class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
	public $randses;
	
    public function behaviors()
    {
		
	//	$dependency = new \yii\caching\DbDependency(['sql' => 'SELECT MAX(mydate) FROM mainmenu']);
	$request = Yii::$app->request;
		
	
	 $mys = 'SELECT MAX(mydate) FROM buketi';
	//	echo "345";
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
		/*	'pageCache4' => [
                 'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 0,
                'dependency' => [
                'class' => 'yii\caching\DbDependency',
                'sql' => 'SELECT MAX(mydate) FROM mainmenu',
                ],    
            ],    */

      /*    'pageCache' => [
                 'class' => 'yii\filters\PageCache',
                'only' => ['allbukets'],
                'duration' => 0,
				'dependency' => [
                'class' => 'yii\caching\DbDependency',
                'sql' => $mys,
                ],    
				'variations' => [
                Yii::$app->request->get('page', 1),
				Yii::$app->request->get('unioncat'),
			//	Yii::$app->request->post('FilterData')['sort2'],
			//	Yii::$app->request->post('FilterData')['sort1'],
				$this->getPost1(),
				$this->getPost2()
                  ],
				 'enabled' =>  $this->getChangeParam() === true,
			
               
            ],   */   
			 
                
             
			
		//	Yii::$app->request->get('page', 100);
			
			
        ];  
    }

	/**
	
	 'dependency' => [
                'class' => 'yii\caching\DbDependency',
                'sql' => 'SELECT MAX(mydate) FROM mainmenu',
                ],  
**/				
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
	 public function actionMytest()
    {
		//echo "3";
		$cache = Yii::$app->cache;
		
		//$key = 'demo';
		$x =  $cache->flush();
		return $this->render('mytest');
		
		
	}
	 
    public function actionIndex()
    {
		$st = '@web';
		//$st = yyy();
		//echo ($st);
		
		$st = Yii::getAlias('@app');
		//echo ($st);
		$categories1 = MainMenu::findAll(['id_cat' => 1]); // проверить соответствие типов
		$categories2 = MainMenu::findAll(['id_cat' => 2]);
		$categories3 = MainMenu::findAll(['id_cat' => 3]);
		$categories4 = MainMenu::findAll(['id_cat' => 4]);
		
		$buketi = Buketi::find()
			-> orderBy (['popul' => SORT_DESC])
			-> where (['adjunct' => 0])
			-> limit (16)
		   ->all();
		$p = 10;
        return $this->render('index', ['categories1' => $categories1, 'categories2' => $categories2,
		'categories3' => $categories3, 'categories4' => $categories4, 'buketi' => $buketi, 'p' => $p]);
    }
	
    public function actionRemc()
	{
		
		 $session = Yii::$app->session;
		 $cookies = Yii::$app->response->cookies;
         $cookies->remove('massbukandkols');
		 $session->remove('massbukandkols_ses');
	}
	
public function actionAja1()  // запрос по аяксу
	{
		$poststr = $_POST["idbuk"]; // добавление товара, приходит ид  товара и количество
		$poststr2  = $poststr;
		$endarr = [];
		$endarr2 = [];
		$mass_str = [];
		$mass_str2 = [];
		$cookies = Yii::$app->request->cookies;
		$strbuk = $cookies->getValue('massbukandkols', 'deff');
		
		$cookies = Yii::$app->request->cookies;
        $session = Yii::$app->session;
	    $main_ses = $session->get('massbukandkols_ses');
	    if ($main_ses)
		  {  $strbuk = $main_ses;   }  
	    else {  $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
	
	
		
		
		
		//$strkol = $cookies->getValue('masskolofbuks', 'deff');
		
	    $mass_str2 = explode ("ddd", $poststr); // массив пост
		
		$id_ex = $mass_str2[0];
		$buk =  Buketi::find()
		  ->where(['id' => $id_ex])
          ->one();
		if ($buk)
		{
		
		$bukbd  = new Buketi();
		
		
		
		
		
		if (strcasecmp ($strbuk, "deff") != 0)
		
		  {
			$endarr  = unserialize ($strbuk); // куки
			
			foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st); // ид товара и количество
				 // добавляем все строки из куки, кроме той (если такая окажется), что совпадает по иду со строкой, переданной через пост
				 // эту строку из пост добавим после
				 if (strcasecmp ($mass_str[0], $mass_str2[0]) != 0) 
				 {
					 $endarr2[] = $st; // формируем новый массив с учетом куки и пост
					
					 
				 }
			  }
			  
			  
			  
					 	   
				//$endarr  = unserialize ($strbuk);
				
				
				//$str =  $str
		  }


                   $endarr2[] = $poststr2;  // добавление пост записи
                   $str = serialize ($endarr2);		
			
			
		
		
               $cookies = Yii::$app->response->cookies;

              // add a new cookie to the response to be sent
			   $session->set('massbukandkols_ses', $str);
               $cookies->add(new \yii\web\Cookie([
                'name' => 'massbukandkols',
                'value' => $str,
	            'expire' => time() + 3600*24*30,
               ]));
		
		
		       $totalprice = 0;	 $koltov = 0;
			   
			   if (count($endarr2) == 0)
					 {
						 $retstr = "0 товаров <span> на сумму </strong>0 руб.</strong></span>";
					 }
			   else
					 {
						//$koltov = count($endarr2);
						
						
                        foreach ($endarr2 as $elemmas)			
						{
							 $mass_str = explode ("ddd", $elemmas); 
							 $idd = $mass_str [0];
							
							 $idd_int = 1 * $idd;
							 $kol_int = 1 * $mass_str[1];
							 
							
							 
							 $bukbd = Buketi::find()
							     ->where(['id' => $idd_int])
                                 ->one();
							 if ($bukbd)
							   {								 
							      $koltov = $koltov + $kol_int;	 
							      $totalprice = $totalprice + $bukbd->price * $kol_int;	 
							   }
							
							
						}
						$totalprice =  number_format($totalprice, 0, '', ' ');
					   $retstr = "товаров: " . $koltov . "<span> на сумму <strong>" . $totalprice . " руб.</strong></span>";

						
					 }
					 
				
				
				
          return 	$retstr;

		}
        else {
			return "Err"	;
		}			
//	 return $ch;
		
		
		
	
	
	}
public function actionNoaja3() //
	{
		//$request = Yii::$app->request;
		//$bukid = $request->post('bukid');
		//$kolofbuk = $request->post('kolofbuk');
		$bukid = $_POST["bukid"];
		$kolofbuk = $_POST["kolofbuk"];
		$str_emulate = $bukid . "ddd" . $kolofbuk;
		$endarr = [];
		$endarr2 = [];
		$mass_str = [];
		$mass_str2 = [];
		
		
		$cookies = Yii::$app->request->cookies;
		$session = Yii::$app->session;
		$main_ses = $session->get('massbukandkols_ses');
		if ($main_ses)
		{  $strbuk = $main_ses;   }  
		else {  $strbuk = $cookies->getValue('massbukandkols', 'deff');  
		}
		
		
		
		$bukbd  = new Buketi();
		
		 if (strcasecmp ($strbuk, "deff") == 0)
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			//return null;    
			 
		   }
	      else
		   {
			$endarr  = unserialize ($strbuk);
			
			foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st); 
				 
				 if (strcasecmp ($mass_str[0], $bukid) != 0) 
				 {
					 $endarr2[] = $st;
					
					 
				 }
			  }
			  
			  
		   }
		
		
		   $endarr2[] = $str_emulate;
           $str = serialize ($endarr2);
		
		
		
      $session->set('massbukandkols_ses', $str);				
      $cookies = Yii::$app->response->cookies;

// add a new cookie to the response to be sent
      $cookies->add(new \yii\web\Cookie([
        'name' => 'massbukandkols',
        'value' => $str,
	    'expire' => time() + 3600*24*30,
      ]));
		
		
		  return $this->redirect (['cart/index']);
		
		
		
		
	}
	
public function actionAja2()
	{
		
		$ch = $_POST["idbuk"];
		$endarr = [];
		$endarr2 = [];
		$mass_str = [];
		
	  
        $session = Yii::$app->session;
	    $main_ses = $session->get('massbukandkols_ses');
	    if ($main_ses)
		   {  $strbuk = $main_ses;   }  
	    else {    $cookies = Yii::$app->request->cookies; $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
		//$strkol = $cookies->getValue('masskolofbuks', 'deff');
		
		$bukbd  = new Buketi();
	
		
		
		
		if (strcasecmp ($strbuk, "deff") == 0)
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return "err";    
			 
		   }
	    else
		{
			$endarr  = unserialize ($strbuk);
			
			foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st); 
				 
				 if (strcasecmp ($mass_str[0], $ch) != 0) 
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
						$session->set('massbukandkols_ses', $str);
                        $cookies->add(new \yii\web\Cookie([
                        'name' => 'massbukandkols',
                        'value' => $str,
						'expire' => time() + 3600*24*30,
                          ]));
					 } 
				$totalprice	  = 0;
				
				$koltov = 0;
			   if (count($endarr2) == 0)
					 {
						 $retstr = "0 товаров <span> на сумму <strong>0 руб.</strong></span>";
					 }
			   else
					 {
						//$koltov = count($endarr2);
                        foreach ($endarr2 as $elemmas)			
						{
							 $mass_str = explode ("ddd", $elemmas); 
							 $idd = $mass_str [0];
							 $idd_int = 1 * $idd;
							 $kol_int = 1 * $mass_str[1];
							 $koltov = $koltov + $kol_int;
							 $bukbd = Buketi::find()
							     ->where(['id' => $idd_int])
                                 ->one();
								 
							 $totalprice = $totalprice + $bukbd->price * $kol_int;	 
							
							
							
						}
						
					   $totalprice =  number_format($totalprice, 0, '', ' ');
					   $retstr = "товаров: " . $koltov . "<span> на сумму <strong>" . $totalprice . " руб.</strong></span>";
						
					 
						
					 }
					 
				
				
				
           return 	$retstr;			
					
		
		
		
		
		
	}
	
	
	public function getPost1()
	{
		$p1 = 1;
		if (Yii::$app->request->post('FilterData') )
		 {
		   $p1 = Yii::$app->request->post('FilterData')['sort1'];
		   $p1 = 1 * $p1;
		  // echo $p1;
		   return $p1;
		 }
	//	echo $p1;
		return $p1;
		 
		
	}
	
	public function getPost2()
	{
		
		$p2 = 2;
		if (Yii::$app->request->post('FilterData') )
		 {
		   $p2 = Yii::$app->request->post('FilterData')['sort2'];
		  //  echo $p2;
		   $p2 = 1 * $p2;
		   return $p2;
		 }
		//  echo $p2;
		return $p2;
		
	}
	
	public function getChangeParam()
	{
		
		$enable = true;
		
		$request = Yii::$app->request;
		
	/*	$unioncat = $request->get('unioncat');	
	    if ($unioncat) {
			 $enable = false;
			 return $enable;
		}   */
		$filterdata = new FilterData();
		$request = Yii::$app->request;
		
		
		
		//$k = 0;
		$m = 1;
		$xx = 0; // в случае если цена передается методом get (три вида цены и одна категория, но с категорией потом)
		// так вот в этом случае get price может продолжать висеть в браузерной строке, но пользователь при этом может
		// установить пост параметры в значения по умолчанию. в этом случае кэш должкн быть доступен
		
		// вот это вот абсолютное условие. если что-то приходит из формы и параметры там равны парметрам по умолчанию, 
		// то именно эти данные будут переданы в фильтр и кэш должен быть доступен.
		// если же пришла форма и данные там не равны парметрам по умолчанию, тот кэш однозначно не должен быть доступен, поэтому нечего там и проверять
		// пометка: листание страниц и выбор предопределенных интервалов цен не порождают отправку формы
		if  (  $filterdata->load(Yii::$app->request->post())  ) { 
		
		    $xx = 1;
		
				  
				  
		    if ( $filterdata['price1'] != 1000 or $filterdata['price2'] != 6000 or $filterdata['height1'] != 40 or $filterdata['height2'] != 100 or $filterdata['width1'] != 25 or $filterdata['width2'] != 70)
			{
			 
		      $enable = false;
			//  echo "f";
			  return $enable;
			  $xx = 2;
		    }
	 
		}
		else 
		{
		
		   if ($enable === true and $m) //  $m уже не надо, да и кстати проверка на enable тут уже смысла не имеет
		   // так как предыдущее условие исчерпывающее
		    {
			 $session = Yii::$app->session;
			 $session->open();
		     $str9 = "filtbase";  // когда переключаются страницы, используется только get параметр. поэтому приходится работать с сессиями
		     $st6 = $session->get ($str9);
		     $session->close();
			 
			 // нет данных формы, обращаемся к данным сессии. если происходит пролистывание, то кэш доступен, если же при
			 // пролиистывании в сессии оказались парметры не равные по параметрам по умолчанию, то кэш недоступен
			 if ($request->get('page') && strlen ($st6 ) > 5 ) // 5 просто так
			 {
				  $filterdata = unserialize ($st6);
				  if ( $filterdata['price1'] != 1000 or $filterdata['price2'] != 6000 or $filterdata['height1'] != 40 or $filterdata['height2'] != 100 or $filterdata['width1'] != 25 or $filterdata['width2'] != 70)
				  { $enable = false;  return $enable; }
			 }
			 else
			 {
				 
				  if ($enable === true)
		            {
			           $price  = $request->get('price');
			
			           if ($price)
				          { $enable = false;  return $enable; }
			
			
		            }
			 }
		
		   }
		
		  
		}
		
	/*	if ($enable === true)
		{
			if ($request->get('unioncat'))
				$enable = false; 
			
			
		}   */
		
		 return $enable;   
		
		
		
	}
	
public function actionBuketaja()
	{
		$st = Yii::getAlias('@web'); $st = $st . "/uploads/";
		
		
		
		$request = Yii::$app->request;
		$id = $request->get('id');
		$buk = Buketi::findOne($id);
	    $bukims = Buketi_ims::findOne(['id_buk' => $buk->id]);
		$request = Yii::$app->request;
		$metka = $request->post('metka');
		
		if (strcasecmp ( $metka, '321') == 0)
		{
		//$buk = Buketi::findOne($id);
		
		$str = '<div class="white-popupyii2">' ;
		$str = $str . '<input type = "hidden" name = "mpbukid" value = "' . $id . '">';
		$str = $str . '<div class="bx-title_div"><h1 id="pagetitle" class="bx-title dbg_title">' . $buk->name . '</h1></div>';
		
		$stim1 = $st . $bukims->pathim1; $stim1 = $stim1 . '.'; 
        $stim1 = $stim1 . $bukims->extim1;
	    $stmain = $stim1;
        $im1 = "<img src = '"  . $stim1 .  "'/>"; 
		$str = $str . "<div id = 'hid1' class = 'hiddenforjs'>" . $stim1 . "</div>";
		
		
		if (strlen ($bukims->pathim2) > 2  )
		  {
			  $stim2 = $st . $bukims->pathim2; $stim2 = $stim2 . '.'; 
			  $stim2 = $stim2 . $bukims->extim2;
			 
			  
		  }
		  else
		  {
			   $stim2 = $stim1;
			  
			  
		  }
		 $im2 = "<img src = '"  . $stim2 .  "'/>"; 
		 $str = $str . "<div id = 'hid2' class = 'hiddenforjs'>" . $stim2 . "</div>"; 
		 
		 
		if (strlen ($bukims->pathim3) > 2  )
		  {
			  $stim3 = $st . $bukims->pathim3; $stim3 = $stim3 . '.'; 
			  $stim3 = $stim3 . $bukims->extim3;
			 
			  
		  }
		  else
		  {
			   $stim3 = $stim1;
			  
		  }
		 $im3 = "<img src = '"  . $stim3 .  "'/>"; 
		 $str =  $str . "<div id = 'hid3' class = 'hiddenforjs'>" . $stim3 . "</div>";  
		
		if (strlen ($bukims->pathim4) > 2  )
		  {
			  $stim4 = $st . $bukims->pathim4; $stim4 = $stim4 . '.'; 
			  $stim4 = $stim4 . $bukims->extim4;
			  
			  
		  }
		  else
		  {
			   $stim4 = $stim1;
			   
			  
		  }
		 $im4 = "<img src = '"  . $stim4 .  "'/>"; 
		 $str =  $str . "<div id = 'hid4' class = 'hiddenforjs'>" . $stim4 . "</div>"; 
		
		if (strlen ($bukims->pathim5) > 2  )
		  {
			  $stim5 = $st . $bukims->pathim5; $stim5 = $stim5 . '.'; 
			  $stim5 = $stim5 . $bukims->extim5;
			  $im5 = "<img src = '"  . $stim5 .  "'/>";
			  
		  }
		  else
		  {
			   $stim5 = $stim1;
			   $im5 = "<img src = '"  . $stim5 .  "'/>";
			  
		  }
		  
		 $str =  $str . "<div id = 'hid5' class = 'hiddenforjs'>" . $stim5 . "</div>"; 
		
		// 1111
		
		$str = $str . '<div class="bx_lt">';
	    $str = $str . "<div id = 'bigim'>";
	   
	   
		
		$str = $str . $im1;
		$str = $str . "</div>" ;
		
		$str = $str .  "<div style = 'margin-top: 20px; box-sizing: border-box; position: relative; display: block; width: 100%;'> ";
		$str = $str . "<div class = 'smallims smallims_active smallims_nomarg' id = 'sm1' onclick = 'fsm (1); '>" . $im1 . "</div>";
		$str = $str . "<div class = 'smallims  ' id = 'sm2' onclick = 'fsm (2); '>" . $im2 . "</div>";
		$str = $str . "<div class = 'smallims  ' id = 'sm3' onclick = 'fsm (3); '>" . $im3 . "</div>";
		$str = $str . "<div class = 'smallims  ' id = 'sm4' onclick = 'fsm (4); '>" . $im4 . "</div>";
		$str = $str . "<div class = 'smallims  ' id = 'sm5' onclick = 'fsm (5); '>" . $im5 . "</div>";
		$str = $str . "</div>" ; // блок с 5 маленькими фото      
		$str = $str . "</div>" ;
		
		$str = $str . '<div class="bx_rt">';
		
		//11 строка вниз
		// hidden xs (ниже) роли не играет, так как в магнифишент попап стоит ограничение по разрешению
		
		if ($buk->rating)
		 $ratt = $buk->rating;
	    else $ratt = 0;
		
		if ($buk->kolrating)
		 $kolratt = $buk->kolrating;
	    else $kolratt = 0;
		
		$str = $str . '<div class = "row">
		<div style = "padding-left: 15px;"><div style = "float: left;"><input type = "hidden" name = "for1" id = "forrating1" value = "' . $ratt . '"></div> <div style = "float: left; color: #8d8d8d; font-size: 1em;  display: inline-block; vertical-align: middle; "> (' . $kolratt . ')</div></div>
	  <div class = "clearfix"></div>
		<div class="col-md-7 hidden-xs">
						
					<a href="javascript:void(0);" class="btn btn-warning btn-lg btn-block" data-id_mp="' . $buk->id  . '" data-type="mp4"><i class="fa fa-shopping-basket"></i> Оформить заказ</a>
					<div class="paymethod">и другие способы оплаты</div>
		
				</div>';
				$pr = number_format($buk->price, 0, '', ' '); 
				$str = $str . '<div class="col-md-5 text-right">
		
					<div class="item_current_price" id="bx_117848907_431_price">' . $pr . ' руб.</div>
					
		
		
				</div></div>';  //11
				//3  строка вниз
				$str = $str . '<div class="item_info_section">  
                   <div class="row">';  //5
		
		             $str = $str . '<div class="col-md-12"><h5>Количество:</h5></div>';
		               $str = $str .  '<div class="col-md-6">';  //6
					   
					   
					    $str = $str . '<div class="basket_quantity_control buk_spin_single">
										
										<div  class = "buk_spin_control_single minusminus_mp" data-id_mp = "' .  $buk->id . '">-</div>
						                <div class = "buk_spin_input_single">
						<input   data-id_mp = "' .  $buk->id . '" data-type = "2"  class="buck_input_target_single" name="quantity" value="1" type="text" >
						                </div>
						                <div  class = "buk_spin_control_single plusplus_mp" data-id_mp = "' .  $buk->id . '">+</div>
									</div>';
					   
					   
					   
					   $str = $str .  '</div>';  //6
					   
					   $pr = number_format($buk->price, 0, '', ' '); 
					   $str = $str .   '<div class="col-md-6 text-right hidden-xs hidden-sm">
       <div id="bx_117848907_431_basis_price" class="item_section_name_gray" style="padding: 15px 0px;">Цена ' .  $pr . ' руб. за 1 шт</div>
        </div> ';


		        $str = $str .  '</div></div>';  //5  //3
		
             $str = $str . '<div class="h5">Параметры букета</div>';
			 
			 
		$str = $str . '	 <ul class="list-inline hl_tooltip_li prop_li">
        <li>
        <i class="fa fa-arrows-v"></i>
        ' .  $buk->height . ' см
         </li>
        <li>
        <i class="fa fa-arrows-h"></i>
        ' .  $buk->width . ' см
        </li>
        <li>
        <i class="fa fa-globe"></i>
        ' .  $buk->fromcountry . '
        </li>
        <li>
        <i class="fa fa-info-circle"></i>
        Букет цветов
        </li>
        </ul> ';


        $str = $str . '<div class="item_info_section">
        <div class="garantia_main tag-box tag-box-v2 box-shadow shadow-effect-1">
        <div class="garantia_div1">
        <i class="fa fa-thumbs-o-up"></i>
        Гарантия качества
        </div>
        <div class="garantia_div2">Если получателю не понравится букет, и Вы сообщите нам об этом в течение 24 часов, мы бесплатно его поменяем.</div>
        </div>
        </div>';


        $str = $str . '<div class="item_info_section">
        <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle"></i>
        Гарантируем полное соответствие букета фотографии.
        </div>
        </div>';
		
		$str = $str . "</div>" ;  
		
		
		$str = $str . '<div class = "clearfix"></div>';
		$str = $str . "</div>" ;    
		
	    return $str;
		}
		else
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
			
			
			 
			 
			 return $this->render('singlebuk', ['buk' => $buk, 'bukims' => $bukims]);
		}
	//	return  ("<div class = 'white-popupyii2'>jjjjjj</div>");
		
		
		
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function actionAllbukets()
	{
	
		
		
		Yii::$app->view->params['myp'] = 1;
	
		$buketi = new Buketi();
		$session = Yii::$app->session;
		$filterdata = new FilterData();
		$request = Yii::$app->request;
		
		$unioncat = $request->get('unioncat');
		$searchq = $request->get('searchq');
		
		$price1_get = $request->get('price1');
	    $price2_get = $request->get('price2');
	    $height1_get = $request->get('height1');
		$height2_get = $request->get('height2');
		$width1_get = $request->get('width1');
		$width2_get = $request->get('width2');
		$sort1_get = $request->get('sort');
	
		
		if ( $price1_get ) {  $price1  = $price1_get;    }
		else  { $price1 = 1000;  }
		
		if ( $price2_get ) {  $price2  = $price2_get;    }
		else  { $price2 = 6000;  }
		
		if ( $width1_get ) {  $width1  = $width1_get;    }
		else  { $width1 = 25;  }
	
	    if ( $width2_get ) {  $width2  = $width2_get;    }
		else  { $width2 = 70;  }
		
		if ( $height1_get ) {  $height1  = $height1_get;    }
		else  { $height1 = 40;  }
	
	    if ( $height2_get ) {  $height2  = $height2_get;    }
		else  { $height2 = 100;  }
		
		if ( $sort1_get == '1' or $sort1_get == '2' or $sort1_get == '3' or $sort1_get == '4') {  $sort1  = $sort1_get;    }
		else  { $sort1 = 1;  }
		
		$filterdata['price1'] =  $price1;
	    $filterdata['price2'] = $price2;
	    $filterdata['height1'] = $height1;
	    $filterdata['height2'] = $height2;
        $filterdata['width1'] = $width1;
        $filterdata['width2'] = $width2;
        $filterdata['sort1'] = $sort1;
		$filterdata['searchq'] = $searchq;
		
		
	
		if ( $unioncat  )
		{
			
		    $osncat = Mainmenu::findOne($unioncat);
		    $unioncatname = $osncat->name;
		    $unioncatid = $osncat->id_cat; // одна из 4 главных категорий	
			
			
		
		    if ($unioncatid == 1)
		      Yii::$app->view->params['myp'] = 2;
	        if ($unioncatid == 2)
		      Yii::$app->view->params['myp'] = 3;
	        if ($unioncatid == 3)
		      Yii::$app->view->params['myp'] = 4;
	        if ($unioncatid == 4)
		      Yii::$app->view->params['myp'] = 5;
			
			
		    $rows = [];
		    $rows = (new \yii\db\Query())
               ->select(['id_buk'])
               ->from('alonecat')
	           ->where(['id_cat' => $unioncat])
               ->column();
		} 

		//	в гет параметрах будет либо $searchq либо $unioncat . Если мы кликаем на кнопку поиска, то в ссылке там
		// нет параметра категории. И если бы кликнем на ссылку категории, то ествесвтенно там не будет параметра поиска
		// вообще когда бы кликаем на поиск, то мы формируем ссылку, в которой кроме параметра с поисковой фразой
		// больше не содержится ничего 
		
		
			
		if ( $searchq  )
		{
			$rows = [];
		    $rows = (new \yii\db\Query())
               ->select(['id'])
               ->from('buketi')
	           ->Where(['like', 'name', $searchq])
               ->column();
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
			$query =  Buketi::find()
		-> where (['between', 'price', $price1, $price2])
		-> andWhere (['between', 'height', $height1, $height2])
		-> andWhere (['between', 'width', $width1, $width2])
		-> andWhere (['adjunct' => 0]);
		
		
		if ($searchq)
		 { $query = $query -> andWhere (['id' => $rows])	;  }
	    else {      // вообще можно и без else потому что как я уже писал выше, одно однозначно исключает другое
		if ($unioncat)
		 $query = $query -> andWhere (['id' => $rows])	;
		}
	    
		if ($sort1 == 1)
			{  $query = $query -> orderBy (['popul' => SORT_DESC]);    }
		if ($sort1 == 2) 
			{  $query = $query -> orderBy (['price' => SORT_ASC]);	   }
		if ($sort1 == 3) 
			{  $query = $query -> orderBy (['popul' => SORT_ASC]);	   }
		if ($sort1 == 4) 
			{  $query = $query -> orderBy (['price' => SORT_DESC]);	   }
			
			
			
				$countQuery = clone $query;
    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 12]); // в виеве если что тоже не забыть про pagesize
    $buketi = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
		
		
		 
		 if ($unioncat)
		 {
			   $unioncat = 1 * $unioncat;
		       return $this->render('allbukets', ['buketi' => $buketi, 'filterdata' => $filterdata, 'pages' => $pages, 'idname' => $unioncatname,  'idcat' => $unioncat, 'unioncatid' => $unioncatid, 'searchq' => -1 ]);
		 }
		 else 
		 {
		       if ($searchq)
		         {
					 return $this->render('allbukets', ['buketi' => $buketi, 'filterdata' => $filterdata, 'pages' => $pages, 'searchq' => $searchq, 'idcat' => -1 ]); 
					 
				 }
		 
		       else
			       return $this->render('allbukets', ['buketi' => $buketi, 'filterdata' => $filterdata, 'pages' => $pages, 'idcat' => -1, 'searchq' => -1]);
		 }
		
		
	}
	///////////////////////////////////////////////////////////////////////////////////////
	
	// служебная функция, которая нужна была, чтобы скопировать записи
	public function actionRep()
	{
		$buks = Buketi::find()->all();
		
		foreach ($buks as $buk)
		  {
			 $bm = new Buketi_ims();
			 $bm->pathim1 = $buk->pathim;
			 $bm->extim1 = $buk->extim;
			 $bm->id_buk = $buk->id;
             $bm->save();

             
		  }  
	
		
		 echo "555"		;	
		
	}

 /**
	
	
     * Login action.
     *
     * @return string
     */
	 
	 public function actionAllincat($id)
    {
		
		 $rez = Buketi::find()
		  ->Where (['idcat1' => $id])
		  ->asArray()
          ->all();
		  
		  
        return $this->render('allincat', ['rez' => $rez]);
    }
	
	 public function actionSinglebuk($id)
      {
		  
		 
		  $rez = Buketi::find()
		  ->Where (['id' => $id])
		  ->asArray()
          ->one();
		  
		  return $this->render('singlebook', ['rez' => $rez]);
		  
	  }
	  
	  
	
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
	
	 public function actionNewbuket()
    {
		$massid[1] = 'idcat1';
		$massid[2] = 'idcat2';
		$massid[3] = 'idcat3';
		$massid[4] = 'idcat4';
		$massid[5] = 'idcat5';
		$massid[6] = 'idcat6';
		$massid[7] = 'idcat7';
		$rez = Mainmenu::find()
		  ->Select (['id', 'name'])
		  ->Where (['id_cat' => 1])
		  ->asArray()
          ->all();
		$rez2 = Mainmenu::find()
		  ->Select (['id', 'name'])
		  ->Where (['id_cat' => 2])
		  ->asArray()
          ->all();
		
		$model = new Buket();
		$post = Yii::$app->request->post();
		$rt = $post['price'];
		
		$pp =   Yii::$app->request->post();
		$model->load($pp);
		//$gg = $model->maincat;
		$plusmass = $pp['Buket'];
		$plus2mass = $plusmass['maincat'];
		$plus22mass = $plusmass['maincat2'];  
		//echo $plusmass['price'];
	//////////////////////////////////////////////////////
	
		//echo $model['maincat'];
		$request = Yii::$app->request;
		//$name = $request->post('name');
		if ($model->load(Yii::$app->request->post()))
		{
			
			
			
			
			$siz = $model->im->name;
			$model->im = UploadedFile::getInstance($model, 'im');
			
			if ($model->upload()) {
				//echo $model->ext;
				//$rt = 88;
				$i = 1;
				$bukett = new Buketi();
                $bukett->name = $model->name;
			//	$hh = $model->maincat ;
//				echo $hh;
				
				
				$bukett->price = $model->price;
				$bufm = $model->maincat;
				$bufm2 = $model->maincat2;
				
				foreach ( $plus2mass as $val)
					{
						$bukett[$massid[$i]] = $val;
						$i++;
					}
				foreach ( $plus22mass as $val)
					{
						$bukett[$massid[$i]] = $val;
						$i++;
					}
				$bukett->pathim	= $model->bn;
				$bukett->extim	= $model->ext;
					
					
				
                $bukett->save();
                return $this->render ('testv', ['model' => $model, 'post' => $post, 'rt' => $name] );	
				}
				
				
				
				
				
			}
		
		
	
		return $this->render ('Newbuket', ['model' => $model, 'rez' => $rez, 'rez2' => $rez2]);
	
	}

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	
 public function actionAjarating()
 {
	 $request = Yii::$app->request;
     $val = $request->post('value');
	 $bukid = $request->post('bukid');
	 $valses = $this->randses;  // значение в сессии (идентификатор)
	
	 $nameses = "doing_for_rating";
	 
	 
   /*  $session = Yii::$app->session;
     $session->open();
 
     $getses = $session->get ($nameses);
	 $session->close();  */
	 $rat = Ratings::findOne(['id_buk' => $bukid, 'valses' => $valses]);
	 
	 if ($rat == NULL)
	 {
		$rat  = new Ratings();
		$rat->valses = $valses;
		$rat->id_buk = $bukid;
		$rat->save();
		$buk = Buketi::findOne ($bukid);
		
		if ($buk)
		{
			$kol = $buk->kolrating;
			$totalval = $buk->rating;
			if ($kol == NULL) { $kol =  0; } if ($totalval == NULL) { $totalval =  0; }
			$kol = 1 * $kol; $totval = 1 * $totval;
			$newrating = ($totalval * $kol + $val) / ($kol + 1);
			$newrating = round ($newrating, 2);
			
			$buk->rating = $newrating;
			$buk->kolrating = $kol * 1 + 1;
			$buk->save();
			
		}
		 
		 
		 
	 }
	 
	 return $valses;  // просто чтоб что-то вернуть
	 
 }

public function beforeAction($action) {
  //echo $action->id;
  if ($action->id === "allbukets" or $action->id === "index" or $action->id === "singlebuk" or $action->id === "ajarating"  )
   {
     $nameses = "doing_for_rating";
     $session = Yii::$app->session;
     $session->open();
  // $str9 = "filtbase";  // когда переключаются страницы, используется только get параметр. поэтому приходится работать с сессиями
     $getses = $session->get ($nameses);
	 $this->randses = $getses;
	//$this->randses = 999;
	 if ($getses == NULL)
	 {
		// echo "ffff";
		 $randstr = Yii::$app->getSecurity()->generateRandomString();
		 $session->set($nameses, $randstr);
		 $this->randses = $randstr;
	 }
	 
	 
	 
		 
	 $session->close();

	 
   }
  
  
  
  
  $x = false;
  if ($action->id === "allbukets")
	  $x = false;
  $this->enableCsrfValidation = $x;
  return parent::beforeAction($action);
}


public function actionSearch()
{
	return $this->render(
            'found');
	
}

public function actionSearchbuk()
{
	
	$request = Yii::$app->request;
    $str = $request->get('q');
	
	 $buks = Buketi::find()
	    -> Where(['like', 'name', $str])
		-> andWhere (['adjunct' => 0])
		-> limit(10)
		->all();
	$ret = NULL;
    foreach ($buks as $buk)	
	{
		//$ret = $ret . $buk->name;
		$ur = URL::to(['site/buketaja', 'id' => $buk->id] );
		$st = "<a class = 'searchhref' href = '" . $ur . "'>" .  $buk->name . "</a>";
		$ret = $ret . $st;
		$ret = $ret . " ";
		
		//echo $buk->name;
		
	}
	return $ret;
	
	
}


public function actionSearch2($q = '')
    {
        /** @var \himiklab\yii2\search\Search $search */
        $search = Yii::$app->search;
	//	echo $q;
        $searchData = $search->find($q); // Search by full index.
        //$searchData = $search->find($q, ['model' => 'page']); // Search by index provided only by model `page`.

        $dataProvider = new ArrayDataProvider([
            'allModels' => $searchData['results'],
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render(
            'found2',
            [
                'hits' => $dataProvider->getModels(),
                'pagination' => $dataProvider->getPagination(),
                'query' => $searchData['query']
            ]
        );
    }

	
	
	
public function actionOnlytest ()
{
	for ($i=0; $i<30000; $i++)
	{
	$t = new Onlytest();
	$randstr = Yii::$app->getSecurity()->generateRandomString();
	$t->name = $randstr;
	
	$t->save();
	if ($i == 29000)
	 echo $t->name;
	}

}	

public function actionOnlytest2 ()
{
	 $query = Onlytest::find()
	    -> Where(['like', 'name', 'l'])
		->all();
		
		foreach ($query as $qw)
		{
			echo $qw->name;
			echo " ";
			
		}
		
		
	 
	
}


	
	
}
