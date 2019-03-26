<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\ActiveRecord;
use app\models\Buketi;


function dyn1  () {
	
	$isGuest = Yii::$app->user->isGuest; if ($isGuest) {
		
	$ad1 = Url::to(['site/login']);	
	$ret1 = '<a class="btn btn-default btn-sm" href="'  .  $ad1  .  '">Войти</a>';
	return $ret1;
	}
	else {
		
		
		$st =  Yii::$app->user->identity->surname .' '. Yii::$app->user->identity->name;
													
		if (mb_strlen ($st, "UTF-8") > 15 )
			{
				$st = mb_substr($st, 0, 13, "UTF-8");  
				$st = $st . '..';
				$st = " " . $st;
															  
		    }
	 $ad2 = Url::to(['kabinet/index']);		
	 $ret2 = '<a class="btn btn-default btn-sm" href="' .  $ad2  .  '"><i class="fa fa-user"></i>' . ' ' . $st . '</a>';	
	 return $ret2;
		
	}
	
	$x= 9;
	return $x;
  }
  
  function dyn2  () {
	  
	  $isGuest = Yii::$app->user->isGuest; if ($isGuest) {
		
	$ad1 = Url::to(['registr/registration']);	
	$ret1 = '<a class="btn btn-default btn-xs" href="'  .  $ad1  .  '">Регистрация</a>';
	return $ret1;
	}
	else {
		$ret2 = 	Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-sign-out"></i> Выйти',
                    ['class' => 'btn btn-default btn-sm']
                )
                . Html::endForm() ;
		
		
		return $ret2;
		
	}
	
	    
  }
  
  
  function dyn3  ($par1, $par2 ) {
	  
		if ($par1 and $par2 and $par1 > 0 and $par2 > 0)
			
			{
				
				
				$par2 = number_format($par2, 0, '', ' ');
				$retstr =  "товаров: " . $par1 . "<span> на сумму <strong>" . $par2 . " руб.</strong></span>";
			//	$koltov = $totkol; // для мобильной версии
				
				
				
				
			}
		else
		    {
			
			
			        $session = Yii::$app->session;
		            $main_ses = $session->get('massbukandkols_ses');
					
					if ($main_ses)
		              {  $strbuk = $main_ses;   }  
		            else {  $cookies = Yii::$app->request->cookies; $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
					
					
		         
					$bukbd  = new Buketi();
												
					$flag = 0;
					if (strcasecmp ($strbuk, "deff") == 0)
		                         {
			
			 
		                         }
	                else
		                         {
						                   $flag = 1;
			                               $endarr  = unserialize ($strbuk);
			                     }
													   
								$totalprice = 0;	 
				
				                $koltov = 0;	
												
								if (count($endarr) == 0)
												 {
													$flag = 0; 
													 
												 }
								else
												 {
                                                    $flag = 1;   // ненужная перестраховка
                                                    foreach ($endarr as $elemmas)			
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
												 }
								$totalprice = number_format($totalprice, 0, '', ' ');	   
							    $retstr =  "товаров: " . $koltov . "<span> на сумму <strong>" . $totalprice . " руб.</strong></span>";
			
			
			
			
		    }
		
		return $retstr;
		
	}
	
	
	
	 function dyn4  ($par1, $par2 ) {
		if ($par1 and $par2 and $par1 > 0 and $par2 > 0)
			
			{
				
				$par1 = 1 * $par1;
                return $par1; 				
			}
		else
		    {
				
				    $session = Yii::$app->session;
		            $main_ses = $session->get('massbukandkols_ses');
					
					if ($main_ses)
		              {  $strbuk = $main_ses;   }  
		            else {  $cookies = Yii::$app->request->cookies; $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
					
				
				
				    
					
												
					$koltov = 0;
					if (strcasecmp ($strbuk, "deff") == 0)
		                         {
			
			 
		                         }
	                else
		                         {
									 
									 $endarr  = unserialize ($strbuk);
                                     if (count($endarr) > 0)	
									 {
										 foreach ($endarr as $elemmas)			
						                                 {
							                                  $mass_str = explode ("ddd", $elemmas); 
							                                  $idd = $mass_str [0];
							
							                                  $idd_int = 1 * $idd;
							                                  $kol_int = 1 * $mass_str[1];
															  $koltov = $koltov + $kol_int;
														 }
										 
										 
										 
									 }										 
									 
									
								 }
			
			    return $koltov;
			
		    }
			
	 }