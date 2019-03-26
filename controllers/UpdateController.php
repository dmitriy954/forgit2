<?php

namespace app\controllers;
use yii\filters\AccessControl;

use Yii;
use yii\helpers\Url;
use app\models\Buketigii;
use app\models\Buketi_ims;
use app\models\BuketigiiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Mainmenu;
use app\models\MassCheck;
use yii\web\UploadedFile;
use app\models\Alonecat;
use yii\web\ForbiddenHttpException;


/**
 * UpdateController implements the CRUD actions for Buketigii model.
 */
class UpdateController extends Controller
{
    public $crez1;
	public $crez2;
	public $crez3;
	public $crez4;
	

	/**
     * @inheritdoc
     */
	//public $massch = new MassCheck(); 
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
			
		'access' => [
            'class' => AccessControl::className(),
			'rules' => [
                [
                    'allow' => true,
                    
                    'roles' => ['viewAdmin'],
                ],
				
			
			],
			'except' => ['adminpage'],
			
			
			],
			
			
			
			
			
        ];
    }

    /**
     * Lists all Buketigii models.
     * @return mixed
     */
	 
	 public function actionAdminpage()
	 
    {
		
		if (\Yii::$app->user->can('viewAdmin')) {
    // create post

		return $this->render('adminpage');  }
		else {
			
			throw new ForbiddenHttpException("Ошибка доступа. Вам эта страница недоступна");
		}
		
		
		
		
	} 
	
	
    public function actionIndex()
    {
        $searchModel = new BuketigiiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Buketigii model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Buketigii model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		// разбор внизу на примере update 
		
        $model = new Buketigii();
		$massch   = new MassCheck();
		$alonecat = new Alonecat();
		$modelims = new Buketi_ims();
		
		$ret = $this->rezs();
		$rez1 = $this->crez1; $rez2 = $this->crez2; $rez3 = $this->crez3; $rez4 = $this->crez4;

        if ($model->load(Yii::$app->request->post()) && $massch->load(Yii::$app->request->post())) {
			
			
			
			//$massch->im1 = UploadedFile::getInstance($massch, 'im1');
			if ($massch->validate())
			{
				//echo "4";
		//	if ($massch->im1)
			//   {
			//   echo "3";
				  
				  
				  
				  $massch->im1 = UploadedFile::getInstance($massch, 'im1');
				  
				  /* так то в строчке выше по логике необходимости нет. потому что логика функций upload в моделе masscheck
				   не нуждается в этом классе.  но атрибут im1 даже после выбора файла и отправки формы пустой. NULL . После же применения 
				   этой строчки этот атрибут перестает быть пустым. далее опять же после (!) этой строки выполняются функции upload ,
				   и в этих функциях идет обращение к тем атрибутам атрибута im1 , которые классом UploadedFile не предусмотрены. тем не менее 
				   все как-то работает. Впрочем, именно так написано в примере руководства. Поэтому и незачем экспериментировать
				   
				   */
				
				  if ($massch->im1) {
					  
					  if ($massch->upload1()) {
					  // echo "33";
					   //echo "jfjfjfjjfjfj";
					  $model->pathim	= $massch->bn1;
				      $model->extim	= $massch->ext1;
					  $modelims->pathim1 = $massch->bn1;
					  $modelims->extim1 = $massch->ext1;
					//  echo $massch->bn1;  echo $massch->ext1; 
					  
					  
					  
				  }
				  }
			   // }
			  $massch->im2 = UploadedFile::getInstance($massch, 'im2'); 
			   
			if ($massch->im2)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload2()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim2 = $massch->bn2;
					 $modelims->extim2 = $massch->ext2;
				
				  }
			   } 

			   $massch->im3 = UploadedFile::getInstance($massch, 'im3');  
             if ($massch->im3)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload3()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim3 = $massch->bn3;
					 $modelims->extim3 = $massch->ext3;
				
				  }
			   } 

              $massch->im4 = UploadedFile::getInstance($massch, 'im4');
             if ($massch->im4)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload4()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim4 = $massch->bn4;
					 $modelims->extim4 = $massch->ext4;
				
				  }
			   }  			   

			   $massch->im5 = UploadedFile::getInstance($massch, 'im5');  
			 if ($massch->im5)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload5()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim5 = $massch->bn5;
					 $modelims->extim5 = $massch->ext5;
				
				  }
			   } 
			}	
             else {
                 return $this->render('create', [
                'model' => $model, 'rez' => $rez1, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch, 
                   ]);
               }			
			
			    $model->strcat1 = NULL; $model->strcat2 = NULL; $model->strcat3 = NULL; $model->strcat4 = NULL;
			
			    $mass = [];
			    $str = NULL;
				 if (is_array ($massch->masscat1) && count($massch->masscat1) > 0)
				   {
			         $mass = $massch->masscat1;
                     $str = implode (";",  $mass);
                     	
			//	echo ($str);
			       }
				   
				$model->strcat1 = $str;
				
			    $str = NULL;
			    if (is_array ($massch->masscat2) && count($massch->masscat2) > 0)
				   {
			
				     $mass = $massch->masscat2;
                     $str = implode (";",  $mass);
                     
				   }
                $model->strcat2 = $str;	
				
				 $str = NULL;
			    if (is_array ($massch->masscat3) && count($massch->masscat3) > 0)
				   {
				     $mass = $massch->masscat3;
                     $str = implode (";",  $mass);
				   }
                $model->strcat3 = $str;	
				
				$str = NULL;
			    if (is_array ($massch->masscat4) && count($massch->masscat4) > 0)
				   {
				     $mass = $massch->masscat4;
                     $str = implode (";",  $mass);
				   }
                $model->strcat4 = $str;	

				

			   if ($model->save() ){
				   $modelims->id_buk = $model->id;
				   if ($modelims->save())
				     {
				
		               return $this->redirect(['view', 'id' => $model->id]);
					 }
				   else 
				     throw new GoneHttpException($message = "Не удалось сохранить данные в базе данных");

			     }
			   else 
				  throw new GoneHttpException($message = "Не удалось сохранить данные в базе данных");
	
		}
         else {
            return $this->render('create', [
                'model' => $model, 'rez' => $rez1, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch, 
            ]);
        }
		
		return $this->render('create', [
                'model' => $model, 'rez' => $rez1, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch, 
            ]);
		
		
    }

    /**
     * Updates an existing Buketigii model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		
		
		
		
		
		$pp =   Yii::$app->request->post();
		//$model->load($pp);
		//$gg = $model->maincat;
	//	$plusmass = $pp['MassCheck'];
	//	$plus2mass = $plusmass['mass1'];
	//	$plus22mass = $plusmass['mass2'];  
	
	
		/* в данном случае модел ищется по переданному иду. ищется путем функции findModel. для этого есть 
		модель BuketGii , которая представляет собой таблицу Buketi
		
		так же создан модел MassCheck. Дело в том, что мы помечаем категории, к которым относится букет. Речь  идет о категориях
		которые принадлежат к четырем главным категориям. В таблице Вукеты хранятся 4 строки. Эти строки получаются применением 
		функции implode к массивам отмеченных категорий. 
		
		Таким образом напрямую мы работать с этими строками не можем. Поэтому потребовалась еще одна модель, среди атрибутов
		которой есть 4 атрибута типа массив. (MassCheck) . Мы сначала получаем массивы выделенных элементов в MassChek. Затем берем эти
		массивы, преобразуем их в строки и сохраняем в основной моделе. Вопреки названию MassChek отвечает еще и за загрузку файла.  
		На момент написания этих строк при редактировании букета изображение букета не выводилось. Просто если при апдейте пользователь загружает
		новый файл, то он заменяет старый. Нет - старый останется. Таким образом в основной моделе есть лишь два атрибута (имя файла и расширение)
		
		Для хранения же экземпляра файла и все прочих действий с файлом изпользуются соотвествующие атрибуты MassChek, и после проведенных
		операций мы в основной модел просто передаем имя и расширение. 
		
		*/
		
		
		$massch   = new MassCheck();  // вспомогательный модел
		$alonecat = new Alonecat();
		// $ret просто так. Вызываем функцию. Функция оперериует с атрибутами класса. Нам нужно получить все категории четырех основных категорий
		// а именно ид категории и имя категории для вывода чекбоксов 
		$ret = $this->rezs(); 
// берем из атрибутов класса и кабируе в переменные функции		
		$rez1 = $this->crez1; $rez2 = $this->crez2; $rez3 = $this->crez3; $rez4 = $this->crez4;
		
		// ищем модел по переданному иду , вызываем функцию
         $model = $this->findModel($id);
		 $modelims = Buketi_ims::findOne(['id_buk' => $model->id]);
		 
		
		 // проверяем загрузку двух моделов
        if ($model->load(Yii::$app->request->post()) && $massch->load(Yii::$app->request->post())) {
			// тут идет опреация с файлом. учитывается и то, что если нету нового файла, то старый остается. для это лишнее условие
		//	$massch->im1 = UploadedFile::getInstance($massch, 'im1');
		
		  if ($massch->validate())
		  {	  
	  
	        $massch->im1 = UploadedFile::getInstance($massch, 'im1');
			if ($massch->im1)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload1()) {
					   //echo "jfjfjfjjfjfj";
					  $model->pathim	= $massch->bn1; // передаем в основной модел имя и расширение
				      $model->extim	= $massch->ext1;
					  $modelims->pathim1 = $massch->bn1;
					  $modelims->extim1 = $massch->ext1;
					  
				
				  }
			   }
			   
			 $massch->im2 = UploadedFile::getInstance($massch, 'im2'); 
			 if ($massch->im2)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload2()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim2 = $massch->bn2;
					 $modelims->extim2 = $massch->ext2;
				
				  }
			   } 

			 $massch->im3 = UploadedFile::getInstance($massch, 'im3');  
             if ($massch->im3)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload3()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim3 = $massch->bn3;
					 $modelims->extim3 = $massch->ext3;
				
				  }
			   } 

             $massch->im4 = UploadedFile::getInstance($massch, 'im4');
             if ($massch->im4)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload4()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim4 = $massch->bn4;
					 $modelims->extim4 = $massch->ext4;
				
				  }
			   }  			   

			 $massch->im5 = UploadedFile::getInstance($massch, 'im5'); 
			 if ($massch->im5)  // если вообще что-то грузилось
			   {
			    
				  
				//  $massch->im = UploadedFile::getInstance($massch, 'im');
				  if ($massch->upload5()) {
					   //echo "jfjfjfjjfjfj";
					 $modelims->pathim5 = $massch->bn5;
					 $modelims->extim5 = $massch->ext5;
				
				  }
			   }  		
		     }   
			    // строки с преобразованными в строки массивами выбранных категорий. строки могут быть пустыми (не выбрано категорий)
			$model->strcat1 = NULL; $model->strcat2 = NULL; $model->strcat3 = NULL; $model->strcat4 = NULL;
			
			$mass = [];
				
		    Alonecat::deleteAll(['id_buk' => $model->id]);
				
				
				
				
			  $str = NULL;
				 
				 // тут была ошибка, поэтому проверяем что количество элементов массива больше нуля и что это в принцимпе массив
			  if (is_array ($massch->masscat1) && count($massch->masscat1) > 0)
				   {
			         $mass = $massch->masscat1;  // берем массив из второго модела masschek
					 foreach ($mass as $el)
					 {
						$ac = new Alonecat() ;
						$ac->id_buk = $model->id;
						$ac->id_cat = $el;
						$ac->save();
						 
					 }
                     $str = implode (";",  $mass); // вот это уже можно сохранять в основной модел
                     	
			//	echo ($str);
			       }
				   
				$model->strcat1 = $str;   
				
			    $str = NULL;
			    if (is_array ($massch->masscat2) && count($massch->masscat2) > 0)
				   {
			
				     $mass = $massch->masscat2;
					 foreach ($mass as $el)
					 {
						$ac = new Alonecat() ;
						$ac->id_buk = $model->id;
						$ac->id_cat = $el;
						$ac->save();
						 
					 }
                     $str = implode (";",  $mass);
                     
				   }
                $model->strcat2 = $str;	
				
				 $str = NULL;
			    if (is_array ($massch->masscat3) && count($massch->masscat3) > 0)
				   {
				     $mass = $massch->masscat3;
					 foreach ($mass as $el)
					 {
						$ac = new Alonecat() ;
						$ac->id_buk = $model->id;
						$ac->id_cat = $el;
						$ac->save();
						 
					 }
                     $str = implode (";",  $mass);
				   }
                $model->strcat3 = $str;	
				
				$str = NULL;
			    if (is_array ($massch->masscat4) && count($massch->masscat4) > 0)
				   {
				     $mass = $massch->masscat4;
					 
					 foreach ($mass as $el)
					 {
						$ac = new Alonecat() ;
						$ac->id_buk = $model->id;
						$ac->id_cat = $el;
						$ac->save();
						 
					 }
                     $str = implode (";",  $mass);
				   }
                $model->strcat4 = $str;	

				
			    
				
			
			
			  
			 if ($model->save() and $modelims->save()){
				//  вообще-то сохранения в таблицу категорий нужно перенести сюда
			//	echo "999999999";
				return $this->redirect(['view', 'id' => $model->id]);

				
				 
			 }
			
           // return $this->redirect(['view', 'id' => $model->id]);
               else {
				   
				   // передаем два модела и массивы с именами и дами категорий
                    return $this->render('update', [
                'model' => $model, 'rez' => $rez1, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch,  
                        ]);
                    }   
         }
		 
		 else {  // первичная 
		 // 'model' - это букет который нужно обновить
		 
		 
		
         // это вызов функции класса
		 
		 //echo $modelims->id_buk;
                    return $this->render('update', [
                'model' => $model, 'modelims' => $modelims, 'rez' => $rez1, 'rez2' => $rez2, 'rez3' => $rez3, 'rez4' => $rez4, 'massch' => $massch,  
                        ]);
                    }    
		 
	}	 

    /**
     * Deletes an existing Buketigii model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Buketigii model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buketigii the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
		// ищем букет по иду
        if (($model = Buketigii::findOne($id)) !== null) {   // модел тот же что и в Buketi
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	protected function rezs ()
	{
		
		 $rez1 = Mainmenu::find()  // массив со списком категорий первой главной категории (из четырех)
		  ->Select (['id', 'name'])
		  ->Where (['id_cat' => 1])
		  ->asArray()
          ->all();
		$rez2 = Mainmenu::find()
		  ->Select (['id', 'name'])
		  ->Where (['id_cat' => 2])
		  ->asArray()
          ->all();
		  
		 $rez3 = Mainmenu::find()
		  ->Select (['id', 'name'])
		  ->Where (['id_cat' => 3])
		  ->asArray()
          ->all();
		  
		  
		 $rez4 = Mainmenu::find()
		  ->Select (['id', 'name'])
		  ->Where (['id_cat' => 4])
		  ->asArray()
          ->all();
		  
		  $this->crez1 = $rez1;
		  $this->crez2 = $rez2;
		  $this->crez3 = $rez3;
		  $this->crez4 = $rez4;
		  
		return 1;
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
