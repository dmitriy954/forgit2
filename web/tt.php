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
						   // �� ���� ����� ��� post
					   }
					   
				   }
				   else
				   {
					  // ���������� 
					    return $this->render (diffcontrolsumm);  
				   }
			
			
			
		}
else
        {
	    $arr1 = explode ($delim1, $lch);
	///////////////////////////////////////
        $cookies = Yii::$app->request->cookies;
        $strbuk = $cookies->getValue('massbukandkols', 'deff');    
	
		if (strcasecmp ($strbuk, "deff") == 0)  // ���� ���� ������
		   {
			// ����� ����� ����������   
			 
		   }
	    else
		  {
			
			$endarr  = unserialize ($strbuk); // ������ �� ���� �� ������� (�����, ����������)
			
			foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st);  // ������ �������, ������ �� ������� �� ������ � ����������
				 
				 foreach ($arr1 as $strchangekol) //  $arr1 ������ � ��������, � ������� ������ �������� ����������. (�� ������ � ����� ����������)
				   {
					// echo " ?  " ; echo $strchangekol ; echo " ? " ;
					 $arr2 = explode ($delim2, $strchangekol);   // ����� �� ���� ��������� (�� ������ � ����������)
					// echo " ** ";   echo  $mass_str[0];       echo " ** ";
					// echo " *** ";   echo  $arr2[0];       echo " *** ";
					 if (  strcasecmp ($mass_str[0] , $arr2[0]) == 0)   // $mass_str[0] - �� ������ �� ���� ,,, $arr2[0] - �� ������ �� ������� � ����������� �����������
					    {
							// ���� ��� ���������, �� ������ ����������
							$mass_str[1] = $arr2[1];
						  //  echo " * ";   echo  $mass_str[1];       echo " * ";
					    }
					 
				   }
				   
				  $st = implode ("ddd", $mass_str) ;
				 // echo " *@ ";   echo  $st;       echo " *@ ";
                  $endarr2[] = $st;		// ���� ������������ ������ �� ����, � ���������� ������� ��� ��� ���������		  
			  }
		  } 
	
	
	// ����� ���� ���� �������� ��������� ���������� ����� ����� � ������������ ����� (���� ������ �� ������)

        if (strcasecmp ($strbuk, "deff") == 0)   
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return null;    // ����������
			 
		   }
	     else
		   {
			
			$endarr  = unserialize ($strbuk);
			
			foreach ($endarr as $st)	
			  {
				$mass_str = explode ("ddd", $st); 
				$mass_ids[] = $mass_str[0];   // ��������� ������ � id ������� �� �������
				
			  }	
            }	
			
			
				// ����� �� ���� ������ �� ������������� ������� ����
    $bukets = Buketi::findAll ($mass_ids)	;
    $endarr  = unserialize ($strbuk);
	
    foreach ($bukets as $buket)	
	  {
		$id = $buket->id;
		$pr = $buket->price * 1;
		
		// ������� ����� ���������� �� ����
		$kol = 0;	
		foreach ($endarr as $st)   // ��������� ��, ��� ���� �� ����� (��. ����)
			  {
				 $mass_str = explode ("ddd", $st); 
		          if (  strcasecmp ($mass_str[0] , $id) == 0)
					    {
		                  $kol = 1 * $mass_str[1];
						}
			  }
			  
		// ����� ���� ���� - ���������� �� ������	  
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
						 // � ��������� ����������
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
						// ��������� ������� ����������
		 
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
	if (strcasecmp ($strbuk, "deff") == 0)  // ���� ���� ������
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return null;    
			 
		   }
	else
		{
			
			$endarr  = unserialize ($strbuk); // ������ �� ���� �� ������� (�����, ����������)
			
			foreach ($endarr as $st)
			  {
				 $mass_str = explode ("ddd", $st);  // ������ �������, ������ �� ������� �� ������ � ����������
				 
				 foreach ($arr1 as $strchangekol) //  $arr1 ������ � ��������, � ������� ������ �������� ����������. (�� ������ � ����� ����������)
				   {
					// echo " ?  " ; echo $strchangekol ; echo " ? " ;
					 $arr2 = explode ($delim2, $strchangekol);   // ����� �� ���� ��������� (�� ������ � ����������)
					// echo " ** ";   echo  $mass_str[0];       echo " ** ";
					// echo " *** ";   echo  $arr2[0];       echo " *** ";
					 if (  strcasecmp ($mass_str[0] , $arr2[0]) == 0)   // $mass_str[0] - �� ������ �� ���� ,,, $arr2[0] - �� ������ �� ������� � ����������� �����������
					    {
							// ���� ��� ���������, �� ������ ����������
							$mass_str[1] = $arr2[1];
						  //  echo " * ";   echo  $mass_str[1];       echo " * ";
					    }
					 
				   }
				   
				  $st = implode ("ddd", $mass_str) ;
				 // echo " *@ ";   echo  $st;       echo " *@ ";
                  $endarr2[] = $st;		// ���� ������������ ������ �� ����, � ���������� ������� ��� ��� ���������		  
			  }
		}   
// ����� ���� ���� �������� ��������� ���������� ����� ����� � ������������ ����� (���� ������ �� ������)

if (strcasecmp ($strbuk, "deff") == 0)   
		   {
			//$endarr[] = $ch;
			//$str = serialize ($endarr);
			return null;    // ����������
			 
		   }
	else
		{
			
			$endarr  = unserialize ($strbuk);
			
			foreach ($endarr as $st)	
			  {
				$mass_str = explode ("ddd", $st); 
				$mass_ids[] = $mass_str[0];   // ��������� ������ � id ������� �� �������
				
			  }	
        }	
   
	// ����� �� ���� ������ �� ������������� ������� ����
    $bukets = Buketi::findAll ($mass_ids)	;
    $endarr  = unserialize ($strbuk);
	
    foreach ($bukets as $buket)	
	  {
		$id = $buket->id;
		$pr = $buket->price * 1;
		
		// ������� ����� ���������� �� ����
		$kol = 0;	
		foreach ($endarr as $st)   // ��������� ��, ��� ���� �� ����� (��. ����)
			  {
				 $mass_str = explode ("ddd", $st); 
		          if (  strcasecmp ($mass_str[0] , $id) == 0)
					    {
		                  $kol = 1 * $mass_str[1];
						}
			  }
			  
		// ����� ���� ���� - ���������� �� ������	  
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
					 
////// �������� �����������
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
						   // ������ �����, �� ����� ��������� �� ������. �� ����� � ���� ������ ��� ��������� ��������
					   // ����� � ���� ��������� ������� ���������� �����. ��� ��������� �������� ����� ���� ����������� �� ������
					   // � ����������� ������. ������ ����������� , ���� ����� ����� � ����� ������� � ����������� ������ �����
					   // �� ����� ������������ ��������, ���������� ������� (��� ������ ���������� ����� $model � � ����� ��� ��������� ����� load)
					   // ����� �� (��� ��� � ���� else) ������� ����� ������ ����� , ������� � ���� ��������� ������� ����� �����
					   // � ������� ������������� ����� ������ � ���� ������ � ���������� �������
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
		else  // ���� ��������� �������� �����.
		{
	
	// ���� ����������� ����� ���������, ������� � ������� ��������� �����
	
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

