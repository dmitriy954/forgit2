function fsort (event, num)
{
	
	event.preventDefault();
	
	if (num == 1)   {
		//alert ("1");
	   $('#filterdata-sort1').val('1');
	   }
	   
	if (num == 2)   {
		//alert ("2");
	   $('#filterdata-sort1').val('2');
	   } 
    
    if (num == 3)   {
		//alert ("2");
	   $('#filterdata-sort1').val('3');
	   }  

    if (num == 4)   {
		//alert ("2");
	   $('#filterdata-sort1').val('4');
	   }   	   
	// $v = $('#myfilter-form').attr("action"); 
	
	// $('#myfilter-form').submit();
	SubmitMyFormBuk();
}

function fsort2 (event, num)
{
	
	event.preventDefault();
	
	if (num == 1)   {
		//alert ("1");
	   $('#filterdata-sort2').val('1');
	  
	   }
	   
	if (num == 2)   {
		//alert ("2");
	   $('#filterdata-sort2').val('2');
	   
	   }   
	   
	// $('#myfilter-form').submit();
	SubmitMyFormBuk();
	
}

function hideFilter	($num)	
{
	if ($num == 1)
	{  $('#filparbox1').toggleClass('bx-active'); }
    if ($num == 2)
	{  $('#filparbox2').toggleClass('bx-active'); }
	if ($num == 3)
	{  $('#filparbox3').toggleClass('bx-active'); }
	
	
	
}	

function hidefilterblock()  {
		  
		  $('#showmyfilter').show();
		  $('#hidemyfilter').hide();
		  $('.tooglefilt').hide();
		
	  }
	  
function showfilterblock()  {
		  
		  $('#showmyfilter').hide();
		  $('#hidemyfilter').show();
		  $('.tooglefilt').show();
	  
	  }

