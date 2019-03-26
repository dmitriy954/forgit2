<?php

public function actionCategory()
	{
		$session = Yii::$app->session;
        $request = Yii::$app->request;
		$id = $request->get('id');
		echo "njfjf";
	////////////   бефор 	
		$osncat = Mainmenu::findOne($id);
		$idname = $osncat->name;
		$idcat = $osncat->id_cat;
		
		if ($idcat == 1)
		  Yii::$app->view->params['myp'] = 2;
	    if ($idcat == 2)
		  Yii::$app->view->params['myp'] = 3;
	    if ($idcat == 3)
		  Yii::$app->view->params['myp'] = 4;
	    if ($idcat == 4)
		  Yii::$app->view->params['myp'] = 5;
	  
	  ///////////////////////
	    $session->open();
		 $str9 = "filt" . $id;
		$st6 = $session->get ($str9);
		$session->close();
	 //   echo $st6;
	
	    $buketi = new Buketi();
		
		
		
		$filterdata = new FilterData();
		
	//	echo "5";
	    $k = 0;
		$m = 0;
		
		// $tt5 = Yii::$app->params['filt'];
		// echo "  333 "; echo $tt5;    echo "  333 ";
		
		if  (  $filterdata->load(Yii::$app->request->post())  ) { $k = 1; }
		if  (   $request->get('page') && strlen ($st6 ) > 5    )  { $m = 1; }
	//	if  (   $request->get('page')  ) { $t = Yii::$app->params['filt'];   }
		if (($k == 1) or ($m == 1) )
		{
			
			if ($k == 1 ) // поступили данные из формы
			   {
				  // echo "5";
			      $filtmass = [];
			      $filtmass['price1'] = $filterdata['price1'];
			      $filtmass['price2'] = $filterdata['price2'];
			      $filtmass['height1'] = $filterdata['height1'];
			      $filtmass['height2'] = $filterdata['height2'];
			      $filtmass['width1'] = $filterdata['width1'];
			      $filtmass['width2'] = $filterdata['width2'];
			      $filtmass['sort1'] = $filterdata['sort1'];
			      $filtmass['sort2'] = $filterdata['sort2'];
			      $filtmass['categ'] = $filterdata['categ'];
			
			      $filtset = serialize ($filtmass);
			
			// echo $filtset;
			
			
			       $str1 = "filt" . $id;
			       //Yii::$app->params['filt'] = $filtset;
				   $session->open();
				   $session->set($str1, $filtset);
				   $session->close();
				 //  $tt = Yii::$app->params['filt'];
				 //  echo "  -- "; echo $tt;    echo "  -- ";
			   }
			  else 
			  {
			      if ( $m == 1 )
			        {
				      // echo "5";
				      // $st = Yii::$app->params['filt'];
					   $str1 = "filt" . $id;
					    $session->open();
					  $st = $session->get ($str1);
					//  echo "--"; echo $st;
					   $session->close();
					 //  echo "++";      echo  $st;  echo "++";
				       $filtmass = unserialize ($st);
				 
		               $filterdata['price1'] =  $filtmass['price1'];
			           $filterdata['price2'] = $filtmass['price2'];
			           $filterdata['height1'] = $filtmass['height1'];
			           $filterdata['height2'] = $filtmass['height2'];
			           $filterdata['width1'] = $filtmass['width1'];
			           $filterdata['width2'] = $filtmass['width2'];
			           $filterdata['sort1'] = $filtmass['sort1'];
			           $filterdata['sort2'] = $filtmass['sort2'];
			           $filterdata['categ'] = $filtmass['categ'];
				 
				 
				  
			        }
			  }
			  
			       $rows = [];
			       $rows = (new \yii\db\Query())
               ->select(['id_buk'])
               ->from('alonecat')
	           ->where(['id_cat' => $filterdata->categ])
               ->column();
			   
			$sort1 = $filterdata->sort1;
			$sort2 = $filterdata->sort2;
			if ($sort1 == 1)
			{
				$ss = 'popul';
			}
		else {
		$ss = 'price';  }
			
			if ($sort2 == 1)
			{
			//	$ss2 = 'SORT_ASC';
				
				$query = Buketi::find()
		-> where (['between', 'price', $filterdata->price1, $filterdata->price2])
		-> andWhere (['between', 'height', $filterdata->height1, $filterdata->height2])
		-> andWhere (['between', 'width', $filterdata->width1, $filterdata->width2])
		-> andWhere (['id' => $rows])
		-> orderBy ([$ss => SORT_ASC]);
	    
	
				
			}
			else 
			{
				
				// $ss2 = 'SORT_DESC';
				$query = Buketi::find()
		-> where (['between', 'price', $filterdata->price1, $filterdata->price2])
		-> andWhere (['between', 'height', $filterdata->height1, $filterdata->height2])
		-> andWhere (['between', 'width', $filterdata->width1, $filterdata->width2])
		-> andWhere (['id' => $rows])
		-> orderBy ([$ss => SORT_DESC])
	   
		;
			}


    $countQuery = clone $query;
    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
    $buketi = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

		
			
				
			
			
			
	       return $this->render('allbukets', ['buketi' => $buketi, 'filterdata' => $filterdata, 'pages' => $pages, 'id' => $id, 'idname' => $idname, 'idcat' => $idcat ]);
	
		}
		else
		{
			
			
		   
		    //  Yii::$app->params['filt'] = ''; 
		  
 // сделать проверкку на наличие ид
                $rows = (new \yii\db\Query())
                  ->select(['id_buk'])
                  ->from('alonecat')
	              ->where(['id_cat' => $id])
                  ->column();
	   
	/*   foreach ($rows as $p => $s)
	   {
		 echo $p; echo " " ; 
		   
	   }  */
   //  $buks = $alcat->buketi;
   
   // каунт сделать по кол-ву элементов в rows 
               $query = Buketi::find()
               -> Where (['id' => $rows]);
   
               $countQuery = clone $query;
               $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
               $buks = $query->offset($pages->offset)
               ->limit($pages->limit)
                 ->all();
   
	
  	
			$filterdata->price1 = 1000;
			$filterdata->price2 = 6000;
			$filterdata->height1 = 40;
			$filterdata->height2 = 100;
			$filterdata->width1 = 25;
			$filterdata->width2 = 70;
			$filterdata->sort1 = 1;
			$filterdata->sort2 = 2;
			if ($id)
			{
				$filterdata->categ = $id;
				
			}
			
			return $this->render('allbukets', ['buketi' => $buks, 'filterdata' => $filterdata, 'pages' => $pages, 'id' => $id, 'idname' => $idname,  'idcat' => $idcat ]);
			
		}
			
			
		
		