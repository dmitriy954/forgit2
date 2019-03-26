function fsm (val)	
{
	//  $im = "<img src = '"  + imstr +  "'/>"; 
	
   // alert($im);
	$('.smallims').removeClass('smallims_active');
	if (val == 1)
	{
		$codeim = $('#hid1').html();
		
		$('#sm1').addClass('smallims_active');
	}
	if (val == 2)
	{
		
		$codeim = $('#hid2').html();
		
		$('#sm2').addClass('smallims_active');
	}
	if (val == 3)
	{
		$codeim = $('#hid3').html();
		$('#sm3').addClass('smallims_active');
	}
	if (val == 4)
	{
		$codeim = $('#hid4').html();
		$('#sm4').addClass('smallims_active');
	}
	if (val == 5)
	{
		$codeim = $('#hid5').html();
		$('#sm5').addClass('smallims_active');
	} 
	
	$im = "<img src = '"  + $codeim +  "'/>"; 

    $('#bigim').html($im);	
	
	// alert (val);
	
}