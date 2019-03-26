                                                          <?php $isGuest = Yii::$app->user->isGuest; if ($isGuest) {?>
								                          <a class="btn btn-default btn-sm" href="<?php echo Url::to(['site/login']) ?>">Войти</a>
														 
														  <?php } else { 
														 
														  $st =  Yii::$app->user->identity->surname .' '. Yii::$app->user->identity->name;
														  $st = $st;
														  if (mb_strlen ($st, "UTF-8") > 15 )
														  {
															$st = mb_substr($st, 0, 13, "UTF-8");  
															$st = $st . '..';
															  
														  }
														  ?>
														  <a class="btn btn-default btn-sm" href="<?php echo Url::to(['kabinet/index']) ?>"><i class="fa fa-user"></i><?php echo " "; echo $st;   ?></a>
														   <?php } ?>
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   <?php $isGuest = Yii::$app->user->isGuest; if ($isGuest) {?>
								                          <a class="btn btn-default btn-xs" href="<?php echo Url::to(['registr/registration']) ?>">Регистрация</a>
													
													<?php } else { ?>
												<?php $st = 	Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-sign-out"></i> Выйти',
                    ['class' => 'btn btn-default btn-sm']
                )
                . Html::endForm() ; echo $st; ?>

													
													 <?php } 
														   
														   
														   
														   
														   
														   
														   
														   
														   
														   
														











                                              if (isset($this->params['totkol']) && isset($this->params['totprice']) )
												{
													if (  ($this->params['totkol'] >= 0) && ($this->params['totprice'] >= 0) )
													 {
														  $totkol = $this->params['totkol']; 
														  $totprice = $this->params['totprice'];
														  $totprice = number_format($totprice, 0, '', ' ');
														  $retstr =  "товаров: " . $totkol . "<span> на сумму <strong>" . $totprice . " руб.</strong></span>";
														  $koltov = $totkol; // для мобильной версии
													  }
													  $retstr =  "товаров: " . $totkol . "<span> на сумму <strong>" . $totprice . " руб.</strong></span>";
												
												}
												else   {
												
												$cookies = Yii::$app->request->cookies;
		                                        $strbuk = $cookies->getValue('massbukandkols', 'deff');
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
														   
														   
														   
														   
														   
														   
														   