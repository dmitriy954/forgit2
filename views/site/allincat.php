<?php
$this->title = "новыйгод";
$this->params['breadcrumbs'][] = $this->title;

foreach ($rez as $rez2)
		  {
			   echo " || "  ;
			//echo $rez2['name'] ; 
			<?php $st = Url::to(['site/singlebuk', 'id' => $rez2['id']]) ?>
			echo "<a href = " . $st ." >".$rez2['name']."</a>";
		  echo " || "  ;
			  
			  
		  }
		  
