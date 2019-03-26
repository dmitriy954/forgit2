function fratingajaposr (value, $adress, flag) {
	
	var $forsent, $adress;
	
	
	$forsent = value;
	if (flag == 1)
	  {
	     $bukid = $('input[name="bukid"]').val();
	  }
	if (flag == 2)
	  {
		$bukid = $('input[name="mpbukid"]').val();
		
	  }
	//alert ($bukid);
	
	fratingaja ($adress,  $forsent, $bukid);
	
}		  
		  
function fratingaja ($adress, $forsent, $bukid)
   {
	  	$.ajax({
	
	
	type: "POST",
            url: ""+$adress+"",
            data: 'value=' + $forsent + '&bukid=' + $bukid,
	
   
	
    complete: function(jqXHR, textStatus) {
		//alert ("jhkk");
        if (textStatus == 'success') { 
		 
		  resp = jqXHR.responseText;
		//  alert (resp);
		
		  
		   // далее идет выделение количества для мобильной версии

		  }
		  
			
        
        if (textStatus == 'error') {
            alert('Ошибка.');
        }
      }
   });

	
   }