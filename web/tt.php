<?php


if ($model->load(Yii::$app->request->post()) )
		{
			       $tempord = new TempOrders ();
				   $flag = 1;
				 //  echo $flag;
				   $tempord = TempOrders::findOne ($model->idt);
				  
				   if ($tempord == null)
				     {  $flag = 0; }
			       else 
					if ($tempord->control_string != $model->controlst)
					{
						$flag = 0;
						
						echo $tempord->idt;
						
					}
					
				   if ($flag == 1)
				   {
					   if ($model->validate()) {
						   
						   render (testgood);
						   
						   
					   }
					   else
					   {
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
else
        {
	    $arr1 = explode ($delim1, $lch);
	///////////////////////////////////////
        $cookies = Yii::$app->request->cookies;
        $strbuk = $cookies->getValue('massbukandkols', 'deff');    
	
		if (strcasecmp ($strbuk, "deff") == 0)  // если куки пустые
		   {
			// здесь нужно исключение   
			 
		   }
	    else
		  {
			
			$endarr  = unserialize ($strbuk); // массив из куки со списком (букет, количество)
			
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
				   
				  $st = implode ("ddd", $mass_str) ;
				 // echo " *@ ";   echo  $st;       echo " *@ ";
                  $endarr2[] = $st;		// сюда переписываем массив из куки, и количества букетов тут уже обновлены		  
			  }
		  } 
	
	
	// далее идет блок проверки равенства переданной общей суммы и подсчитанной суммы (чтоб клиент не наебал)

        if (strcasecmp ($strbuk, "deff") == 0)   
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return null;    // переписать
			 
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
			  {
				 $mass_str = explode ("ddd", $st); 
		          if (  strcasecmp ($mass_str[0] , $id) == 0)
					    {
		                  $kol = 1 * $mass_str[1];
						}
			  }
			  
		// потом если есть - количество из инпута	  
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

         if (count($endarr2) == 0)
					 {
						 $cookies2->remove('massbukandkols');
						 // и генерация исключения
					 }
	     else
					 {
                        
						$str = serialize ($endarr2);
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
	
	     if ($total_control == $tot) 
	            {
		
		            $idt = null; $controlst = null;
		            if (count($endarr2) != 0 && $total_control == $tot)
			             {		
					          $order = new TempOrders();
		                      $order->total_price = $tot;
				              $randstr = Yii::$app->getSecurity()->generateRandomString();
		                      $order->control_string = $randstr;
				              if ($order->save())
				                    {
					//echo $order->id;       
					                         $idt = $order->id;
											 $controlst = $order->control_string;
											 
				                     }
		
			              }
		
	                 if ($idt != null && $controlst != null)
					  {
					 
					    return $this->render (enterdata, ['post' => $post, 'model' => $model, 'tot' => $tot, 'idt' => $idt, 'controlst' => $controlst]) ;
					  }
					   
	            }
	     else 
	               {
		                return $this->render (diffcontrolsumm);
						// продумать получше исключение
		 
	               }









	
	
	
        }
		
		
		
		
		
		
		
		
		
		
////////////////////////////////////////////////////////////








/*

	
	$arr1 = explode ($delim1, $lch);
	///////////////////////////////////////
    $cookies = Yii::$app->request->cookies;
    $strbuk = $cookies->getValue('massbukandkols', 'deff');     
	//echo " ";
	//echo $strbuk;
   // echo " ";	
	if (strcasecmp ($strbuk, "deff") == 0)  // если куки пустые
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return null;    
			 
		   }
	else
		{
			
			$endarr  = unserialize ($strbuk); // массив из куки со списком (букет, количество)
			
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
				   
				  $st = implode ("ddd", $mass_str) ;
				 // echo " *@ ";   echo  $st;       echo " *@ ";
                  $endarr2[] = $st;		// сюда переписываем массив из куки, и количества букетов тут уже обновлены		  
			  }
		}   
// далее идет блок проверки равенства переданной общей суммы и подсчитанной суммы (чтоб клиент не наебал)

if (strcasecmp ($strbuk, "deff") == 0)   
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return null;    // переписать
			 
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
			  {
				 $mass_str = explode ("ddd", $st); 
		          if (  strcasecmp ($mass_str[0] , $id) == 0)
					    {
		                  $kol = 1 * $mass_str[1];
						}
			  }
			  
		// потом если есть - количество из инпута	  
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
		
		
/*	 $cookies2 = Yii::$app->response->cookies;
	  $cookies2->add(new \yii\web\Cookie([
                        'name' => 'dimaa7',
                        'value' => 'hhhhhhhhhhhhhhhhh',
                          ]));     */
   
     $cookies2 = Yii::$app->response->cookies;

     if (count($endarr2) == 0)
					 {
						 $cookies2->remove('massbukandkols');
					 }
	 else
					 {
                        
						$str = serialize ($endarr2);
					//	echo " *@* ";   echo  $str555;       echo " *@* ";
						// $cookies->remove('massbukandkols');
                        $cookies2->add(new \yii\web\Cookie([
                        'name' => 'massbukandkols',
                        'value' => $str,
						'expire' => time() + 3600*24*30,
                          ]));
					 }     
					 
////// закончил копирование
	$tot = 1 * $tot;
	$total_control = 1 * $total_control;
	
	
	
	 
		$model = new Datasorder();
	
	if ($model->load(Yii::$app->request->post()) )
		{
			// echo "fff";
			 
			if ($model->validate()) {
				// echo "ffff";
                if ($total_control == $tot) 
	                {
				 
				      return $this->render (checking, ['model' => $model]) ;
					}
				   else
				   {
					  
					  return $this->render (diffcontrolsumm);  
					 
				   }
   
			    }
			    else
			    {
				
				   $tempord = new TempOrders ();
				   $flag = 1;
				 //  echo $flag;
				   $tempord = TempOrders::findOne ($model->idt);
				  
				   if ($tempord == null)
				     {  $flag = 0; }
			       else 
					if ($tempord->control_string != $model->controlst)
					{
						$flag = 0;
						
						echo $tempord->idt;
						
					}
					
					//echo $flag;
				  
				   if ($total_control == $tot)
				     {
						echo "66"; 
					   if ($flag == 1)
				         return $this->render (enterdata, ['post' => $post, 'model' => $model, 'idt' => $model->idt, 'controlst' => $model->controlst]) ;
				       else 
						   // пришла форма, но форма валидацию не прошла. до этого в базе данных при первичной отправке
					   // формы в базе временных заказов создавался заказ. при первичной отправке формы туда отправлялся ид заказа
					   // и контрольная строка. сейчас проверяется , если найде заказ с таким норером и контрольные строки равны
					   // то форма отправляется повторно, населенная данными (эти данные передаются через $model а в модел они поступают через load)
					   // иначе же (как раз в этом else) создаем новый пустой модел , создаем в базе временных заказов новый заказ
					   // и послыем ненаселенныую форму вместе с идом заказа и котрольной строкой
					   {   
						   
						   
						      $order = new TempOrders();
		                      $order->total_price = $tot;
				              $randstr = Yii::$app->getSecurity()->generateRandomString();
		                      $order->control_string = $randstr;
				              if ($order->save())
				                    {
					//echo $order->id;       
					                         $idt = $order->id;
											 $controlst = $order->control_string;
											 
				                     }
		
						   ////////////////////////////////
						   
						   return $this->render (enterdata, ['post' => $post, 'model' => $model, 'tot' => $tot, 'idt' => $idt, 'controlst' => $controlst]) ;
						   
					   }
					   
					 }
					else
					{
						 return $this->render (diffcontrolsumm);  
						
						
					}	
			}
		}
		else  // если первичная загрузка формы.
		{
	
	// если контрольные суммы совпадают, создаем в таблице временный заказ
	
	        if ($total_control == $tot) 
	            {
		
		            $idt = null; $controlst = null;
		            if (count($endarr2) != 0 && $total_control == $tot)
			             {		
					          $order = new TempOrders();
		                      $order->total_price = $tot;
				              $randstr = Yii::$app->getSecurity()->generateRandomString();
		                      $order->control_string = $randstr;
				              if ($order->save())
				                    {
					//echo $order->id;       
					                         $idt = $order->id;
											 $controlst = $order->control_string;
											 
				                     }
		
			              }
		
	                 if ($idt != null && $controlst != null)
					  {
					 
					    return $this->render (enterdata, ['post' => $post, 'model' => $model, 'tot' => $tot, 'idt' => $idt, 'controlst' => $controlst]) ;
					  }
					   
	            }
	        else 
	               {
		                return $this->render (diffcontrolsumm);
		 
	               }
	  
		}
	 */

