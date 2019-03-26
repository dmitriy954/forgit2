<?php 


			
			
			
	    $enable = true;	
			
	    $session = Yii::$app->session;
		$filterdata = new FilterData();
		$request = Yii::$app->request;
		
		
		
		$k = 0;
		$m = 0;
		
		if  (  $filterdata->load(Yii::$app->request->post())  ) { 
		
		
		
				  
				  
		    if ( $filterdata['price1'] != 1000 or $filterdata['price2'] != 6000 or $filterdata['height1'] != 40 or $filterdata['height2'] != 100 or $filterdata['width1'] != 25 or $filterdata['width2'] != 70)
		      $enable = false;
		    
	 
		}
		
		if ($enable == true)
		{
			
			 $session->open();
		     $str9 = "filtbase";  // когда переключаются страницы, используется только get параметр. поэтому приходится работать с сессиями
		     $st6 = $session->get ($str9);
		     $session->close();
			 
			 if ($request->get('page') && strlen ($st6 ) > 5 )
			 {
				  $filterdata = unserialize ($st6);
				  if ( $filterdata['price1'] != 1000 or $filterdata['price2'] != 6000 or $filterdata['height1'] != 40 or $filterdata['height2'] != 100 or $filterdata['width1'] != 25 or $filterdata['width2'] != 70)
		             $enable = false;
			 }
		
		}
		
		if ($enable == true)
		{
			$price  = $request->get('price');
			
			if ($price)
				$emable = false;
			
			
		}
		
		 return $enable; 
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
