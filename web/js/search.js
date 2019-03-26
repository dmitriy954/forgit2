function  fsearch1foc()
	    {
			
			$s =  $("input[name='searchq']").val();
		    if ($s.length > 2)
			  $('.rezsearchabs').css('display', 'block');
		// alert ("1") ;
		  
	    }
	  
	  function  fsearch2blur()
	    {
			setTimeout(invisib, 500);
		// alert ("2") ;
	//	  $('.rezsearchabs').css('display', 'none');
	    }
		
	  function invisib ()
	    {
		  $('.rezsearchabs').css('display', 'none');
		  
	    }
		 
	  function  fsearch3up($addr)
	  {
		 $s =  $("input[name='searchq']").val();
		 if ($s.length > 2)
		 {
			$('.rezsearchabs').css('display', 'block');
			searchajax($s, $addr);
			
		 }
		 else
			$('.rezsearchabs').css('display', 'none');
		  
	  }
	  
	  
	  
	  	  function searchajax(q, $addr)
	    {
		  $adress = $addr;
		  $.ajax({
	
	
	        type: "GET",
            url: ""+$adress+"",
            data: 'q=' + q,
	
   
	
    complete: function(jqXHR, textStatus) {
        if (textStatus == 'success') { 
		 
		  resp = jqXHR.responseText;
		//  alert (resp);
		$('.rezsearchabs').html(resp);
		
		  
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