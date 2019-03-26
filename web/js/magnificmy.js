function  magnif($addr) {
		// alert ("jdjdj") ;
		  
		$('.onebukaja2').magnificPopup({
		
		
         type: 'ajax',
		 disableOn: 768,
		 ajax: {
          settings: {type: "POST",
            data: 'metka=' + 321,},
		  
		  
		 },
		 callbacks: {
                    parseAjax: function(mfpResponse)  {     },
					ajaxContentAdded: function() {
    // Ajax content is loaded and appended to DOM
                     $('.minusminus_mp').on('click', ff2_mp);
		             $('.plusplus_mp').on('click', ff3_mp);
		             $('[data-type = mp4]').on('click', ajamp_posr);
		  
		  
		             $('#forrating1').rating({min:0, max:5, step:1, size:'xs', showClear: false, showCaption: false});
					 
		             $('#forrating1').on('rating.change', function(event, value, caption) {
     
	                      $('#forrating1').rating('refresh', {displayOnly: true});
			              $adress = $addr ;
	                      fratingajaposr (value, $adress, 2);
                      });  
					 
		  
		  
		  
		  
  
		  },  // ajaxContentAdded:
		 closeBtnInside: true,
		
		
		 

		 

		
		
	}  // callbacks:
	
	}
	
	);    
		  
		  
		  
	  }



function ajamp($perr, $addr_from_posr, $addrimg) {
	
	
	
	//$bb =     $('[data-id = 3333]');
	//$bb.css ('display', 'inline-block');
	//alert ("ffff");

	var $bb;
	var $str;
	var $strtest;
	
	
	
	var cap = "fsaaa";
	 var stt = "54321";
	var resp;
	var magnificPopup = $.magnificPopup.instance;
	
	
	
	// alert ($perr);
	$kol = $('[data-id_mp ='+$perr+'][data-type = 2 ]').val();
	//alert ($kol);
	
	$forsent = $perr + "ddd" + $kol;
	//alert ($perr);
	  

         
		
		  
		 
		 // magnificPopup.close(); 
  $.magnificPopup.close(); 
		 
		
    $.magnificPopup.open({
      items: {
        src: '<div class = "white-popup"><div class = "popuptext">Идет обработка операции..</div></div>'
      },
     type: 'inline'

  // You may add options here, they're exactly the same as for $.fn.magnificPopup call
  // Note that some settings that rely on click event (like disableOn or midClick) will not work here
    }, 0);

//'/shop/basic/web/index.php?r=site%2Faja1'		  
		
		  
   $.ajax({
	
	
	type: "POST",
            url:   '' + $addr_from_posr,
            data: 'idbuk=' + $forsent,
	
   
	
    complete: function(jqXHR, textStatus) {
        if (textStatus == 'success') { 
		 
		  resp = jqXHR.responseText;
		 // alert (resp);
		  
		 $('#kolandsum').html ( resp );
		  
		
		
            $.magnificPopup.close(); 
		 
		
		
    $.magnificPopup.open({
  items: {
        src: '<div class = "white-popup"><div class = "popupimg"><img src = "' + $addrimg + '" /></div><div class = "popuptext"> Товар добавлен в корзину</div></div>'
  },
  type: 'inline',
  modal: true

  // You may add options here, they're exactly the same as for $.fn.magnificPopup call
  // Note that some settings that rely on click event (like disableOn or midClick) will not work here
}, 0);

setTimeout(funccl, 2000);
			
        }
        if (textStatus == 'error') {
            alert('Ошибка.');
        }
    }
});   

//alert ("nnn");    
}


 function funccl()
	{
		$.magnificPopup.close(); 
		
	} 

