<?php
function serv_sess()
  {
	
    $session = Yii::$app->session;
	$main_ses = $session->get('massbukandkols_ses');
	if ($main_ses)
		{  $strbuk = $main_ses;   }  
	else {  $cookies = Yii::$app->request->cookies; $strbuk = $cookies->getValue('massbukandkols', 'deff');    }
	
	return $strbuk;
  }

?>
