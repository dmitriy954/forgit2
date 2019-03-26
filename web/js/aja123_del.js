	
function aja($adress, $adress2, $forsent, $perr) {
	
	
	
	//$bb =     $('[data-id = 3333]');
	//$bb.css ('display', 'inline-block');
	var $perr;
	var $bb;
	var $str;
	var $strtest;
	
	var cap = "fsaaa";
	var stt = "54321";
	var resp;
	
	
	//alert ($perr);
	  
	$bb = $('[data-id ='+$perr+'][data-type = 7]');
	$bb.css ('display', 'inline-block');
    $bb = $('[data-id ='+$perr+'][data-type = 7xx]');
	$bb.css ('display', 'inline-block');

		 
		  
	//	alert ("bjnh");
    // alert ($adress)	;  alert ($forsent);

// alert ($address)	;	 alert ($forsent); 
    $.ajax({
	
	
	type: "POST",
            url: ""+$adress+"",
            data: 'idbuk=' + $forsent,
	
   
	
    complete: function(jqXHR, textStatus) {
        if (textStatus == 'success') { 
		 
		  resp = jqXHR.responseText;
		  
		
		  $bb = $('[data-id ='+$perr+'][data-type = 7]');
	      $bb.css ('display', 'none');
		  $bb = $('[data-id ='+$perr+'][data-type = 7xx]');
	      $bb.css ('display', 'none');
		  if (resp.length > 7) // пусть 7 на всякий случай. а вообще можно и 3 (Err)
		   {
		
		  
		  $str = '<div class = "bukincarttext" data-id = "' + $perr + '" data-type = "3" >Букет в корзине</div>';
		  $str = $str + '<div data-id = "'+ $perr +'" data-type = "5xx" class = "goincart"><a data-id = "'+ $perr +'" data-type = "5" class="btn btn-primary incart"  href="' + $adress2 + '" rel = "nofollow"><i class="fa fa-shopping-basket"></i> Корзина</a></div>'; 
		  $str = $str + '<div data-id = "'+ $perr +'" data-type = "6xx" class = "delfromcart"><a data-id = "'+ $perr +'" data-type = "6" class="btn btn-success incart"  href="javascript:void(0)" rel = "nofollow">Удалить</a></div>'; 
		  //  alert (str);
		   $bb = $('[data-id ='+$perr+'][data-type = bigbl]');
		   $strtest = 'fffffffffffff';
		   $bb.html($str);
		  
		  $('[data-type = 6]').on('click', ajaposr2);
		  
		   $('#kolandsum').html ( resp );
		   // далее идет выделение количества для мобильной версии
		   arr =  resp.split(' ') ;
		   
		   a = arr[1];
		   a = a.replace(/\D/g, "");
		  // alert (a);
		   $('#kolandsummob').html (a);
		  }
		  else
		  {
			  alert ("Сейчас этот товар не добавить. Позвоните нам по телефону");
		  }
           // alert(jqXHR.responseText);
			
              ///////  $("#select_wrapper").html(jqXHR.responseText);
		//alert('Ошибка.4');
			
        }
        if (textStatus == 'error') {
            alert('Ошибка.');
        }
    }
});
}

function aja2($adress, $perr) {

	// var $perr;
	//alert ($adress);
	//alert ($perr);
	var $bb;
	var resp;
	var cap = "fsaaa";
	var stt = "54321";
	var $str;
	
	
	//$perr = $(this).attr("data-id");
	
	$bb = $('[data-id ='+$perr+'][data-type = 7]');
	$bb.css ('display', 'inline-block');
    $bb = $('[data-id ='+$perr+'][data-type = 7xx]');
	$bb.css ('display', 'inline-block');
		  
		  
	$.ajax({
	
	
	type: "POST",
            url: ""+$adress+"",
            data: 'idbuk=' + $perr,
	
    
	
    complete: function(jqXHR, textStatus) {
        if (textStatus == 'success') { 
		  //alert(jqXHR.responseText);
		  resp = jqXHR.responseText;
		  $bb = $('[data-id ='+$perr+'][data-type = 7]');
	      $bb.css ('display', 'none');
		  $bb = $('[data-id ='+$perr+'][data-type = 7xx]');
	      $bb.css ('display', 'none');
		
		  if (resp.length > 7) // пусть 7 на всякий случай. а вообще можно и 3 (Err)
		   {
			  // alert ("88");
		  $str =  '<div data-id = "'+ $perr +'" data-type = "4xx"  class = "parent_incart"><a data-id = "'+ $perr +'" data-type = "4" class="btn btn-success incart"  href="javascript:void(0)" rel = "nofollow">Купить</a></div> ';
	      $('#kolandsum').html ( resp );
	      $bb = $('[data-id ='+$perr+'][data-type = bigbl]');
		  $strtest = 'fffffffffffff';
		  $bb.html($str);
		//  $('[data-type = 4]').on('click', ajaposr);
		 //  $('[data-type = 4]').on('click', ajaposr);
		//  t = $bb.html();
		//  alert (t);
		 // $('[data-type = 4]').on('click', aja);
		   }
		   else {
			   alert ("произошла ошибка");
		   }
		  
		}
		
		 if (textStatus == 'error') {
            alert('Ошибка.');
        }
	}
	});
	
	
}