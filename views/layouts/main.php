<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Mainmenu;
use yii\db\ActiveRecord;
use app\models\Buketi;



  echo $this->renderDynamic('$st = Yii::getAlias("@app"); require_once($st . "/views/layouts/forcache.php"); ');

//echo Yii::getAlias('@app');

AppAsset::register($this);
$koltov = -1;

?>
<?php
$maincat1 = Mainmenu::find()
		  ->Where (['id_cat' => 1])
		  
          ->all();
		  
$maincat2 = Mainmenu::find()
		  ->Where (['id_cat' => 2])
		  
          ->all();

$maincat3 = Mainmenu::find()
		  ->Where (['id_cat' => 3])
		  
          ->all();

$maincat4 = Mainmenu::find()
		  ->Where (['id_cat' => 4])
		 
          ->all();		  
		  
		  
		  
		  
		  
		//	 $st = Yii::getAlias('@app'); echo $st;
		  
		  ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<?php

             $nameses = 
             $session = Yii::$app->session;
			 $session->open();
		     $str9 = "filtbase";  // когда переключаются страницы, используется только get параметр. поэтому приходится работать с сессиями
		     $st6 = $session->get ($str9);
		     $session->close();

			$session->set($sess, $filtset);



 ?>
<html lang="<?= Yii::$app->language ?>" style = "height: 100%;">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--	<script src="https://use.fontawesome.com/ffc1caaec4.js"></script>   -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class = "bx-background-image bx-green" style = "height: 100%;">
<div id = "modeffix">
  <span>выбрано: </span><span class = "modef_num" style = "font-weight: bold;">24</span><span> - </span> <a style = " "href="javascript:void(0)" onclick="SubmitMyFormBuk()" target="">Показать</a>
</div>

<?php $this->beginBody() ?>

<div id = "spinnerfix"> 
<img src = "spinner.gif" />
 </div>
<script>// alert( document.documentElement.clientWidth ) ; </script>
<div class="wrap">
  <header>
    <div class="bx-header-section container">
	  <div class = "row">
	  <div class="col-lg-2 col-md-2 col-sm-2">
         <div class="bx-logo hidden-xs">
            <a class="bx-logo-block hidden-xs" href="<?php echo Url::to(['site/index']); ?>">
			   <?php $st = Yii::getAlias('@web'); $st = $st . "/images/logo.png"?>
                <img src="<?php  echo $st; ?>" alt="лого Букеты" >
            </a>
			<a class="bx-logo-block hidden-lg hidden-md hidden-sm text-center" href="/">
			 <?php $st = Yii::getAlias('@web'); $st = $st . "/images/logo_mobile.png"?>
               <img src="<?php  echo $st; ?>" >
            </a>
            
         </div>
      </div>
	  
	  
	  
	  <div class="col-lg-10 col-md-10 col-sm-10 hidden-xs ">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-4">
									<div class="row">
									
									   
	                                         <div class="col-lg-6 col-md-6 hidden-sm">
		                                        <div class="nomer_title">
			                                       Многоканальный<br> по Санкт-Петербургу!
		                                        </div>
	                                         </div>
	                                         <div class="col-lg-6 col-md-6 hidden-sm">
		                                         <div class="nomer_title">
			                                           Звонок бесплатный<br> для всей России!
		                                         </div>
	                                         </div>
	                                         <div class="col-lg-6 col-md-6">
		                                        <div class="nomer">
			                                        <a href="tel:84951044593">
				                                           <i class="fa fa-phone green hidden-md hidden-xs"></i> <span class="green">(111)</span> 111-11-11
			                                        </a>
		                                        </div>
	                                         </div>
	                                         <div class="col-lg-6 col-md-6">
		                                        <div class="nomer">
			                                       <a href="tel:88003011742">
				                                        <i class="fa fa-phone green hidden-md hidden-xs"></i> <span class="green">(111)</span> 111-11-11
			                                       </a>
		                                        </div>
	                                         </div>
                                       
									
									
   	                                </div>
                                </div>	
								
								
								
								
								
								
								
								
								
								
								
								<div class="col-lg-6 col-md-6 col-sm-8">
									
                                   <div id="bx_basketFKauiI" class="bx-basket bx-opener"><div class="bx-hdr-profile">
	                                   <div class="row hidden-xs">
		                                  <div class="col-sm-7 col-md-7 col-lg-6 col-lg-offset-2">
			                                <div class="row">
				                                <div class="col-xs-6 col-sm-12 col-md-12">
												
												<?php 
												
												
													
													 
												
												?>
												
												
												
					                                 <div id = "kolandsum" class="bx-basket-block">
													 <?php echo $this->renderDynamic(' if (isset($this->params["totkol"]) && isset($this->params["totprice"]) )
												{
													$par1 = $this->params["totkol"]; $par2 = $this->params["totprice"];
												}
												else { $par1 = NULL;    $par2 = NULL;     }    
                                                
												$ret = dyn3($par1, $par2);  return $ret; ');  ?>
																		</div>
				                                </div>
				                                <div class="col-xs-6 col-sm-12 col-md-12">
					                                   <a class="btn btn-warning" href="<?php echo Url::to(['cart/index']) ?>"><i class="fa fa-shopping-basket"></i> Оформить заказ</a>
				                                </div>
			                                </div>
		                                  </div>
					                      <div class="col-sm-5 col-md-5 col-lg-4 text-right">
				                             <div class="bx-basket-block">						
											     <div class="row">
							                         <div class="col-md-12" style="margin-bottom: 5px;">
													 
													<?php 
											
													//$this->renderDynamic('');
												 //   $this->renderDynamic('$x = "fnjfvvjf" ; ');
												// echo  rand (0, 1000);
												   // echo $this->renderDynamic('$x = 8 ;');
												//	echo $this->renderDynamic('return $x ;');
													// echo $this->renderDynamic('$x = rand (0, 1000); ' . ' return $x ;');
												//	echo $this->renderDynamic('$isGuest = Yii::$app->user->isGuest; if ($isGuest) {');
													echo $this->renderDynamic(' $x = dyn1(); return $x; ');
													
													?>
													     <!--  здесь кусок кода -->
														   
							                         </div>
							                         <div class="col-md-12">
													 <?php echo $this->renderDynamic(' $x = dyn2(); return $x; ');  ?>
							                         </div>
						                         </div>
									         </div>
			                               </div>
			                          </div>
	                                  <div class="container hidden-md hidden-lg hidden-sm">
		                                 <div class="row">
			                                  <div class="col-xs-12">
				                                  <div class="row">
					                                   <div class="col-xs-12  text-right">
						                                    <a class="btn btn-success btn-md" href="<?php echo Url::to(['cart/index']) ?>"><i class="fa fa-shopping-basket"></i></a>
					                                   </div>
				                                  </div>
			                                   </div>
		                                 </div>
	                                  </div>
                                 </div>

                             </div>
						</div>
								
								
	
								
                            </div>
	                    </div>
												
						<div class="col-md-12">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-4">
									<div class="time_delivery">
	                                     <div class="row">
		                                    <div class="col-lg-6 col-md-12">
			                                  <div class="">
				                                 <i class="fa fa-clock-o"></i> Прием заказов <b>24 часа</b>
			                                  </div>
		                                    </div>
		                                    <div class="col-lg-6 col-md-12">
			                                    <div class="">
				                                   <i class="fa fa-truck"></i> <b>БЕСПЛАТНАЯ</b> доставка
			                                    </div>
		                                    </div>
	                                     </div>
                                     </div>							

	                            </div>
								<div class="col-lg-6 col-md-6 col-sm-8">
								<!--	
                                   <nav class="navbar navbar_top hidden-xs">
	                                    <div class="container-fluid">
		                                    <div id="navbar55" class="navbar-collapse collapse">
			                                   <ul class="nav navbar-nav navbar-left">
											      <li><a href="#">О студии</a></li>
		                                          <li><a href="#">Оплата и доставка</a></li>
		                                          <li><a href="#">Контакты</a></li>
		                                       </ul>
		                                    </div>
	                                    </div>
                                   </nav>   
								   
								   -->
								</div>
							</div>
						</div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
	                </div>
	  </div>
	  
	  <div class="col-md-12 col-sm-12">
	  
	  <nav class="navbar navbar-default mainmen">
	   
		<div class="navbar-header hidden-brand">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
			<a class="navbar-brand" href="#">Project name</a>
			<a class="btn btn-success btn-md cart-hidden" href="<?php echo Url::to(['cart/index']) ?>">
               <i class="fa fa-shopping-basket"></i>  (<span id = "kolandsummob"><?php echo $this->renderDynamic(' if (isset($this->params["totkol"]) && isset($this->params["totprice"]) )
												{
													$par1 = $this->params["totkol"]; $par2 = $this->params["totprice"];
												}
												else { $par1 = NULL;    $par2 = NULL;     }    
                                                
												$ret = dyn4($par1, $par2);  return $ret; '); ?></span>) 
            </a>
			<a href="<?php echo Url::to(['site/index']); ?>" class = "img-logo-mobile" >
		
			 <?php $st = Yii::getAlias('@web'); $st = $st . "/images/logo_mobile.png"?>
               <img src="<?php  echo $st; ?>" >
			
			
			</a>
         
          </div>
		
		
	
		<div id="navbar" class="navbar-collapse collapse mainmen_lev1" >
	<?php	
/*	$dependency = [
    'class' => 'yii\caching\DbDependency',
    'sql' => 'SELECT MAX(mydate) FROM mainmenu',
];
	$id = "my1"; if ($this->beginCache($id, ['duration' => 0, 'dependency' => $dependency])) {   */

    // ... generate content here ...

   ?>
		  <ul id="osnmenu" class="navbar-nav nav ">
		
		<li   <?php $tt = isset($this->params['myp']) ? 1 : 0 ; if ($tt == 1 && $this->params['myp'] == 1) { echo 'class="active"'; }      ?> ><a href="<?php echo Url::to(['site/allbukets']) ?>">ВСЕ БУКЕТЫ</a></li>
<li class="dropdown  <?php $tt = isset($this->params['myp']) ? 1 : 0 ; if ($tt == 1 && $this->params['myp'] == 2) { echo 'active'; }      ?>"><a class="dropdown-toggle" href="#" data-toggle="dropdown">ВЫБЕРИТЕ ПОВОД <b class="caret"></b></a>
   <ul id="" class="dropdown-menu">
   
   <?php foreach ($maincat1 as $maincatone)
   { 
    $ur = Url::to(['site/allbukets', 'unioncat' => $maincatone->id]);
	 echo '<li><a href='.$ur.' tabindex="-1">'.$maincatone["name"].'</a></li>';  
   }   ?>
   </ul>
</li>
<li class="dropdown <?php $tt = isset($this->params['myp']) ? 1 : 0 ; if ($tt == 1 && $this->params['myp'] == 4) { echo 'active'; }      ?>"><a class="dropdown-toggle" href="#" data-toggle="dropdown">ВЫБЕРИТЕ БУКЕТ <b class="caret"></b></a>
   <ul id="" class="dropdown-menu">
      <?php foreach ($maincat3 as $maincatone)
       { 
	     $ur = Url::to(['site/allbukets', 'unioncat' => $maincatone->id]);
	     echo '<li><a href='.$ur.' tabindex="-1">'.$maincatone["name"].'</a></li>';   
       }   ?>
   </ul>
</li>
<li class="dropdown <?php $tt = isset($this->params['myp']) ? 1 : 0 ; if ($tt == 1 && $this->params['myp'] == 3) { echo 'active'; }      ?>"><a class="dropdown-toggle" href="#" data-toggle="dropdown">ВЫБЕРИТЕ КОМУ <b class="caret"></b></a>
   <ul id="" class="dropdown-menu">
      <?php foreach ($maincat2 as $maincatone)
       { 
	     $ur = Url::to(['site/allbukets', 'unioncat' => $maincatone->id]);
	     echo '<li><a href='.$ur.' tabindex="-1">'.$maincatone["name"].'</a></li>';   
       }   ?>
   </ul>
</li>
<li class="dropdown <?php $tt = isset($this->params['myp']) ? 1 : 0 ; if ($tt == 1 && $this->params['myp'] == 5) { echo 'active'; }      ?>"><a class="dropdown-toggle" href="#" data-toggle="dropdown">НАШ ЭКСКЛЮЗИВ <b class="caret"></b></a>
   <ul id="" class="dropdown-menu dropdown-menu-smallmy">
      <?php foreach ($maincat4 as $maincatone)
       { 
	     $ur = Url::to(['site/allbukets', 'unioncat' => $maincatone->id]);
	     echo '<li><a href='.$ur.' tabindex="-1">'.$maincatone["name"].'</a></li>';  
       }   ?>
   </ul>
</li>
</ul>	

<?php /* $this->endCache();
}	  */  ?>
	</div>	
	
   </nav>
		
	
	  
	
	    </div>
	  </div>
	  
	  
	  
	  
	  <?php
	 
	  ?>
	  
	  
	  
	  
	  
	  
     </div>
 <?php  

 
// $tt = isset($this->params['myp']) ? 1 : 0 ;
// $tt2 = 
// echo $tt;
 
 ?>
  </header>
    <?php
   /* NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();   */
    ?>

    <div class="container" style = "position: relative;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Букеты  <?= date('Y') ?></p>

       
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
